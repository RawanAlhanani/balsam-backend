<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tuteur;
use App\Activite;
use App\Tuteur_Activite;
use App\TypeActivite;
use Illuminate\Support\Facades\DB;



class ActiviteController extends Controller
{
	// liste des activites
	public function index(){
		$activites = Activite::with('typeactivite')->get();

		return view('admin/getActivites', ['activites' => $activites]);
	}

	// ajout activite
	public function addAct(){

		$types =  TypeActivite::all();

		return view('admin/ajoutActivite', ['types' => $types]);
	}

	// Post ajout activite
	public function postAddAct(Request $req){

		$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "type_activite_id"=>"required",
            "date_activite"=>"required",
            "description"=>"required",
            "image_activite"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "type_activite_id.required"=>"    إلزامي !",
	        "date_activite.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !",
	        "image_activite.required"=>"    إلزامي !"        
	        ]
    	);

		$activite = new  Activite([
			'titre' => $req->titre,
			'description' => $req->description,
			'type_activite_id' => $req->type_activite_id,
            'date_activite' => $req->date_activite,
			'ajoutAuxInfos' => $req->ajoutAuxInfos 
		]);

		$image = $req->file('image_activite');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $activite->image_activite = $name;
        }

        $activite->save();

		return redirect()->route('activites');
	}

	// Voir details
    public function detailsActivite($id){

        $activite = Activite::where('id', $id)->with('typeactivite')->first();

        return response()->json(['activite'=>$activite]);
    }

     // modifier info activite
    public function editAct($id)
    {
        //
        $types = TypeActivite::all();
        $activite = Activite::where('id', $id)->with('typeactivite')->first();

        return view('admin/editActivite',['activite' => $activite, 'types'=>$types]);
    }

    public function postEditActivite(Request $req){
    	$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "type_activite_id"=>"required",
            "date_activite"=>"required",
            "description"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "type_activite_id.required"=>"    إلزامي !",
	        "date_activite.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !"      
	        ]
    	);

    	$act = Activite::find($req->id);
    	if($act == null)
    	{
    		return redirect()->route('activites');
    	}
    	$act->titre = $req->titre;
    	$act->description = $req->description;
    	$act->type_activite_id = $req->type_activite_id;
    	$act->date_activite = $req->date_activite;

    	$image = $req->file('image_activite');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $act->image_activite = $name;
        }

        $act->save();

        return redirect()->route('activites');
    }


     // supprimer une activite
    public function supprimerActivite($id){
        $activite = Activite::find($id);
        $activite->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
    
     public function participants($id){
        $participants = Tuteur_Activite::with('Tuteur')
                                        ->with('Tuteur.enfants')
                                        ->with('Tuteur.enfants.doctor_enfants.doctor')
                                        ->where('activite_id', $id)
                                        ->get();
                                        
        $activite = Activite::find($id);

        return view('admin.participants', ['participants'=> $participants, 'activite' => $activite]);
    }
    
    public function supprimerParticipant($id){
        $ids = explode("_", $id);
    //    exit(print_r($ids));
    $part = Tuteur_Activite::where('activite_id', $ids[0])->where('tuteur_id', $ids[1])->first();
  //  exit($part);
    $part->delete();
    return response()->json(['Ok'=>'Ok' ]);
    
    }
}
