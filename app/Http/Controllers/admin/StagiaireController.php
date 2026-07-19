<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stagiaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StagiaireController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:stagiaires,email',
            'telephone' => 'required|string',
            'specialite' => 'required|string',
            'etablissement' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        $duree = "من " . $request->date_debut . " إلى " . $request->date_fin;

        $stagiaire = Stagiaire::create([
            'nom_stagiaire'    => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'cin'              => 'STG-' . Str::upper(Str::random(4)), // توليد كود تلقائي لأن الحقل إجباري بجدولك
            'email'            => $request->email,
            'telephone'        => $request->telephone,
            'region_id'        => 1, // قيمة افتراضية حتى لا ترفض قاعدة البيانات الطلب
            'etablissement'    => $request->etablissement,
            'specialite'       => $request->specialite,
            'niveau_etude'     => 'جامعي', // قيمة افتراضية
            'duree_stage'      => $duree,
            'cv_path'          => $cvPath,
            'nom_utilisateur'  => strstr($request->email, '@', true) . rand(10, 99), // اسم مستخدم افتراضي
            // Stagiaires have no self-service login (see CLAUDE.md) — this column is
            // NOT NULL on the table but the value itself must never be shared or guessable.
            'mot_de_pass'      => Hash::make(Str::random(32)),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل طلب التدريب بنجاح!'
        ], 201);
    }
    public function index()
    {
        $stagiaires = Stagiaire::orderBy('created_at', 'desc')->get();
        return response()->json($stagiaires, 200);
    }
    public function destroy($id)
    {
        $stagiaire = Stagiaire::find($id);
        
        if (!$stagiaire) {
            return response()->json(['message' => 'المتدرب غير موجود'], 404);
        }

        $stagiaire->delete();
        return response()->json(['message' => 'تم الحذف بنجاح'], 200);
    }
}