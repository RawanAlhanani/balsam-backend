<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aboutus;

class AboutUsController extends Controller
{
	// liste
	public function index(){
		$Aboutuses = Aboutus::all();
		return view('admin/getAboutUses', ['Aboutuses' => $Aboutuses]);
	}

	// ajout 
	public function addAboutUs(){

		return view('admin/ajoutAboutUs');
	}

	// Post ajout 
	public function postAddAboutUs(Request $req){

		$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "description"=>"required",
            "about_image"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !",
	        "about_image.required"=>"    إلزامي !"        
	        ]
    	);

		$pa = new  Aboutus([
			'titre' => $req->titre,
			'description' => $req->description,
			'status' => $req->status 
		]);

		$image = $req->file('about_image');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $pa->about_image = $name;
        }

        $pa->save();

		return redirect()->route('aboutuses');
	}

	// Voir details
    public function detailsAboutUs($id){

        $AboutUs= Aboutus::where('id', $id)->first();

        return response()->json(['AboutUs'=>$AboutUs]);
    }

     // modifier 
    public function editAboutUs($id)
    {
        $AboutUs = Aboutus::where('id', $id)->first();

        return view('admin/editAboutUs',['AboutUs' => $AboutUs]);
    }

    public function postEditAboutUs(Request $req){
    	$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "description"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !"      
	        ]
    	);

    	$pa = Aboutus::find($req->id);
    	if($pa == null)
    	{
    		return redirect()->route('aboutuses');
    	}
    	$pa->titre = $req->titre;
    	$pa->description = $req->description;

    	$image = $req->file('about_image');
        if($image != null){
            $name = time() .'.'.$image->extension();
			$path = $image->storeAs('public/MesImages', $name);
            $pa->about_image = $name;
        }

        $pa->save();

        return redirect()->route('aboutuses');
    }


     // supprimer une activite
    public function supprimerAboutUs($id){
        $pa = Aboutus::find($id);
        $pa->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}