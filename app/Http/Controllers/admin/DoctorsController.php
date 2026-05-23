<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Doctor;
use Illuminate\Support\Facades\DB;


class DoctorsController extends Controller
{
	// liste des regions
	public function index(){
		$doctors = Doctor::all();
		return view('admin/getDoctors', ['doctors' => $doctors]);
	}

	// ajout 
	public function addDoctor(){
		return view('admin/ajoutDoctor');
	}

	// Post ajout region
	public function postAddDoctor(Request $req){

		$req->validate([
            "specialite"=>"required"
	        ],
	        [            
	        "specialite.required"=>"    إلزامي !"       
	        ]
    	);

		$doc = new Doctor([
			'specialite' => $req->specialite
		]);

        $doc->save();

		return redirect()->route('doctors');
	}

     // modifier region 
    public function editDoctor($id)
    {
        $doc = Doctor::where('id', $id)->first();

        return view('admin/editDoctor',['doctor' => $doc]);
    }

    public function postEditDoctor(Request $req){
    	$req->validate([
            "specialite"=>"required"
	        ],
	        [            
	        "specialite.required"=>"    إلزامي !"     
	        ]
    	);

    	$doc = Doctor::find($req->id);
    	if($doc == null)
    	{
    		return redirect()->route('doctors');
    	}

    	$doc->specialite = $req->specialite;

        $doc->save();

        return redirect()->route('doctors');
    }


     // supprimer une region
    public function supprimerDoctor($id){
    	
        $r = Doctor::find($id);
        $r->delete();

        return response()->json(['Ok'=>'Ok' ]);
    }
}