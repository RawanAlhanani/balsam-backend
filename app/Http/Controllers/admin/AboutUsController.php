<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aboutus; // Assuming this is the correct path to your Aboutus model
use Illuminate\Support\Facades\Storage; // Needed for image handling

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
        $validationRules = [
            "titre" => "required",
            "about_image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Assuming image is required on add
            "description" => "nullable|string", // Make description nullable
            "description_json" => "nullable|json", // Add validation for structured content
        ];

        $validationMessages = [
            "titre.required" => "إلزامي !",
            "about_image.required" => "إلزامي !",
            "about_image.image" => "يجب أن تكون صورة!",
            "about_image.mimes" => "صيغ الصورة المدعومة: jpeg, png, jpg, gif, svg",
            "about_image.max" => "حجم الصورة الأقصى 2 ميجابايت",
            // No specific required message for description or description_json, as one will be used
        ];

        $req->validate($validationRules, $validationMessages);

        $pa = new Aboutus();
        $pa->titre = $req->titre;
        $pa->status = $req->status ?? 1; // Default status if not provided

        // Handle structured description
        if ($req->has('description_json') && $req->description_json !== null) {
            $pa->structured_description = json_decode($req->description_json, true);
            $pa->description = null; // Clear old description if structured is used
        } else {
            // Fallback to old description if structured is not provided or is null
            $pa->description = $req->description;
            $pa->structured_description = null; // Clear structured if old description is used
        }

        // Handle image upload
        $image = $req->file('about_image');
        if($image != null){
            $name = time() .'.'.$image->extension();
            $path = $image->storeAs('public/MesImages', $name);
            $pa->about_image = $name;
        }

        $pa->save();

        return redirect()->route('aboutuses');
    }

    // Voir details
    public function detailsAboutUs($id){
        $AboutUs = Aboutus::where('id', $id)->first();
        // The structured_description will be automatically cast to an array/object
        // if the model has $casts = ['structured_description' => 'array']
        return response()->json(['AboutUs' => $AboutUs]);
    }

     // modifier
    public function editAboutUs($id)
    {
        $AboutUs = Aboutus::where('id', $id)->first();
        return view('admin/editAboutUs',['AboutUs' => $AboutUs]);
    }

    public function postEditAboutUs(Request $req){
        $validationRules = [
            "titre" => "required",
            "about_image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Image is nullable on edit
            "description" => "nullable|string", // Make description nullable
            "description_json" => "nullable|json", // Add validation for structured content
        ];

        $validationMessages = [
            "titre.required" => "إلزامي !",
            "about_image.image" => "يجب أن تكون صورة!",
            "about_image.mimes" => "صيغ الصورة المدعومة: jpeg, png, jpg, gif, svg",
            "about_image.max" => "حجم الصورة الأقصى 2 ميجابايت",
        ];

        $req->validate($validationRules, $validationMessages);

        $pa = Aboutus::find($req->id);
        if($pa == null) {
            return redirect()->route('aboutuses');
        }

        $pa->titre = $req->titre;
        $pa->status = $req->status ?? $pa->status; // Update status if provided, otherwise keep existing

        // Handle structured description
        if ($req->has('description_json') && $req->description_json !== null) {
            $pa->structured_description = json_decode($req->description_json, true);
            $pa->description = null; // Clear old description if structured is used
        } else {
            // Fallback to old description if structured is not provided or is null
            $pa->description = $req->description;
            $pa->structured_description = null; // Clear structured if old description is used
        }

        // Handle image upload
        $image = $req->file('about_image');
        if($image != null){
            // Delete old image if exists
            if ($pa->about_image) {
                Storage::disk('public')->delete('MesImages/' . $pa->about_image);
            }
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
        if ($pa) {
            // Delete associated image if exists
            if ($pa->about_image) {
                Storage::disk('public')->delete('MesImages/' . $pa->about_image);
            }
            $pa->delete();
        }
        return response()->json(['Ok'=>'Ok' ]);
    }
}
