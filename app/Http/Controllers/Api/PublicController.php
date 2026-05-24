<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activite;
use App\Info;
use App\ImagesPrincipales;
use App\ImageExpo;
use App\Aboutus;
use App\Projet;
use App\Partenaire;
use App\PageAutisme;

class PublicController extends Controller
{
    public function getHomeData()
    {
        $news = Info::orderBy('updated_at', 'desc')
                ->take(3)
                ->get();

        $images = ImagesPrincipales::all();
        $imagesexpos = ImageExpo::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        $aboutuses = Aboutus::where('status', 1)->get();
        $projetsPrincipale = Projet::where('status', 1)->get();

        return response()->json([
            'news' => $news,
            'slider_images' => $images,
            'gallery_images' => $imagesexpos,
            'about_us' => $aboutuses,
            'projects' => $projetsPrincipale
        ]);
    }

    public function getAbout()
    {
        $aboutuses = Aboutus::where('status', 1)->get();
        return response()->json($aboutuses);
    }

    public function getProjects()
    {
        $projects = Projet::where('status', 1)->get();
        return response()->json($projects);
    }

    public function getProject($id)
    {
        $project = Projet::find($id);
        return response()->json($project);
    }

    public function getNews()
    {
        $news = Info::orderBy('created_at', 'DESC')->get();
        return response()->json($news);
    }

    public function getSingleNews($id)
    {
        $news = Info::find($id);
        $latest_news = Info::where('id', '!=', $id)->orderBy('updated_at', 'desc')->take(4)->get();
        return response()->json([
            'news' => $news,
            'latest_news' => $latest_news
        ]);
    }

    public function getActivities()
    {
        $activities = Activite::orderBy('date_activite', 'DESC')->with('typeactivite')->get();
        return response()->json($activities);
    }

    public function getActivity($id)
    {
        $activity = Activite::where('id', $id)->with('typeactivite')->first();
        $latest_activities = Activite::where('id', '!=', $id)->orderBy('updated_at', 'desc')->take(4)->get();
        return response()->json([
            'activity' => $activity,
            'latest_activities' => $latest_activities
        ]);
    }

    public function getPartenaires()
    {
        $partenaires = Partenaire::all();
        return response()->json($partenaires);
    }

    public function getPhotos()
    {
        $photos = ImageExpo::orderBy('updated_at', 'desc')->get();
        return response()->json($photos);
    }

    public function getAutismePages()
    {
        $pages = PageAutisme::all();
        return response()->json($pages);
    }

    public function getAutismePage($id)
    {
        $page = PageAutisme::find($id);
        return response()->json($page);
    }

    public function getRegistrationData()
    {
        $specialites = \App\Doctor::all();
        $regions = \App\Region::all();
        return response()->json([
            'specialites' => $specialites,
            'regions' => $regions
        ]);
    }

    public function genererPDF($activite_id, $tuteur_id)
    {
        // Reuse existing logic from Frontend\PagesController
        $pagesController = new \App\Http\Controllers\Frontend\PagesController();
        return $pagesController->genererPDF($activite_id, $tuteur_id);
    }

    public function getAdminTuteurs()
    {
        $tuteurs = \App\Tuteur::with(['enfants', 'region'])->orderBy('created_at', 'desc')->get();
        return response()->json($tuteurs);
    }
}
