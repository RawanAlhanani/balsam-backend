<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Activite;
use App\TypeActivite;
use App\Tuteur_Activite;
use App\Info;
use App\Partenaire;
use App\Region;
use App\Doctor;
use App\ImagesPrincipales;
use App\ImageExpo;
use App\PageAutisme;
use App\Aboutus;
use App\Projet;
use App\Models\StaticPage;


class AdminController extends Controller
{
    // Activities
    public function getActivities() {
        return response()->json(Activite::with('typeactivite')->get());
    }
public function updateActivity(Request $request, $id)
    {
        $request->validate([
            "titre" => "required",
            "type_activite_id" => "required",
            "date_activite" => "required|date",
            "description" => "required",
            "image_activite" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Optional for update
        ]);

        try {
            $activite = Activite::findOrFail($id);

            $activite->titre = $request->titre;
            $activite->description = $request->description;
            $activite->type_activite_id = $request->type_activite_id;
            $activite->date_activite = $request->date_activite;

            if ($request->hasFile('image_activite')) {
                // Delete old image if exists
                if ($activite->image_activite) {
                    // Storage::delete('public/MesImages/' . $activite->image_activite); // Uncomment if you manage storage
                }
                $image = $request->file('image_activite');
                $name = time() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $activite->image_activite = $name;
            }
            $activite->save();
                    return response()->json(['message' => 'Activity updated successfully.', 'data' => $activite]);
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                    return response()->json(['message' => 'Activity not found.'], 404);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'Error updating activity: ' . $e->getMessage()], 500);
                }
            }


    public function getTypes() {
        return response()->json(TypeActivite::all());
    }
    public function getSingleStaticPage($type, $id) // Added $type parameter
    {
        try {
            $page = null;
            if ($type === 'about') {
                $page = Aboutus::findOrFail($id);
            } elseif ($type === 'autism') {
                $page = PageAutisme::findOrFail($id);
            } elseif ($type === 'projects') {
                $page = Projet::findOrFail($id);
            } else {
                return response()->json(['message' => 'Invalid static page type.'], 400);
            }

            return response()->json($page);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Static page not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function storeActivity(Request $request) {
        $request->validate([
            "titre" => "required",
            "type_activite_id" => "required",
            "date_activite" => "required",
            "description" => "required",
        ]);

        $activite = new Activite([
            'titre' => $request->titre,
            'description' => $request->description,
            'type_activite_id' => $request->type_activite_id,
            'date_activite' => $request->date_activite,
        ]);

        if ($request->hasFile('image_activite')) {
            $image = $request->file('image_activite');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $activite->image_activite = $name;
        }

        $activite->save();
        return response()->json(['message' => 'Success', 'data' => $activite]);
    }

    public function deleteActivity($id) {
        Activite::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // News (Infos)
    public function getNews() {
        return response()->json(Info::all());
    }

    public function storeNews(Request $request) {
        $request->validate(["titre" => "required", "description" => "required"]);
        $info = new Info($request->all());
        if ($request->hasFile('image_info')) {
            $image = $request->file('image_info');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $info->image_info = $name;
        }
        $info->save();
        return response()->json(['message' => 'Success']);
    }
 public function updateNews(Request $request, $id)
    {
        $request->validate([
            "titre" => "required",
            "description" => "required",
            "image_info" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Optional for update
        ]);

        try {
            $info = Info::findOrFail($id);

            $info->titre = $request->titre;
            $info->description = $request->description;

            if ($request->hasFile('image_info')) {
                // Delete old image if exists
                if ($info->image_info) {
                    // Storage::delete('public/MesImages/' . $info->image_info); // Uncomment if you manage storage
                }
                $image = $request->file('image_info');
                $name = time() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $info->image_info = $name;
            }
             $info->save();
                    return response()->json(['message' => 'News updated successfully.', 'data' => $info]);
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                    return response()->json(['message' => 'News not found.'], 404);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'Error updating news: ' . $e->getMessage()], 500);
                }
            }

    public function deleteNews($id) {
        Info::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Partners
    public function getPartners() {
        return response()->json(Partenaire::all());
    }

    public function storePartner(Request $request) {
        $request->validate(["nomPartenaire" => "required", "imagePartenaire" => "required"]);
        $partner = new Partenaire(['nomPartenaire' => $request->nomPartenaire]);
        if ($request->hasFile('imagePartenaire')) {
            $image = $request->file('imagePartenaire');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $partner->imagePartenaire = $name;
        }
        $partner->save();
        return response()->json(['message' => 'Success']);
    }
  public function updatePartner(Request $request, $id)
    {
        $request->validate([
            "nomPartenaire" => "required",
            "imagePartenaire" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Optional for update
        ]);

        try {
            $partner = Partenaire::findOrFail($id);

            $partner->nomPartenaire = $request->nomPartenaire;

            if ($request->hasFile('imagePartenaire')) {
                // Delete old image if exists
                if ($partner->imagePartenaire) {
                    // Storage::delete('public/MesImages/' . $partner->imagePartenaire); // Uncomment if you manage storage
                }
                $image = $request->file('imagePartenaire');
                $name = time() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $partner->imagePartenaire = $name;
            }

            $partner->save();
            return response()->json(['message' => 'Partner updated successfully.', 'data' => $partner]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Partner not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating partner: ' . $e->getMessage()], 500);
        }
    }

    public function deletePartner($id) {
        Partenaire::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Slider Images
    public function getSliders() {
        return response()->json(ImagesPrincipales::all());
    }

    public function storeSlider(Request $request) {
        $request->validate(["image" => "required"]);
        $slider = new ImagesPrincipales();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $slider->nomImage = $name;
        }
        $slider->save();
        return response()->json(['message' => 'Success']);
    }

    public function deleteSlider($id) {
        ImagesPrincipales::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Gallery (Expo)
    public function getGallery() {
        return response()->json(ImageExpo::all());
    }

    public function storeGallery(Request $request) {
        $request->validate(["image" => "required"]);
        $expo = new ImageExpo();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            $expo->nomImage = $name;
        }
        $expo->save();
        return response()->json(['message' => 'Success']);
    }

    public function deleteGallery($id) {
        ImageExpo::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Static Pages (About, Autism, Projects)
    public function getStaticPages() {
        $abouts = Aboutus::all();
        $autisms = PageAutisme::all();
        $projects = Projet::all();

        // Build unified items list with a `type` field for each item
        $items = collect([]);
        $abouts->each(function($p) use (&$items) { $items->push(array_merge($p->toArray(), ['type' => 'about'])); });
        $autisms->each(function($p) use (&$items) { $items->push(array_merge($p->toArray(), ['type' => 'autism'])); });
        $projects->each(function($p) use (&$items) { $items->push(array_merge($p->toArray(), ['type' => 'projects'])); });

        return response()->json([
            'about' => $abouts,
            'autism' => $autisms,
            'projects' => $projects,
            'items' => $items,
        ]);
    }

    public function storeStaticPage(Request $request) {
        $request->validate(["type" => "required", "titre" => "required"]);
        $type = $request->type;

        // Prepare base data
        $data = ['titre' => $request->titre];

        // Handle description: either legacy string or structured JSON
        if ($type === 'autism') {
            // description_json may be passed as a JSON string
            $descJson = $request->input('description_json');
            if ($descJson) {
                // Ensure it's valid JSON before saving
                $decoded = json_decode($descJson, true);
                $data['description_json'] = $decoded ?: null;
                // Also set a fallback plain description (first section text)
                if (is_array($decoded) && isset($decoded['sections'][0]['text'])) {
                    $data['description'] = $decoded['sections'][0]['text'];
                } else {
                    $data['description'] = $request->input('description', '');
                }
            } else {
                $data['description'] = $request->input('description', '');
            }
        } else {
            $data['description'] = $request->input('description', '');
        }

        // If id provided, update existing page
        if ($request->has('id')) {
            $existingId = $request->id;
            if ($type === 'about') $page = Aboutus::find($existingId);
            elseif ($type === 'autism') $page = PageAutisme::find($existingId);
            else $page = Projet::find($existingId);

            if (!$page) {
                return response()->json(['message' => 'Not found'], 404);
            }
            $page->titre = $data['titre'];
        } else {
            if ($type === 'about') $page = new Aboutus($data);
            elseif ($type === 'autism') $page = new PageAutisme($data);
            else $page = new Projet($data);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/MesImages', $name);
            if ($type === 'projects') $page->projet_image = $name;
            elseif ($type === 'about') $page->about_image = $name;
            elseif ($type === 'autism') $page->page_image = $name;
        }

        // If description_json provided as array in $data, ensure saving as JSON in model
        if (isset($data['description_json'])) {
            $page->description_json = $data['description_json'];
        }

        $page->description = $data['description'] ?? '';
        $page->save();
        return response()->json(['message' => 'Success']);
    }

    public function deleteStaticPage($type, $id) {
        if ($type === 'about') $page = Aboutus::find($id);
        elseif ($type === 'autism') $page = PageAutisme::find($id);
        else $page = Projet::find($id);

        if (!$page) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $page->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Admin Accounts
    public function getAdmins() {
        return response()->json(\App\LoginAdmin::all());
    }

    public function storeAdmin(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:login_admins,email",
            "password" => "required",
            "role" => "required"
        ]);
        $admin = new \App\LoginAdmin($request->all());
        $admin->password = \Hash::make($request->password);
        $admin->save();
        return response()->json(['message' => 'Success']);
    }

    public function deleteAdmin($id) {
        \App\LoginAdmin::find($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function deleteTuteur($id) {
        $tuteur = \App\Tuteur::find($id);
        if ($tuteur) {
            $tuteur->enfants()->delete();
            $tuteur->delete();
        }
        return response()->json(['message' => 'Deleted']);
    }

    // Regions
    public function getRegions() {
        return response()->json(Region::all());
    }

    // Specialities (Doctors)
    public function getDoctors() {
        return response()->json(Doctor::all());
    }

    // Generic Stats for Dashboard
    public function getStats() {
        return response()->json([
            'tuteurs_count' => \App\Tuteur::count(),
            'activites_count' => Activite::count(),
            'news_count' => Info::count(),
            'partenaires_count' => Partenaire::count(),
        ]);
    }
 // Activity Types
    public function storeType(Request $request)
    {
        $request->validate([
            'nomActivite' => 'required|string|max:255|unique:type_activites,nomActivite',
        ]);

        try {
            $type = TypeActivite::create([
                'nomActivite' => $request->nomActivite,
            ]);
            return response()->json(['message' => 'Activity type added successfully.', 'type' => $type], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding activity type: ' . $e->getMessage()], 500);
        }
    }
 public function updateType(Request $request, $id)
    {
        $request->validate([
            'nomActivite' => 'required|string|max:255|unique:type_activites,nomActivite,' . $id,
        ]);

        try {
            $type = TypeActivite::findOrFail($id);
            $type->nomActivite = $request->nomActivite;
            $type->save();
            return response()->json(['message' => 'Activity type updated successfully.', 'type' => $type]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Activity type not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating activity type: ' . $e->getMessage()], 500);
        }
    }
  public function deleteType($id)
     {
         try {
             $type = TypeActivite::findOrFail($id);
             $type->delete();
             return response()->json(['message' => 'Activity type deleted successfully.']);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return response()->json(['message' => 'Activity type not found.'], 404);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Error deleting activity type: ' . $e->getMessage()], 500);
         }
     }

    // Regions
    public function storeRegion(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255|unique:regions,nom_region',
        ]);

        try {
            $region = Region::create([
                'nom_region' => $request->nom_region,
            ]);
            return response()->json(['message' => 'Region added successfully.', 'region' => $region], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding region: ' . $e->getMessage()], 500);
        }
    }

    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255|unique:regions,nom_region,' . $id,
        ]);

        try {
            $region = Region::findOrFail($id);
            $region->nom_region = $request->nom_region;
            $region->save();

            return response()->json(['message' => 'Region updated successfully.', 'region' => $region]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Region not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating region: ' . $e->getMessage()], 500);
        }
    }
public function deleteRegion($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->delete();
            return response()->json(['message' => 'Region deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Region not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting region: ' . $e->getMessage()], 500);
        }
    }

    // Doctors (Specialities)
    public function storeDoctor(Request $request)
    {
        $request->validate([
            'specialite' => 'required|string|max:255|unique:doctors,specialite',
        ]);

        try {
            $doctor = Doctor::create([
                'specialite' => $request->specialite,
            ]);
            return response()->json(['message' => 'Doctor speciality added successfully.', 'doctor' => $doctor], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding doctor speciality: ' . $e->getMessage()], 500);
        }
    }
 public function updateDoctor(Request $request, $id)
    {
        $request->validate([
            'specialite' => 'required|string|max:255|unique:doctors,specialite,' . $id,
        ]);

        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->specialite = $request->specialite;
            $doctor->save();

            return response()->json(['message' => 'Doctor speciality updated successfully.', 'doctor' => $doctor]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Doctor speciality not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating doctor speciality: ' . $e->getMessage()], 500);
        }
    }
  public function deleteDoctor($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            return response()->json(['message' => 'Doctor speciality deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Doctor speciality not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting doctor speciality: ' . $e->getMessage()], 500);
        }
    }



}
