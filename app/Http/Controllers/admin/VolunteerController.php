<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller; 
use App\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class VolunteerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_tuteur'         => 'required|string|max:255',
            'prenom_tuteur'      => 'required|string|max:255',
            'email_tuteur'       => 'required|email|unique:volunteers,email_tuteur',
            'region_id'          => 'required|integer',
            'professional_field' => 'required|string',
            'interests'          => 'nullable|array',
            'nom_utilisateur'    => 'required|string|unique:volunteers,nom_utilisateur|max:255',
            'mot_de_pass'        => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $volunteer = Volunteer::create([
            'nom_tuteur'         => $request->nom_tuteur,
            'prenom_tuteur'      => $request->prenom_tuteur,
            'email_tuteur'       => $request->email_tuteur,
            'region_id'          => $request->region_id,
            'professional_field' => $request->professional_field,
            'interests'          => $request->interests, 
            'nom_utilisateur'    => $request->nom_utilisateur,
            'mot_de_pass'        => Hash::make($request->mot_de_pass), 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل المتطوع بنجاح!',
            'data'    => $volunteer
        ], 201);
    }

    /**
     * 2. عرض جميع المتطوعين (Affichage Liste)
     */
    public function index()
    {
        $volunteers = Volunteer::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $volunteers
        ], 200);
    }

    /**
     * 3. عرض بيانات متطوع واحد فقط عبر الـ ID (Affichage Unique)
     */
    public function show($id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json([
                'success' => false,
                'message' => 'المتطوع غير موجود أو قد تم حذفه.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $volunteer
        ], 200);
    }

    /**
     * 4. حذف متطوع (Suppression)
     */
    public function destroy($id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json([
                'success' => false,
                'message' => 'المتطوع غير موجود بالفعل.'
            ], 404);
        }

        $volunteer->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف بيانات المتطوع بنجاح.'
        ], 200);
    }
}