<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Partenaire;
use Illuminate\Support\Facades\DB;


class PartenaireController extends Controller
{
	// liste des activites
	public function index(){
		$partenaires = Partenaire::all();
		return view('admin/getPartenaires', ['partenaires' => $partenaires]);
	}

	// ajout activite
	public function addPartenaire(){
		return view('admin/ajoutPartenaire');
	}

	// Post ajout activite
	public function postAddPartenaire(Request $req){

		$req->validate([
                 // Message Tuteur
            "nomPartenaire"=>"required",
            "imagePartenaire"=>"required"
	        ],
	        [            
	        "nomPartenaire.required"=>"    إلزامي !",
	        "imagePartenaire.required"=>"    إلزامي !"      
	        ]
    	);

		$partenaire = new  Partenaire([
			'nomPartenaire' => $req->nomPartenaire,
			'imagePartenaire' => $req->imagePartenaire
		]);

		$image = $req->file('imagePartenaire');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path =  $image->storeAs('public/MesImages', $name);
            $partenaire->imagePartenaire = $name;
        }

        $partenaire->save();

		return redirect()->route('partenaires');
	}

	// Voir details
    public function detailsPartenaire($id){
        $partenaire = Partenaire::where('id', $id)->first();
        return response()->json(['partenaire'=>$partenaire]);
    }

     // modifier partenaire
    public function editPartenaire($id)
    {
        $partenaire = Partenaire::where('id', $id)->first();

        return view('admin/editPartenaire',['partenaire' => $partenaire]);
    }

    public function postEditPartenaire(Request $req){
    	$req->validate([
                 // Message Tuteur
            "nomPartenaire"=>"required"
	        ],
	        [            
	        "nomPartenaire.required"=>"    إلزامي !"      
	        ]
    	);

    	$partenaire = Partenaire::find($req->id);
    	if($partenaire == null)
    	{
    		return redirect()->route('partenaires');
    	}

    	$partenaire->nomPartenaire = $req->nomPartenaire;

    	$image = $req->file('imagePartenaire');
        if($image != null){
            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $partenaire->imagePartenaire = $name;
        }

        $partenaire->save();

        return redirect()->route('partenaires');
    }


     // supprimer une activite
    public function supprimerPartenaire($id){
        $partenaire = Partenaire::find($id);
        $partenaire->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}