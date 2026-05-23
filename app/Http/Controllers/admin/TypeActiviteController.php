<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TypeActivite;
use Illuminate\Support\Facades\DB;


class TypeActiviteController extends Controller
{
	// liste des types
	public function index(){
		$types = TypeActivite::all();
		return view('admin/getTypes', ['types' => $types]);
	}

	// ajout 
	public function addType(){
		return view('admin/ajoutType');
	}

	// Post ajout type
	public function postAddType(Request $req){

		$req->validate([
            "nomActivite"=>"required"
	        ],
	        [            
	        "nomActivite.required"=>"    إلزامي !"       
	        ]
    	);

		$type = new TypeActivite([
			'nomActivite' => $req->nomActivite
		]);

        $type->save();

		return redirect()->route('types');
	}

     // modifier type 
    public function editType($id)
    {
        $type = TypeActivite::where('id', $id)->first();

        return view('admin/editType',['type' => $type]);
    }

    public function postEditType(Request $req){
    	$req->validate([
            "nomActivite"=>"required"
	        ],
	        [            
	        "nomActivite.required"=>"    إلزامي !"     
	        ]
    	);

    	$type = TypeActivite::find($req->id);
    	if($type == null)
    	{
    		return redirect()->route('types');
    	}

    	$type->nomActivite = $req->nomActivite;

        $type->save();

        return redirect()->route('types');
    }


     // supprimer une type
    public function supprimerType($id){
    	
        $t = TypeActivite::find($id);
        $t->delete();

        return response()->json(['Ok'=>'Ok' ]);
    }
}