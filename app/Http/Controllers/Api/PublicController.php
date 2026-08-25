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
use App\SiteSetting;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{
    public function getSiteSettings()
    {
        try {
            $settings = SiteSetting::first();
            return response()->json($settings ?? new SiteSetting());
        } catch (\Exception $e) {
            Log::error('Error fetching site settings', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل معلومات التواصل.'], 500);
        }
    }

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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل بيانات الصفحة الرئيسية.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل بيانات من نحن.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل المشاريع.'], 500);
        }
    }

    public function getProject($id)
    {
        try {
            $project = Projet::findOrFail($id);
            return response()->json($project);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Project not found', ['id' => $id]);
            return response()->json(['message' => 'المشروع غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching project', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل المشروع.'], 500);
        }
    }

    public function getNews()
    {
        try {
            $perPage = min(max((int) request('per_page', 9), 1), 50);
            $news = Info::orderBy('created_at', 'DESC')->paginate($perPage);
            return response()->json($news);
        } catch (\Exception $e) {
            Log::error('Error fetching news', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الأخبار.'], 500);
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
            return response()->json(['message' => 'الخبر غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching news', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الأخبار.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الأنشطة.'], 500);
        }
    }

    public function getActivity($id)
    {
        try {
            $activity = Activite::where('id', $id)->with('typeactivite')->first();
            if (!$activity) {
                Log::warning('Activity not found', ['id' => $id]);
                return response()->json(['message' => 'النشاط غير موجود.'], 404);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل النشاط.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الشركاء.'], 500);
        }
    }

    public function getPhotos()
    {
        try {
            $perPage = min(max((int) request('per_page', 12), 1), 50);
            $photos = ImageExpo::orderBy('updated_at', 'desc')->paginate($perPage);
            return response()->json($photos);
        } catch (\Exception $e) {
            Log::error('Error fetching photos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الصور.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل صفحات التوحد.'], 500);
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
            return response()->json(['message' => 'الصفحة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching autism page', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل الصفحة.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل بيانات التسجيل.'], 500);
        }
    }

    public function genererPDF($activite_id, $tuteur_id)
    {
        try {
            $user = request()->user();

            if (!($user instanceof \App\Tuteur) || (int) $user->id !== (int) $tuteur_id) {
                return response()->json([
                    'message' => 'غير مسموح لك بإنشاء ملف PDF لهذا الحساب.'
                ], 403);
            }

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
            return response()->json(['message' => 'حدث خطأ أثناء إنشاء ملف PDF.'], 500);
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
            return response()->json(['message' => 'حدث خطأ أثناء تحميل قائمة أولياء الأمور.'], 500);
        }
    }

    public function getTeam()
    {
        try {
            $team = \App\LoginAdmin::whereIn('role', ['president', 'vice_president', 'secretary', 'treasurer'])
                ->get(['id', 'name', 'email', 'role']);
            return response()->json($team);
        } catch (\Exception $e) {
            Log::error('Error fetching public team list', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'حدث خطأ أثناء تحميل بيانات الفريق.'], 500);
        }
    }

    public function submitContact(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|min:10',
            ], [
                'name.required' => 'الاسم حقل إجباري.',
                'email.required' => 'البريد الإلكتروني حقل إجباري.',
                'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح.',
                'subject.required' => 'الموضوع حقل إجباري.',
                'message.required' => 'نص الرسالة حقل إجباري.',
                'message.min' => 'الرجاء كتابة رسالة أكثر تفصيلاً (10 أحرف على الأقل).',
            ]);

            $contactMessage = \App\ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            Log::info('New contact message received', ['id' => $contactMessage->id, 'ip' => $request->ip()]);

            return response()->json([
                'message' => 'شكراً لتواصلكم معنا، تم إرسال رسالتكم بنجاح وسنقوم بالرد عليكم في أقرب وقت ممكن.'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error submitting contact message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip()
            ]);
            return response()->json(['message' => 'حدث خطأ أثناء إرسال رسالتكم. الرجاء المحاولة مرة أخرى.'], 500);
        }
    }
}
