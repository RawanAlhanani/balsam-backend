<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ImagesPrincipales;

class ImagesPrincipalesController extends Controller
{
	// liste des activites
	public function index(){
		$images = ImagesPrincipales::all();

		return view('admin/getImagesPrincipales', ['images' => $images]);
	}

	// ajout activite
	public function addImagesPrincipales(){
		return view('admin/ajoutImagesPrincipales');
	}

	// Post ajout activite
	public function postAddImagesPrincipales(Request $req){

		$req->validate([
            "nomImage"=>"required"
	        ],
	        [            
	        "nomImage.required"=>"    إلزامي !"        
	        ]
    	);

		$imageP = new  ImagesPrincipales();

		$image = $req->file('nomImage');

        if($image != null){
            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $imageP->nomImage = $name;
        }

        $imageP->save();

		return redirect()->route('imagesprincipales');
	}

     // modifier image 
    public function editImagesPrincipales($id)
    {
        $image = ImagesPrincipales::where('id', $id)->first();

        return view('admin/editImagesPrincipales',['image' => $image]);
    }

    public function postEditImagesPrincipales(Request $req){
    	$req->validate([
                 // Message Tuteur
            "nomImage"=>"required"
	        ],
	        [            
	        "nomImage.required"=>"    إلزامي !"     
	        ]
    	);

    	$imageP = ImagesPrincipales::find($req->id);
    	if($imageP == null)
    	{
    		return redirect()->route('imagesprincipales');
    	}

    	$image = $req->file('nomImage');
        if($image != null){
            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $imageP->nomImage = $name;
        }

        $imageP->save();

        return redirect()->route('imagesprincipales');
    }


     // supprimer une activite
    public function supprimerImagesPrincipales($id){
        $imageP = ImagesPrincipales::find($id);
        $imageP->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}