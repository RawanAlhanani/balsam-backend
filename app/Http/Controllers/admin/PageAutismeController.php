<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PageAutisme;

class PageAutismeController extends Controller
{
	// liste des activites
	public function index(){
		$PagesAutisme = PageAutisme::all();

		return view('admin/getPagesAutisme', ['PagesAutisme' => $PagesAutisme]);
	}

	// ajout activite
	public function addPageAutisme(){

		return view('admin/ajoutPageAutisme');
	}

	// Post ajout activite
	public function postAddPageAutisme(Request $req){

		$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "description"=>"required",
            "page_image"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !",
	        "page_image.required"=>"    إلزامي !"        
	        ]
    	);

		$pa = new  PageAutisme([
			'titre' => $req->titre,
			'description' => $req->description,
		]);

		$image = $req->file('page_image');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

            $path = $image->storeAs('public/MesImages', $name);
            $pa->page_image = $name;
        }

        $pa->save();

		return redirect()->route('pagesautisme');
	}

	// Voir details
    public function detailsPageAutisme($id){

        $PageAutisme = PageAutisme::where('id', $id)->first();

        return response()->json(['PageAutisme'=>$PageAutisme]);
    }

     // modifier info activite
    public function editPageAutisme($id)
    {
        $PageAutisme = PageAutisme::where('id', $id)->first();

        return view('admin/editPageAutisme',['PageAutisme' => $PageAutisme]);
    }

    public function postEditPageAutisme(Request $req){
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

    	$pa = PageAutisme::find($req->id);
    	if($pa == null)
    	{
    		return redirect()->route('pagesautisme');
    	}
    	$pa->titre = $req->titre;
    	$pa->description = $req->description;

    	$image = $req->file('page_image');
        if($image != null){
            $name = time() .'.'.$image->extension();
			$path = $image->storeAs('public/MesImages', $name);
            $pa->page_image = $name;
        }

        $pa->save();

        return redirect()->route('pagesautisme');
    }


     // supprimer une activite
    public function supprimerPageAutisme($id){
        $pa = PageAutisme::find($id);
        $pa->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}