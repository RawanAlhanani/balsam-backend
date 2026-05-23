<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;
use Illuminate\Support\Facades\DB;


class InfosController extends Controller
{
	// liste des activites
	public function index(){
		$infos = Info::all();
		return view('admin/getInfos', ['infos' => $infos]);
	}

	// ajout activite
	public function addInfo(){
		return view('admin/ajoutInfo');
	}

	// Post ajout activite
	public function postAddInfo(Request $req){

		$req->validate([
                 // Message Tuteur
            "titre"=>"required",
            "description"=>"required",
            "image_info"=>"required"
	        ],
	        [            
	        "titre.required"=>"    إلزامي !",
	        "description.required"=>"    إلزامي !",
	        "image_info.required"=>"    إلزامي !"        
	        ]
    	);

		$info = new  Info([
			'titre' => $req->titre,
			'description' => $req->description
		]);

		$image = $req->file('image_info');
        if($image != null){
            // Les Photos

            $name = time() .'.'.$image->extension();

           $path = $image->storeAs('public/MesImages', $name);
           
            $info->image_info = $name;
        }

        $info->save();

		return redirect()->route('infos');
	}

	// Voir details
    public function detailsInfo($id){
        $info = Info::where('id', $id)->first();
        return response()->json(['info'=>$info]);
    }

     // modifier info 
    public function editInfo($id)
    {
        $info = Info::where('id', $id)->first();

        return view('admin/editInfo',['info' => $info]);
    }

    public function postEditInfo(Request $req){
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

    	$info = Info::find($req->id);
    	if($info == null)
    	{
    		return redirect()->route('activites');
    	}

    	$info->titre = $req->titre;
    	$info->description = $req->description;

    	$image = $req->file('image_info');
        if($image != null){
            $name = time() .'.'.$image->extension();
        $path = $image->storeAs('public/MesImages', $name);
            $info->image_info = $name;
        }

        $info->save();

        return redirect()->route('infos');
    }


     // supprimer une activite
    public function supprimerInfo($id){
        $info = Info::find($id);
        $info->delete();
        return response()->json(['Ok'=>'Ok' ]);
    }
}