<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Doctor;
use App\doctor_enfant;
use App\Tuteur;
use App\Enfant;
use App\Region;
use Illuminate\Support\Facades\DB;
use Session;


class TuteurController extends Controller
{

    //get : retourner le formulaire
    public function getTuteurs()
    {


        $enfants = Enfant::with('Tuteur')
                        ->get();

        return view('admin/tuteurs', ['enfants' => $enfants]);

    }

    // modifier info tuteur
    public function edit($id)
    {
        //
        $regions = Region::all();
        $specialites = Doctor::all();
        $enfant = Enfant::where('id', $id)->with('Tuteur')->first();
        $docs =DB::table('doctor_enfants')->select('doctor_id')
                                          ->where('enfant_id', $id)
                                          ->get()
                                          ->toArray();
        $mesDocs = [];
        foreach($docs as $value){
            $mesDocs[] = $value->doctor_id ;
        }
        
        return view('admin/editTuteur',['enfant' => $enfant, 'specialites'=>$specialites, 'mesDocs'=> $mesDocs, 'regions'=>$regions]);
    }

    public function posteditTuteur(Request $request){

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

        return redirect()->route('tuteurs');

    }

    // Voir details
    public function detailsTuteur($id){

        $enfant = Enfant::where('id', $id)->with('Tuteur')->with('Tuteur.region')->first();
        $docs =doctor_enfant::with('doctor') 
                  ->where('enfant_id', $id)
                  ->get();

        $mesDocs = [];
        foreach($docs as $value){
            $mesDocs[] = $value->doctor->specialite ;
        }
        
        return response()->json(['enfant'=>$enfant, 'docs'=>$mesDocs]);
    }

    // supprimer un tuteur et ses details
    public function supprimerTuteur($id){
        $ids = explode("_", $id)  ;

        // enfant
        $enfant = Enfant::find($ids[0]);
        $enfant->delete();

        // doctors
        $specialites_anciennes = doctor_enfant::where('enfant_id', $ids[0])->delete();

        // tuteur
        $tuteur = Tuteur::find($ids[1]);
        $tuteur->delete();

        return response()->json(['Ok'=>'Ok' ]);
    }

}


