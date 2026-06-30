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
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{
    public function getHomeData()
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Error fetching home data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching home data.'], 500);
        }
    }

    public function getAbout()
    {
        try {
            $aboutuses = Aboutus::where('status', 1)->get();
            return response()->json($aboutuses);
        } catch (\Exception $e) {
            Log::error('Error fetching about data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching about data.'], 500);
        }
    }

    public function getProjects()
    {
        try {
            $projects = Projet::where('status', 1)->get();
            return response()->json($projects);
        } catch (\Exception $e) {
            Log::error('Error fetching projects', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching projects.'], 500);
        }
    }

    public function getProject($id)
    {
        try {
            $project = Projet::findOrFail($id);
            return response()->json($project);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Project not found', ['id' => $id]);
            return response()->json(['message' => 'Project not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching project', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching project.'], 500);
        }
    }

    public function getNews()
    {
        try {
            $news = Info::orderBy('created_at', 'DESC')->get();
            return response()->json($news);
        } catch (\Exception $e) {
            Log::error('Error fetching news', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching news.'], 500);
        }
    }

    public function getSingleNews($id)
    {
        try {
            $news = Info::findOrFail($id);
            $latest_news = Info::where('id', '!=', $id)->orderBy('updated_at', 'desc')->take(4)->get();
            return response()->json([
                'news' => $news,
                'latest_news' => $latest_news
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('News not found', ['id' => $id]);
            return response()->json(['message' => 'News not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching news', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching news.'], 500);
        }
    }

    public function getActivities()
    {
        try {
            $activities = Activite::orderBy('date_activite', 'DESC')->with('typeactivite')->get();
            return response()->json($activities);
        } catch (\Exception $e) {
            Log::error('Error fetching activities', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching activities.'], 500);
        }
    }

    public function getActivity($id)
    {
        try {
            $activity = Activite::where('id', $id)->with('typeactivite')->first();
            if (!$activity) {
                Log::warning('Activity not found', ['id' => $id]);
                return response()->json(['message' => 'Activity not found.'], 404);
            }
            $latest_activities = Activite::where('id', '!=', $id)->orderBy('updated_at', 'desc')->take(4)->get();
            return response()->json([
                'activity' => $activity,
                'latest_activities' => $latest_activities
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching activity', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching activity.'], 500);
        }
    }

    public function getPartenaires()
    {
        try {
            $partenaires = Partenaire::all();
            return response()->json($partenaires);
        } catch (\Exception $e) {
            Log::error('Error fetching partners', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching partners.'], 500);
        }
    }

    public function getPhotos()
    {
        try {
            $photos = ImageExpo::orderBy('updated_at', 'desc')->get();
            return response()->json($photos);
        } catch (\Exception $e) {
            Log::error('Error fetching photos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching photos.'], 500);
        }
    }

    public function getAutismePages()
    {
        try {
            $pages = PageAutisme::all();

            // Return a compact representation including the structured description
            $result = $pages->map(function($p) {
                return [
                    'id' => $p->id,
                    'titre' => $p->titre,
                    'page_image' => $p->page_image,
                    'structured_description' => $p->structured_description,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ];
            });

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Error fetching autism pages', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching autism pages.'], 500);
        }
    }

    public function getAutismePage($id)
    {
        try {
            $page = PageAutisme::findOrFail($id);

            // Return full page with structured description
            $data = $page->toArray();
            $data['structured_description'] = $page->structured_description;

            return response()->json($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Autism page not found', ['id' => $id]);
            return response()->json(['message' => 'Autism page not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching autism page', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching autism page.'], 500);
        }
    }

    public function getRegistrationData()
    {
        try {
            $specialites = \App\Doctor::all();
            $regions = \App\Region::all();
            return response()->json([
                'specialites' => $specialites,
                'regions' => $regions
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching registration data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching registration data.'], 500);
        }
    }

    public function genererPDF($activite_id, $tuteur_id)
    {
        try {
            // Reuse existing logic from Frontend\PagesController
            $pagesController = new \App\Http\Controllers\Frontend\PagesController();
            return $pagesController->genererPDF($activite_id, $tuteur_id);
        } catch (\Exception $e) {
            Log::error('Error generating PDF', [
                'activite_id' => $activite_id,
                'tuteur_id' => $tuteur_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error generating PDF.'], 500);
        }
    }

    public function getAdminTuteurs()
    {
        try {
            $tuteurs = \App\Tuteur::with(['enfants.doctors', 'region'])->orderBy('created_at', 'desc')->get();
            return response()->json($tuteurs);
        } catch (\Exception $e) {
            Log::error('Error fetching admin tuteurs', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error fetching tuteurs.'], 500);
        }
    }
}
