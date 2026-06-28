<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Projet; // Correctly using App\Projet based on your clarification
use Illuminate\Support\Facades\Storage; // Needed for image handling

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
		$validationRules = [
            "titre" => "required",
            "projet_image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Image required on add
            "description" => "nullable|string", // Make description nullable
            "description_json" => "nullable|json", // Add validation for structured content
	    ];

        $validationMessages = [
	        "titre.required" => "إلزامي !",
	        "projet_image.required" => "إلزامي !",
            "projet_image.image" => "يجب أن تكون صورة!",
            "projet_image.mimes" => "صيغ الصورة المدعومة: jpeg, png, jpg, gif, svg",
            "projet_image.max" => "حجم الصورة الأقصى 2 ميجابايت",
	    ];

		$req->validate($validationRules, $validationMessages);

		$pa = new Projet();
		$pa->titre = $req->titre;

        // Handle structured description
        if ($req->has('description_json') && $req->description_json !== null) {
            $pa->structured_description = json_decode($req->description_json, true);
            $pa->description = null; // Clear old description if structured is used
        } else {
            // Fallback to old description if structured is not provided or is null
            $pa->description = $req->description;
            $pa->structured_description = null; // Clear structured if old description is used
        }

		$image = $req->file('projet_image');
        if($image != null){
            $name = time() .'.'.$image->extension();
            $path = $image->storeAs('public/MesImages', $name);
            $pa->projet_image = $name;
        }

        $pa->save();

		return redirect()->route('projets');
	}

	// Voir details
    public function detailsProjet($id){
        $projet = Projet::where('id', $id)->first();
        // The structured_description will be automatically cast to an array/object
        // if the model has $casts = ['structured_description' => 'array']
        return response()->json(['projet' => $projet]);
    }

     // modifier
    public function editProjet($id)
    {
        $projet = Projet::where('id', $id)->first();
        return view('admin/editProjet',['projet' => $projet]);
    }

    public function postEditProjet(Request $req){
    	$validationRules = [
            "titre" => "required",
            "projet_image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Image is nullable on edit
            "description" => "nullable|string", // Make description nullable
            "description_json" => "nullable|json", // Add validation for structured content
	    ];

        $validationMessages = [
	        "titre.required" => "إلزامي !",
            "projet_image.image" => "يجب أن تكون صورة!",
            "projet_image.mimes" => "صيغ الصورة المدعومة: jpeg, png, jpg, gif, svg",
            "projet_image.max" => "حجم الصورة الأقصى 2 ميجابايت",
	    ];

		$req->validate($validationRules, $validationMessages);

    	$pa = Projet::find($req->id);
    	if($pa == null) {
    		return redirect()->route('projets');
    	}

        $pa->titre = $req->titre;

        // Handle structured description
        if ($req->has('description_json') && $req->description_json !== null) {
            $pa->structured_description = json_decode($req->description_json, true);
            $pa->description = null; // Clear old description if structured is used
        } else {
            // Fallback to old description if structured is not provided or is null
            $pa->description = $req->description;
            $pa->structured_description = null; // Clear structured if old description is used
        }

    	$image = $req->file('projet_image');
        if($image != null){
            // Delete old image if exists
            if ($pa->projet_image) {
                Storage::disk('public')->delete('MesImages/' . $pa->projet_image);
            }
            $name = time() .'.'.$image->extension();
			$path = $image->storeAs('public/MesImages', $name);
            $pa->projet_image = $name; // Corrected from about_image to projet_image
        }

        $pa->save();

        return redirect()->route('projets');
    }


     // supprimer une activite
    public function supprimerProjet($id){
        $pa = Projet::find($id); // Corrected from Aboutus to Projet
        if ($pa) {
            // Delete associated image if exists
            if ($pa->projet_image) {
                Storage::disk('public')->delete('MesImages/' . $pa->projet_image);
            }
            $pa->delete();
        }
        return response()->json(['Ok'=>'Ok' ]);
    }
}
