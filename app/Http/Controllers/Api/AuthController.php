<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tuteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required|string|min:3|max:50',
                'mdp' => 'required|string|min:6',
            ]);

            $tuteur = Tuteur::where('nom_utilisateur', $request->login)->first();

            if (!$tuteur || !Hash::check($request->mdp, $tuteur->mot_de_pass)) {
                Log::warning('Login attempt failed', [
                    'login' => $request->login,
                    'ip' => $request->ip(),
                    'user_exists' => $tuteur !== null
                ]);
                return response()->json([
                    'message' => 'اسم المستخدم أو كلمة المرور غير صحيحة.'
                ], 401);
            }

            $token = $tuteur->createToken('auth_token')->plainTextToken;
            $refreshToken = $tuteur->createToken('refresh_token', ['ability' => 'refresh'])->plainTextToken;

            Log::info('User logged in successfully', [
                'user_id' => $tuteur->id,
                'username' => $tuteur->nom_utilisateur,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'access_token' => $token,
                'refresh_token' => $refreshToken,
                'token_type' => 'Bearer',
                'user' => $tuteur
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Login validation failed', [
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $accountType = $request->input('account_type', 'beneficiary');

            if ($accountType === 'volunteer' || $accountType === 'admin_request') {
                $request->validate([
                    "nom_tuteur" => "required|string|max:100",
                    "prenom_tuteur" => "required|string|max:100",
                    "email_tuteur" => "required|email|unique:tuteurs,email_tuteur|max:150",
                    "nom_utilisateur" => "required|string|min:3|max:50|unique:tuteurs,nom_utilisateur",
                    "mot_de_pass" => "required|string|min:6|max:100",
                    "telephon" => "nullable|string|max:20",
                    "region_id" => "nullable|exists:regions,id",
                ]);

                $tuteur = new \App\Tuteur([
                    'account_type' => $accountType,
                    'nom_tuteur' => $request->nom_tuteur,
                    'prenom_tuteur' => $request->prenom_tuteur,
                    'email_tuteur' => $request->email_tuteur,
                    'telephon' => $request->telephon,
                    'region_id' => $request->region_id ?? 1,
                    'nom_utilisateur' => $request->nom_utilisateur,
                    'mot_de_pass' => Hash::make($request->mot_de_pass),
                    'professional_field' => $request->professional_field ?? '',
                    'interests' => is_array($request->interests) ? json_encode($request->interests) : ($request->interests ?? ''),
                    'adresse' => $request->adresse ?? '',
                    'CIN' => $request->CIN ?? '',
                    'type_Tuteur' => 0,
                    'formation' => 0,
                ]);

                $tuteur->save();

                Log::info('New user registered', [
                    'user_id' => $tuteur->id,
                    'account_type' => $accountType,
                    'username' => $tuteur->nom_utilisateur,
                    'email' => $tuteur->email_tuteur,
                    'ip' => $request->ip()
                ]);

                $msg = ($accountType === 'volunteer') ? 'تم تسجيل المتطوع بنجاح' : 'تم إرسال طلب حساب مسؤول بنجاح. سيتم تفعيله قريبا.';
                return response()->json([
                    'message' => $msg,
                    'user' => $tuteur
                ], 201);
            }

            // Default: Beneficiary Family
            $request->validate([
                "nom_tuteur" => "required|string|max:100",
                "prenom_tuteur" => "required|string|max:100",
                "CIN" => "required|string|max:20|unique:tuteurs,CIN",
                "adresse" => "required|string|max:255",
                "region_id" => "required|exists:regions,id",
                "email_tuteur" => "required|email|unique:tuteurs,email_tuteur|max:150",
                "telephon" => "required|string|max:20",
                "whatsapp" => "required|string|max:20",
                "nom_utilisateur" => "required|string|min:3|max:50|unique:tuteurs,nom_utilisateur",
                "mot_de_pass" => "required|string|min:6|max:100",
                "nom_enfant" => "required|string|max:100",
                "prenom_enfant" => "required|string|max:100",
                "date_naissance" => "required|date|before:today",
                "sexeEnfant" => "required|",
                "statut" => "required|string|max:50",
                "parole" => "required|string|max:50",
                "avs" => "required|string|max:50",
                "etude" => "required|string|max:50",
                "type_Tuteur" => "required|integer",
                "formation" => "required|integer",
                "photo" => "nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048",
            ]);

            // Wrapped in a transaction so a failure partway through (e.g. the
            // enfant insert) can't leave an orphaned tuteur row behind with
            // no child record — previously each ->save() committed independently.
            [$tuteur, $enfant] = DB::transaction(function () use ($request) {
                $tuteur = new \App\Tuteur([
                    'account_type' => 'beneficiary',
                    'nom_tuteur' => $request->nom_tuteur,
                    'prenom_tuteur' => $request->prenom_tuteur,
                    'adresse' => $request->adresse,
                    'CIN' => $request->CIN,
                    'region_id' => $request->region_id,
                    'email_tuteur' => $request->email_tuteur,
                    'telephon' => $request->telephon,
                    'whatsapp' => $request->whatsapp,
                    'type_Tuteur' => $request->type_Tuteur,
                    'formation' => $request->formation,
                    'nom_utilisateur' => $request->nom_utilisateur,
                    'mot_de_pass' => Hash::make($request->mot_de_pass)
                ]);

                $tuteur->save();

                $enfant = new \App\Enfant([
                    'nom_enfant' => $request->nom_enfant,
                    'prenom_enfant' => $request->prenom_enfant,
                    'date_naissance' => $request->date_naissance,
                    'sexeEnfant' => $request->sexeEnfant,
                    'statut' => $request->statut,
                    'parole' => $request->parole,
                    'avs' => $request->avs,
                    'etude' => $request->etude,
                ]);

                if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                    $image->storeAs('public/MesImages', $name);
                    $enfant->photo = $name;
                }

                $tuteur->enfants()->save($enfant);

                if ($request->doctor) {
                    foreach ($request->doctor as $v) {
                        $specialite = new \App\doctor_enfant;
                        $specialite->enfant_id = $enfant->id;
                        $specialite->doctor_id = $v;
                        $specialite->save();
                    }
                }

                return [$tuteur, $enfant];
            });

            Log::info('New beneficiary registered', [
                'user_id' => $tuteur->id,
                'username' => $tuteur->nom_utilisateur,
                'email' => $tuteur->email_tuteur,
                'child_name' => $enfant->nom_enfant . ' ' . $enfant->prenom_enfant,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'message' => 'تم التسجيل بنجاح',
                'user' => $tuteur
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Registration validation failed', [
                'errors' => $e->errors(),
                'account_type' => $request->input('account_type', 'beneficiary'),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'account_type' => $request->input('account_type', 'beneficiary'),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء التسجيل. الرجاء المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $request->user()->currentAccessToken()->delete();

            Log::info('User logged out', [
                'user_id' => $user->id,
                'username' => $user->nom_utilisateur ?? $user->email,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'message' => 'تم تسجيل الخروج بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Logout error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تسجيل الخروج.'
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = $request->user();
            
            // Handle different user types
            if ($user instanceof \App\Tuteur) {
                $id = $user->id;
                $enfant = \App\Enfant::where('tuteur_id', $id)->first();
                $docs = $enfant ? $enfant->doctors()->pluck('doctors.id')->toArray() : [];
                
                return response()->json([
                    'tuteur' => $user,
                    'enfant' => $enfant,
                    'mesDocs' => $docs
                ]);
            } elseif ($user instanceof \App\LoginAdmin) {
                return response()->json([
                    'admin' => $user,
                    'role' => $user->role
                ]);
            }
            
            return response()->json([
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Profile retrieval error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $request->user()->id ?? null,
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تحميل الملف الشخصي.'
            ], 500);
        }
    }

    // Self-service profile update for the currently authenticated admin —
    // any role can reach this (unlike /admin/accounts/{id} which is
    // president-only and lets a president edit *other* admins). Deliberately
    // does not accept a `role` field: an admin cannot change their own role
    // here, avoiding accidental self-lockout.
    public function updateAdminProfile(Request $request)
    {
        try {
            $admin = $request->user();

            if (!($admin instanceof \App\LoginAdmin)) {
                return response()->json([
                    'message' => 'هذه الخدمة مخصصة لحسابات الإدارة فقط.'
                ], 403);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:150|unique:login_admins,email,' . $admin->id,
                'password' => 'nullable|string|min:6|max:100',
            ], [
                'name.required' => 'الاسم مطلوب.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
                'password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل.',
            ]);

            $admin->name = $request->name;
            $admin->email = $request->email;
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }
            $admin->save();

            Log::info('Admin updated own profile', [
                'admin_id' => $admin->id,
                'email' => $admin->email,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'message' => 'تم تحديث الملف الشخصي بنجاح',
                'admin' => $admin
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Admin self profile update validation failed', [
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Admin self profile update error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تحديث الملف الشخصي.'
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $tuteur = $request->user();
            $enfant = \App\Enfant::where('tuteur_id', $tuteur->id)->first();

            $request->validate([
                "nom_tuteur"=>"required|string|max:100",
                "prenom_tuteur"=>"required|string|max:100",
                // nullable, not required: volunteer/admin_request accounts
                // never collect CIN/adresse at registration (see
                // AuthController::register's beneficiary-only branch), so
                // requiring them here blocked those accounts from saving
                // any profile change at all.
                "CIN"=>"nullable|string|max:20|unique:tuteurs,CIN," . $tuteur->id,
                "adresse"=>"nullable|string|max:255",
                "nom_utilisateur"=>"required|string|min:3|max:50|unique:tuteurs,nom_utilisateur," . $tuteur->id,
                "email_tuteur"=>"nullable|email|max:150",
                "telephon"=>"nullable|string|max:20",
                "whatsapp"=>"nullable|string|max:20",
                "region_id"=>"nullable|exists:regions,id",
                "mot_de_pass"=>"nullable|string|min:6|max:100",
                "nom_enfant"=>"nullable|string|max:100",
                "prenom_enfant"=>"nullable|string|max:100",
                "date_naissance"=>"nullable|date|before:today",
                // "1"/"2" (female/male), matching every form that submits this
                // field (Register.jsx, EditProfile.jsx, EditTuteur.jsx) and
                // AdminController's equivalent rule - "male"/"female" here was
                // simply wrong and rejected every real submission.
                "sexeEnfant"=>"nullable|in:1,2",
                "photo"=>"nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048",
            ]);

            $updateData = [
                'nom_tuteur' => $request->input('nom_tuteur'),
                'prenom_tuteur' => $request->input('prenom_tuteur'),
                // tuteurs.adresse/CIN are NOT NULL with no default, but
                // volunteer/admin_request accounts never collect them (they're
                // stored as '' at registration) and the ConvertEmptyStringsToNull
                // middleware turns a blank submitted value into null - coalesce
                // back to '' so the update doesn't violate the column constraint.
                'adresse' => $request->input('adresse') ?? '',
                'CIN' => $request->input('CIN') ?? '',
                'region_id' => $request->input('region_id'),
                'email_tuteur' => $request->input('email_tuteur'),
                'telephon' => $request->input('telephon'),
                'whatsapp' => $request->input('whatsapp'),
                'type_Tuteur' => $request->input('type_Tuteur'),
                'formation' => $request->input('formation'),
                'nom_utilisateur' => $request->input('nom_utilisateur'),
            ];

            // Only hash and update password if provided
            if ($request->filled('mot_de_pass')) {
                $updateData['mot_de_pass'] = Hash::make($request->input('mot_de_pass'));
            }

            // Wrapped in a transaction so a failure partway through (e.g. the
            // enfant update) doesn't leave the tuteur record updated while the
            // rest silently didn't apply.
            DB::transaction(function () use ($request, $tuteur, $enfant, $updateData) {
                $tuteur->update($updateData);

                // volunteer/admin_request accounts have no Enfant row — only
                // beneficiary accounts do. Without this guard, every profile
                // update from a non-beneficiary account throws (member
                // function on null) and 500s.
                if ($enfant) {
                    $enfant->update([
                        'nom_enfant' => $request->input('nom_enfant'),
                        'prenom_enfant' => $request->input('prenom_enfant'),
                        'date_naissance' => $request->input('date_naissance'),
                        'sexeEnfant' => $request->input('sexeEnfant'),
                        'statut' => $request->input('statut'),
                        'parole' => $request->input('parole'),
                        'avs' => $request->input('avs'),
                        'etude' => $request->input('etude'),
                    ]);

                    if ($request->hasFile('photo')) {
                        $image = $request->file('photo');
                        $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                        $image->storeAs('public/MesImages', $name);
                        $enfant->photo = $name;
                        $enfant->save();
                    }

                    $enfant->doctors()->detach();
                    if ($request->doctor) {
                        $enfant->doctors()->attach($request->doctor);
                    }
                }
            });

            Log::info('User profile updated', [
                'user_id' => $tuteur->id,
                'username' => $tuteur->nom_utilisateur,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'message' => 'تم تحديث البيانات بنجاح',
                'user' => $tuteur
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Profile update validation failed', [
                'errors' => $e->errors(),
                'user_id' => $request->user()->id,
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Profile update error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $request->user()->id,
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تحديث الملف الشخصي.'
            ], 500);
        }
    }

    public function adminLogin(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required|email|max:150',
                'mdp' => 'required|string|min:6',
            ]);

            $admin = \App\LoginAdmin::where('email', $request->login)->first();

            if ($admin && Hash::check($request->mdp, $admin->password)) {
                $token = $admin->createToken('admin_token')->plainTextToken;
                $refreshToken = $admin->createToken('refresh_token', ['ability' => 'refresh'])->plainTextToken;

                Log::info('Admin logged in successfully', [
                    'admin_id' => $admin->id,
                    'email' => $admin->email,
                    'role' => $admin->role,
                    'ip' => $request->ip()
                ]);

                return response()->json([
                    'message' => 'تم تسجيل الدخول بنجاح',
                    'is_admin' => true,
                    'token' => $token,
                    'refresh_token' => $refreshToken,
                    'user' => $admin
                ]);
            }

            Log::warning('Admin login attempt failed', [
                'email' => $request->login,
                'admin_exists' => $admin !== null,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.'
            ], 401);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Admin login validation failed', [
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Admin login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function refresh(Request $request)
    {
        try {
            $request->validate([
                'refresh_token' => 'required|string',
            ]);

            // Find the token in the database
            $token = \Laravel\Sanctum\PersonalAccessToken::findToken($request->refresh_token);
            
            if (!$token) {
                Log::warning('Refresh token not found', [
                    'ip' => $request->ip()
                ]);
                return response()->json([
                    'message' => 'رمز التحديث غير صالح'
                ], 401);
            }

            // Check if this is a refresh token
            if (!$token->can('refresh')) {
                Log::warning('Invalid token type for refresh', [
                    'token_id' => $token->id,
                    'ip' => $request->ip()
                ]);
                return response()->json([
                    'message' => 'نوع الرمز غير صالح'
                ], 401);
            }

            $user = $token->tokenable;

            // The tokenable account may have been deleted after the token was
            // issued (e.g. an admin/tuteur removed while still "logged in"
            // elsewhere) — without this check, ->tokens() on null crashes.
            if (!$user) {
                Log::warning('Refresh token has no associated account', [
                    'token_id' => $token->id,
                    'ip' => $request->ip()
                ]);
                $token->delete();
                return response()->json([
                    'message' => 'انتهت صلاحية الجلسة. الرجاء تسجيل الدخول مرة أخرى.'
                ], 401);
            }

            // Delete old tokens
            $user->tokens()->where('id', '!=', $token->id)->delete();
            
            // Create new access token
            $newAccessToken = $user->createToken('auth_token')->plainTextToken;
            $newRefreshToken = $user->createToken('refresh_token', ['ability' => 'refresh'])->plainTextToken;
            
            // Delete old refresh token
            $token->delete();

            Log::info('Token refreshed successfully', [
                'user_id' => $user->id,
                'user_type' => get_class($user),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken,
                'token_type' => 'Bearer'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Token refresh validation failed', [
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'فشل التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Token refresh error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json([
                'message' => 'حدث خطأ أثناء تحديث الجلسة.'
            ], 500);
        }
    }
}
