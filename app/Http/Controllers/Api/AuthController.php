<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tuteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'mdp' => 'required',
        ]);

        $tuteur = Tuteur::where('nom_utilisateur', $request->login)->first();

        if (!$tuteur || $tuteur->mot_de_pass !== $request->mdp) {
            return response()->json([
                'message' => 'اسم المستخدم أوكلمة المرور غير صحيحة.'
            ], 401);
        }

        $token = $tuteur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $tuteur
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            "nom_tuteur" => "required",
            "prenom_tuteur" => "required",
            "CIN" => "required",
            "adresse" => "required",
            "region_id" => "required",
            "email_tuteur" => "required|email",
            "telephon" => "required",
            "whatsapp" => "required",
            "nom_utilisateur" => "required|unique:tuteurs,nom_utilisateur",
            "mot_de_pass" => "required",
            "nom_enfant" => "required",
            "prenom_enfant" => "required",
            "date_naissance" => "required",
            "sexeEnfant" => "required",
            "statut" => "required",
            "parole" => "required",
            "avs" => "required",
            "etude" => "required",
            "type_Tuteur" => "required",
            "formation" => "required"
        ]);

        $tuteur = new \App\Tuteur([
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
            'mot_de_pass' => $request->mot_de_pass
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
            $name = time() . '.' . $image->extension();
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

        return response()->json([
            'message' => 'تم التسجيل بنجاح',
            'user' => $tuteur
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function profile(Request $request)
    {
        $id = $request->user()->id;
        $enfant = \App\Enfant::where('tuteur_id', $id)->first();
        $docs = \DB::table('doctor_enfants')->where('enfant_id', $enfant->id)->pluck('doctor_id')->toArray();
        
        return response()->json([
            'tuteur' => $request->user(),
            'enfant' => $enfant,
            'mesDocs' => $docs
        ]);
    }

    public function updateProfile(Request $request)
    {
        $tuteur = $request->user();
        $enfant = \App\Enfant::where('tuteur_id', $tuteur->id)->first();

        $request->validate([
            "nom_tuteur"=>"required",
            "prenom_tuteur"=>"required",
            "CIN"=>"required",
            "adresse"=>"required",
            "nom_utilisateur"=>"required|unique:tuteurs,nom_utilisateur," . $tuteur->id,
        ]);

        $tuteur->update([
            'nom_tuteur' => $request->input('nom_tuteur'),
            'prenom_tuteur' => $request->input('prenom_tuteur'),
            'adresse' => $request->input('adresse'),
            'CIN' => $request->input('CIN'),
            'region_id' => $request->input('region_id'),
            'email_tuteur' => $request->input('email_tuteur'),
            'telephon' => $request->input('telephon'),
            'whatsapp' => $request->input('whatsapp'),
            'type_Tuteur' => $request->input('type_Tuteur'),
            'formation' => $request->input('formation'),
            'nom_utilisateur' => $request->input('nom_utilisateur'),
            'mot_de_pass' => $request->input('mot_de_pass')
        ]);

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
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $enfant->photo = $name;
            $enfant->save();
        }

        \DB::table('doctor_enfants')->where('enfant_id', $enfant->id)->delete();
        if ($request->doctor) {
            foreach ($request->doctor as $v) {
                $specialite = new \App\doctor_enfant;
                $specialite->enfant_id = $enfant->id;
                $specialite->doctor_id = $v;
                $specialite->save();
            }
        }

        return response()->json([
            'message' => 'تم تحديث البيانات بنجاح',
            'user' => $tuteur
        ]);
    }

    public function adminLogin(Request $request)
    {
        $login = $request->input('login');
        $mdp = $request->input('mdp');

        if ($login === 'balsam' && $mdp === 'balsam_02_04') {
            return response()->json([
                'message' => 'Admin logged in',
                'is_admin' => true,
                'token' => 'admin_session_token_placeholder'
            ]);
        }

        return response()->json([
            'message' => 'Login ou mot de passe non valides !!!!'
        ], 401);
    }
}
