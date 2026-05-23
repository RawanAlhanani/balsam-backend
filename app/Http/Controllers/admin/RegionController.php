<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tuteur;
use App\Activite;
use App\Region;
use Illuminate\Support\Facades\DB;


class RegionController extends Controller
{
	// liste des regions
	public function index(){
		$regions = Region::all();
		return view('admin/getRegions', ['regions' => $regions]);
	}

	// ajout 
	public function addRegion(){
		return view('admin/ajoutRegion');
	}

	// Post ajout region
	public function postAddRegion(Request $req){

		$req->validate([
            "nom_region"=>"required"
	        ],
	        [            
	        "nom_region.required"=>"    إلزامي !"       
	        ]
    	);

		$region = new Region([
			'nom_region' => $req->nom_region
		]);

        $region->save();

		return redirect()->route('regions');
	}

     // modifier region 
    public function editRegion($id)
    {
        $region = Region::where('id', $id)->first();

        return view('admin/editRegion',['region' => $region]);
    }

    public function postEditRegion(Request $req){
    	$req->validate([
            "nom_region"=>"required"
	        ],
	        [            
	        "nom_region.required"=>"    إلزامي !"     
	        ]
    	);

    	$reg = Region::find($req->id);
    	if($reg == null)
    	{
    		return redirect()->route('regions');
    	}

    	$reg->nom_region = $req->nom_region;

        $reg->save();

        return redirect()->route('regions');
    }


     // supprimer une region
    public function supprimerRegion($id){
    	
        $r = Region::find($id);
        $r->delete();

        return response()->json(['Ok'=>'Ok' ]);
    }
}