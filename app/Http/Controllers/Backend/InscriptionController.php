<?php

namespace App\Http\Controllers\Backend;

use App\doctor_enfant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tuteur;
use App\Enfant;
use App\Doctor;
use App\Region;
use Illuminate\Support\Facades\DB;
class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specialites = Doctor::all();
        $regions = Region::all();

        return view('inscription', ['specialites'=>$specialites, 'regions'=>$regions]);
    }

    public function inscrire(Request $request)
    {

        $request->validate([
                 // Message Tuteur
            "nom_tuteur"=>"required",
            "prenom_tuteur"=>"required",
            "CIN"=>"required",
            "adresse"=>"required",
            "region"=>"required",
            "email_tuteur"=>"required",
            "telephon"=>"required",
            "whatsapp"=>"required",
            "nom_utilisateur"=>"required",
            "mot_de_pass"=>"required",
                // Message Enfant
            "nom_enfant"=>"required",
            "prenom_enfant"=>"required",
            "date_naissance"=>"required",
            "sexeEnfant"=>"required",
        //    "photo"=>"required",
            "statut"=>"required",
            "parole"=>"required",
            "avs"=>"required",
            "etude"=>"required",
            "type_Tuteur"=>"required",
            "formation"=>"required"
        ],
        [            
                // Message Tuteur
        "nom_tuteur.required"=>"  الاسم الشخصي إلزامي ! ",
        "prenom_tuteur.required"=>"الاسم العائلي إلزامي !",
        "CIN.required"=>"رقم البطاقة الوطنية إلزامي !",
        "adresse.required"=>"عنوان السكن إلزامي !",
        "region.required"=>"المنطقة إلزامية !",
        "email_tuteur.required"=>"البريد الإلكتروني إلزامي !",
     //   "email_tuteur.email"=>"البريد الإلكتروني إلزامي !",
        "telephon.required"=>"رقم الهاتف إلزامي !",
        "whatsapp.required"=>"رقم الواتساب إلزامي !",
        "nom_utilisateur.required"=>"اسم المستخدم إلزامي !",
        "mot_de_pass.required"=>"كلمة السر إلزامية !",
        "type_tuteur.required"=>"    إلزامي !",
        "formation.required"=>"    إلزامي !",
                // Message Enfant
        "nom_enfant.required"=>" الاسم الشخصي للطفل إلزامي !",
        "prenom_enfant.required"=>" الاسم العائلي للطفل إلزامي !",
        "date_naissance.required"=>" تاريخ الازدياد إلزامي !",
        "photo.required"=>"   صورة الطفل إلزامية !",
        "statut.required"=>"   حالة الطفل إلزامية !",
        "parole.required"=>"    إلزامي !",
        "sexeEnfant.required"=>"    إلزامي !",
        "avs.required"=>"    إلزامي !",
        "etude.required"=>"    إلزامي !",
        "type_Tuteur.required"=>"    إلزامي !",
        "formation.required"=>"    إلزامي !"        
        ]
    );


        //
        $nve = new Tuteur([
        'nom_tuteur'=>$request->nom_tuteur,
        'prenom_tuteur'=>$request->prenom_tuteur,
        'adresse'=>$request->adresse,
        'CIN'=>$request->CIN,
        'region_id'=>$request->region,
        'email_tuteur'=>$request->email_tuteur,
        'telephon'=>$request->telephon,
        'whatsapp'=>$request->whatsapp,
        'type_Tuteur'=>$request->type_Tuteur,
        'formation'=>$request->formation,
        'nom_utilisateur'=>$request->nom_utilisateur,
        'mot_de_pass'=>$request->mot_de_pass
        ]);

        $nve2 = new Enfant;
        $nve2->nom_enfant=$request->nom_enfant;
        $nve2->prenom_enfant=$request->prenom_enfant;
        $nve2->date_naissance=$request->date_naissance;
        $nve2->sexeEnfant=$request->sexeEnfant;

        $image = $request->file('photo');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $nve2->photo = $name;
        }

        $nve2->statut=$request->statut;
        $nve2->parole=$request->parole;
        $nve2->avs=$request->avs;
        $nve2->etude=$request->etude;

        $nve->save();
        $nve->enfants()->save($nve2);

        $specialite = new doctor_enfant; 

        $spes = $request->doctor;

        foreach($spes as $v ){
            $specialite = new doctor_enfant;
            $specialite->enfant_id = $nve2->id;
            $specialite->doctor_id = $v;
            $specialite->save();
        }

        return redirect()->route('Login')->with(['msg1' => 'تم التسجيل بنجاح']);//->back();
    }

    public function edit_profile($id)
    {
        $regions = Region::all();
        $specialites = Doctor::all();

        $enfant = Enfant::where('tuteur_id', $id)->with('Tuteur')->first();
        $docs =DB::table('doctor_enfants')->select('doctor_id')
                                          ->where('enfant_id', $enfant->id)
                                          ->get()
                                          ->toArray();
        if(count($docs) != 0){
            foreach($docs as $value){
                $mesDocs[] = $value->doctor_id ;
            }
        }
        else
            $mesDocs = [];
            

        return view('editProfile',['enfant' => $enfant, 'specialites'=>$specialites, 'mesDocs'=> $mesDocs, 'regions'=>$regions]);
    }

    public function postEdit_profile(Request $request){

        $enfant = Enfant::find($request->input('id'));

        $enfant->nom_enfant=$request->nom_enfant;
        $enfant->prenom_enfant=$request->prenom_enfant;
        $enfant->date_naissance=$request->date_naissance;
        $enfant->sexeEnfant=$request->sexeEnfant;
        $enfant->statut=$request->statut;
        $enfant->parole=$request->parole;
        $enfant->avs=$request->avs;
        $enfant->etude=$request->etude;
        // photo
        $image = $request->file('photo');
        if($image != null){
            $name = time() . '_' .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $enfant->photo = $name;
        }

        $enfant->save();

        $tuteur = Tuteur::find($request->input('id_tuteur'));

        $tuteur->nom_tuteur = $request->nom_tuteur;
        $tuteur->prenom_tuteur = $request->prenom_tuteur;
        $tuteur->adresse=$request->adresse;
        $tuteur->CIN=$request->CIN;
        $tuteur->region_id=$request->region_id;
        $tuteur->email_tuteur=$request->email_tuteur;
        $tuteur->telephon=$request->telephon;
        $tuteur->whatsapp=$request->whatsapp;
        $tuteur->type_Tuteur=$request->type_Tuteur;
        $tuteur->formation=$request->formation;
        $tuteur->nom_utilisateur=$request->nom_utilisateur;
        $tuteur->mot_de_pass=$request->mot_de_pass;

        $tuteur->save();

        // doctors
        // supprimer les anciens
        $specialites_anciennes = doctor_enfant::where('enfant_id', $request->input('id'))->delete();

        $spes = $request->doctor;
        foreach($spes as $v ){
            $specialite = new doctor_enfant;
            $specialite->enfant_id = $enfant->id;
            $specialite->doctor_id = $v;
            $specialite->save();
        }

        return redirect()->route('home');

    }

}
