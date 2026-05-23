<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ImageExpo;

class ImageExpoController extends Controller
{
	// liste des activites
	public function index(){
		$images = ImageExpo::all();

		return view('admin/getImagesExpos', ['images' => $images]);
	}

	// ajout activite
	public function addImageExpo(){
		return view('admin/ajoutImageExpo');
	}

	// Post ajout activite
	public function postAddImageExpo(Request $req){

		$req->validate([
            "nomImage"=>"required"
	        ],
	        [            
	        "nomImage.required"=>"    إلزامي !"        
	        ]
    	);

		$imageP = new  ImageExpo();

		$image = $req->file('nomImage');

        if($image != null){
            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $imageP->nomImage = $name;
        }

        $imageP->save();

		return redirect()->route('imagesexpos');
	}

     // modifier image 
    public function editImageExpo($id)
    {
        $image = ImageExpo::where('id', $id)->first();

        return view('admin/editImageExpo',['image' => $image]);
    }

    public function postEditImageExpo(Request $req){
    	$req->validate([
                 // Message Tuteur
            "nomImage"=>"required"
	        ],
	        [            
	        "nomImage.required"=>"    إلزامي !"     
	        ]
    	);

    	$imageP = ImageExpo::find($req->id);
    	if($imageP == null)
    	{
    		return redirect()->route('imagesexpos');
    	}

    	$image = $req->file('nomImage');
        if($image != null){
            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $imageP->nomImage = $name;
        }

        $imageP->save();

        return redirect()->route('imagesexpos');
    }


     // supprimer une activite
    public function supprimerImageExpo($id){
        $imageP = ImageExpo::find($id);
        $imageP->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}