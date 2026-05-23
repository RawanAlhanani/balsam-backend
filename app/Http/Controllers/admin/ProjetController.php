<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Projet;

class ProjetController extends Controller
{
	// liste
	public function index(){
		$projets = Projet::all();
		return view('admin/getProjets', ['projets' => $projets]);
	}

	// ajout 
	public function addProjet(){

		return view('admin/ajoutProjet');
	}

	// Post ajout 
	public function postAddProjet(Request $req){

		$req->validate([
                 // Message
            "titre"=>"required",
            "description"=>"required",
            "projet_image"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !",
	        "projet_image.required"=>"    إلزامي !"        
	        ]
    	);

		$pa = new  Projet([
			'titre' => $req->titre,
			'description' => $req->description,
			'status' => $req->status 
		]);

		$image = $req->file('projet_image');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $pa->projet_image = $name;
        }

        $pa->save();

		return redirect()->route('projets');
	}

	// Voir details
    public function detailsProjet($id){

        $projet= Projet::where('id', $id)->first();

        return response()->json(['projet'=>$projet]);
    }

     // modifier 
    public function editProjet($id)
    {
        $projet = Projet::where('id', $id)->first();

        return view('admin/editProjet',['projet' => $projet]);
    }

    public function postEditProjet(Request $req){
    	$req->validate([
            
            "description"=>"required"
	        ],
	        [            
	           "description.required"=>"    إلزامي !"      
	        ]
    	);

    	$pa = Projet::find($req->id);
    	if($pa == null)
    	{
    		return redirect()->route('projets');
    	}
    	$pa->titre = $req->titre;
    	$pa->description = $req->description;

    	$image = $req->file('projet_image');
        if($image != null){
            $name = time() .'.'.$image->extension();
			$path = $image->storeAs('public/MesImages', $name);
            $pa->about_image = $name;
        }

        $pa->save();

        return redirect()->route('projets');
    }


     // supprimer une activite
    public function supprimerProjet($id){
        $pa = Aboutus::find($id);
        if(Storage::delete($pa->projet_image))
            $pa->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}