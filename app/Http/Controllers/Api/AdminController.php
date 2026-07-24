<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
public function showActivity($id)
{
    try {
        $activity = Activite::with('typeactivite')->findOrFail($id); // Eager load type if needed
        return response()->json($activity);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['message' => 'النشاط غير موجود.'], 404);
    } catch (\Exception $e) {
        Log::error('Error fetching activity', ['id' => $id, 'error' => $e->getMessage()]);
        return response()->json(['message' => 'حدث خطأ ما.'], 500);
    }
}
public function updateActivity(Request $request, $id)
    {
        try {
            $request->validate([
                "titre" => "required|string|max:255",
                "type_activite_id" => "required|exists:type_activites,id",
                "date_activite" => "required|date",
                "description" => "required|string|min:10",
                "image_activite" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ], [
                'titre.required' => 'عنوان النشاط مطلوب.',
                'type_activite_id.required' => 'نوع النشاط مطلوب.',
                'type_activite_id.exists' => 'نوع النشاط المختار غير صالح.',
                'date_activite.required' => 'تاريخ النشاط مطلوب.',
                'date_activite.date' => 'تنسيق التاريخ غير صحيح.',
                'description.required' => 'وصف النشاط مطلوب.',
                'description.min' => 'يجب أن يكون الوصف 10 أحرف على الأقل.',
                'image_activite.image' => 'يجب أن يكون الملف صورة.',
                'image_activite.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image_activite.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $activite = Activite::findOrFail($id);

            $activite->titre = $request->titre;
            $activite->description = $request->description;
            $activite->type_activite_id = $request->type_activite_id;
            $activite->date_activite = $request->date_activite;

            if ($request->hasFile('image_activite')) {
                if ($activite->image_activite) {
                    \Storage::delete('public/MesImages/' . $activite->image_activite);
                }
                $image = $request->file('image_activite');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $activite->image_activite = $name;
            }
            $activite->save();

            Log::info('Activity updated', [
                'activity_id' => $activite->id,
                'titre' => $activite->titre,
                'admin_user' => $request->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم تحديث النشاط بنجاح.', 'data' => $activite]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity not found for update', ['id' => $id]);
            return response()->json(['message' => 'النشاط غير موجود.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Activity update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating activity', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث النشاط.'], 500);
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
                return response()->json(['message' => 'نوع الصفحة الثابتة غير صالح.'], 400);
            }

            return response()->json($page);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'الصفحة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching static page', ['type' => $type, 'id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'حدث خطأ ما.'], 500);
        }
    }

    public function storeActivity(Request $request) {
        try {
            $request->validate([
                "titre" => "required|string|max:255",
                "type_activite_id" => "required|exists:type_activites,id",
                "date_activite" => "required|date|after:today",
                "description" => "required|string|min:10",
                "image_activite" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ], [
                'titre.required' => 'عنوان النشاط مطلوب.',
                'type_activite_id.required' => 'نوع النشاط مطلوب.',
                'type_activite_id.exists' => 'نوع النشاط المختار غير صالح.',
                'date_activite.required' => 'تاريخ النشاط مطلوب.',
                'date_activite.date' => 'تنسيق التاريخ غير صحيح.',
                'date_activite.after' => 'يجب أن يكون تاريخ النشاط بعد اليوم.',
                'description.required' => 'وصف النشاط مطلوب.',
                'description.min' => 'يجب أن يكون الوصف 10 أحرف على الأقل.',
                'image_activite.image' => 'يجب أن يكون الملف صورة.',
                'image_activite.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image_activite.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $activite = new Activite([
                'titre' => $request->titre,
                'description' => $request->description,
                'type_activite_id' => $request->type_activite_id,
                'date_activite' => $request->date_activite,
            ]);

            if ($request->hasFile('image_activite')) {
                $image = $request->file('image_activite');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $activite->image_activite = $name;
            }

            $activite->save();

            Log::info('Activity created', [
                'activity_id' => $activite->id,
                'titre' => $activite->titre,
                'admin_user' => $request->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح', 'data' => $activite]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Activity creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating activity', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء النشاط.'], 500);
        }
    }

    public function deleteActivity($id) {
        try {
            $activite = Activite::findOrFail($id);
            $activite->delete();

            Log::info('Activity deleted', [
                'activity_id' => $id,
                'titre' => $activite->titre,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'النشاط غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting activity', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف النشاط.'], 500);
        }
    }

    // News (Infos)
    public function getNews() {
        $perPage = min(max((int) request('per_page', 10), 1), 100);
        return response()->json(Info::orderBy('created_at', 'desc')->paginate($perPage));
    }
 public function showNews($id)
    {
        try {
            $news = Info::findOrFail($id); // Assuming your News model is 'Info'
            return response()->json($news);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'الخبر غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching news item', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'حدث خطأ ما.'], 500);
        }
    }

    public function storeNews(Request $request) {
        try {
            $request->validate([
                "titre" => "required|string|max:255",
                "description" => "required|string|min:10",
                "image_info" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'titre.required' => 'عنوان الخبر مطلوب.',
                'description.required' => 'محتوى الخبر مطلوب.',
                'description.min' => 'يجب أن يكون المحتوى 10 أحرف على الأقل.',
                'image_info.image' => 'يجب أن يكون الملف صورة.',
                'image_info.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image_info.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $info = new Info($request->all());
            if ($request->hasFile('image_info')) {
                $image = $request->file('image_info');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $info->image_info = $name;
            }
            $info->save();

            Log::info('News created', [
                'news_id' => $info->id,
                'titre' => $info->titre,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('News creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating news', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء الخبر.'], 500);
        }
    }
 public function updateNews(Request $request, $id)
    {
        try {
            $request->validate([
                "titre" => "required|string|max:255",
                "description" => "required|string|min:10",
                "image_info" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ], [
                'titre.required' => 'عنوان الخبر مطلوب.',
                'description.required' => 'محتوى الخبر مطلوب.',
                'description.min' => 'يجب أن يكون المحتوى 10 أحرف على الأقل.',
                'image_info.image' => 'يجب أن يكون الملف صورة.',
                'image_info.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image_info.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $info = Info::findOrFail($id);

            $info->titre = $request->titre;
            $info->description = $request->description;

            if ($request->hasFile('image_info')) {
                if ($info->image_info) {
                    \Storage::delete('public/MesImages/' . $info->image_info);
                }
                $image = $request->file('image_info');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $info->image_info = $name;
            }
             $info->save();

            Log::info('News updated', [
                'news_id' => $info->id,
                'titre' => $info->titre,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم تحديث الخبر بنجاح.', 'data' => $info]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('News not found for update', ['id' => $id]);
            return response()->json(['message' => 'الخبر غير موجود.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('News update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating news', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث الخبر.'], 500);
        }
    }

    public function deleteNews($id) {
        try {
            $info = Info::findOrFail($id);
            $info->delete();

            Log::info('News deleted', [
                'news_id' => $id,
                'titre' => $info->titre,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('News not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'الخبر غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting news', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف الخبر.'], 500);
        }
    }

    // Partners
    public function getPartners() {
        return response()->json(Partenaire::all());
    }

    public function storePartner(Request $request) {
        try {
            $request->validate([
                "nomPartenaire" => "required|string|max:255",
                "imagePartenaire" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'nomPartenaire.required' => 'اسم الشريك مطلوب.',
                'imagePartenaire.required' => 'صورة الشريك مطلوبة.',
                'imagePartenaire.image' => 'يجب أن يكون الملف صورة.',
                'imagePartenaire.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'imagePartenaire.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);
            $partner = new Partenaire(['nomPartenaire' => $request->nomPartenaire]);
            if ($request->hasFile('imagePartenaire')) {
                $image = $request->file('imagePartenaire');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $partner->imagePartenaire = $name;
            }
            $partner->save();

            Log::info('Partner created', [
                'partner_id' => $partner->id,
                'nomPartenaire' => $partner->nomPartenaire,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Partner creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating partner', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء الشريك.'], 500);
        }
    }
  public function updatePartner(Request $request, $id)
    {
        try {
            $request->validate([
                "nomPartenaire" => "required|string|max:255",
                "imagePartenaire" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ], [
                'nomPartenaire.required' => 'اسم الشريك مطلوب.',
                'imagePartenaire.image' => 'يجب أن يكون الملف صورة.',
                'imagePartenaire.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'imagePartenaire.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $partner = Partenaire::findOrFail($id);

            $partner->nomPartenaire = $request->nomPartenaire;

            if ($request->hasFile('imagePartenaire')) {
                if ($partner->imagePartenaire) {
                    \Storage::delete('public/MesImages/' . $partner->imagePartenaire);
                }
                $image = $request->file('imagePartenaire');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $partner->imagePartenaire = $name;
            }

            $partner->save();

            Log::info('Partner updated', [
                'partner_id' => $partner->id,
                'nomPartenaire' => $partner->nomPartenaire,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم تحديث الشريك بنجاح.', 'data' => $partner]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Partner not found for update', ['id' => $id]);
            return response()->json(['message' => 'الشريك غير موجود.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Partner update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating partner', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث الشريك.'], 500);
        }
    }

    public function deletePartner($id) {
        try {
            $partner = Partenaire::findOrFail($id);
            $partner->delete();

            Log::info('Partner deleted', [
                'partner_id' => $id,
                'nomPartenaire' => $partner->nomPartenaire,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Partner not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'الشريك غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting partner', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف الشريك.'], 500);
        }
    }

    // Slider Images
    public function getSliders() {
        return response()->json(ImagesPrincipales::all());
    }

    public function storeSlider(Request $request) {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'image.required' => 'الصورة مطلوبة.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);
            $slider = new ImagesPrincipales();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $slider->nomImage = $name;
            }
            $slider->save();

            Log::info('Slider created', [
                'slider_id' => $slider->id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Slider creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating slider', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء الصورة المتحركة.'], 500);
        }
    }

    public function updateSlider(Request $request, $id) {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'image.required' => 'الصورة مطلوبة.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $slider = ImagesPrincipales::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($slider->nomImage) {
                    \Storage::delete('public/MesImages/' . $slider->nomImage);
                }
                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $slider->nomImage = $name;
            }
            $slider->save();

            Log::info('Slider updated', [
                'slider_id' => $slider->id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم تحديث الصورة بنجاح.', 'data' => $slider]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Slider not found for update', ['id' => $id]);
            return response()->json(['message' => 'الصورة غير موجودة.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Slider update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating slider', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث الصورة.'], 500);
        }
    }

    public function deleteSlider($id) {
        try {
            $slider = ImagesPrincipales::findOrFail($id);
            $slider->delete();

            Log::info('Slider deleted', [
                'slider_id' => $id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Slider not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'الصورة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting slider', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف الصورة.'], 500);
        }
    }

    // Gallery (Expo)
    public function getGallery() {
        $perPage = min(max((int) request('per_page', 12), 1), 100);
        return response()->json(ImageExpo::orderBy('created_at', 'desc')->paginate($perPage));
    }

    public function storeGallery(Request $request) {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'image.required' => 'الصورة مطلوبة.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);
            $expo = new ImageExpo();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $expo->nomImage = $name;
            }
            $expo->save();

            Log::info('Gallery image created', [
                'gallery_id' => $expo->id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Gallery creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating gallery image', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء صورة المعرض.'], 500);
        }
    }

    public function updateGallery(Request $request, $id) {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'image.required' => 'الصورة مطلوبة.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $gallery = ImageExpo::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($gallery->nomImage) {
                    \Storage::delete('public/MesImages/' . $gallery->nomImage);
                }
                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                $gallery->nomImage = $name;
            }
            $gallery->save();

            Log::info('Gallery image updated', [
                'gallery_id' => $gallery->id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم تحديث صورة المعرض بنجاح.', 'data' => $gallery]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Gallery image not found for update', ['id' => $id]);
            return response()->json(['message' => 'صورة المعرض غير موجودة.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Gallery update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating gallery image', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث صورة المعرض.'], 500);
        }
    }

    public function deleteGallery($id) {
        try {
            $gallery = ImageExpo::findOrFail($id);
            $gallery->delete();

            Log::info('Gallery image deleted', [
                'gallery_id' => $id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Gallery image not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'صورة المعرض غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting gallery image', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف صورة المعرض.'], 500);
        }
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
        try {
            $request->validate([
                "type" => "required|in:about,autism,projects",
                "titre" => "required|string|max:255",
                "description" => "nullable|string|min:10",
                "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'type.required' => 'نوع الصفحة مطلوب.',
                'titre.required' => 'العنوان مطلوب.',
                'description.min' => 'يجب أن يكون الوصف 10 أحرف على الأقل.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

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
                    return response()->json(['message' => 'غير موجود'], 404);
                }
                $page->titre = $data['titre'];
            } else {
                if ($type === 'about') $page = new Aboutus($data);
                elseif ($type === 'autism') $page = new PageAutisme($data);
                else $page = new Projet($data);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
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
            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Static page creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating static page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء الصفحة.'], 500);
        }
    }

    // ... existing methods ...

    public function updateStaticPage(Request $request, $type, $id)
    {
        try {
            $request->validate([
                "type" => "required|in:about,autism,projects",
                "titre" => "required|string|max:255",
                "description" => "nullable|string",
                "description_json" => "nullable|json",
                "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ], [
                'type.required' => 'نوع الصفحة مطلوب.',
                'titre.required' => 'العنوان مطلوب.',
                'image.image' => 'يجب أن يكون الملف صورة.',
                'image.mimes' => 'تنسيقات الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
                'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            ]);

            $page = null;
            if ($type === 'about') $page = \App\Aboutus::findOrFail($id);
            elseif ($type === 'autism') $page = \App\PageAutisme::findOrFail($id);
            elseif ($type === 'projects') $page = \App\Projet::findOrFail($id);
            else return response()->json(['message' => 'Invalid static page type.'], 400);

            $page->titre = $request->titre;

            // Handle structured description
            $descJson = $request->input('description_json');
            if ($descJson) {
                $decoded = json_decode($descJson, true);
                $page->structured_description = $decoded ?: null;
                $page->description = null; // Clear old description
            } else {
                $page->description = $request->input('description', '');
                $page->structured_description = null; // Clear structured description
            }

            if ($request->hasFile('image')) {
                // Delete old image if exists
                $oldImage = null;
                if ($type === 'projects') $oldImage = $page->projet_image;
                elseif ($type === 'about') $oldImage = $page->about_image;
                elseif ($type === 'autism') $oldImage = $page->page_image;

                if ($oldImage) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('MesImages/' . $oldImage);
                }

                $image = $request->file('image');
                $name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();
                $image->storeAs('public/MesImages', $name);
                if ($type === 'projects') $page->projet_image = $name;
                elseif ($type === 'about') $page->about_image = $name;
                elseif ($type === 'autism') $page->page_image = $name;
            }

            $page->save();

            return response()->json(['message' => 'Static page updated successfully.', 'page' => $page], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Static page not found for update', ['type' => $type, 'id' => $id]);
            return response()->json(['message' => 'الصفحة غير موجودة.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Static page update validation failed', ['errors' => $e->errors(), 'type' => $type, 'id' => $id]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating static page', [
                'type' => $type,
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء تحديث الصفحة.'], 500);
        }
    }

    // ... existing storeStaticPage method (should be for POST only) ...


    public function deleteStaticPage($type, $id) {
        try {
            if ($type === 'about') $page = Aboutus::find($id);
            elseif ($type === 'autism') $page = PageAutisme::find($id);
            else $page = Projet::find($id);

            if (!$page) {
                return response()->json(['message' => 'غير موجود'], 404);
            }

            $page->delete();
            return response()->json(['message' => 'تم الحذف']);
        } catch (\Exception $e) {
            Log::error('Error deleting static page', [
                'type' => $type,
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف الصفحة.'], 500);
        }
    }

    // Admin Accounts
    public function getAdmins() {
        return response()->json(\App\LoginAdmin::all());
    }

    public function storeAdmin(Request $request) {
        try {
            $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|email|unique:login_admins,email|max:150",
                "password" => "required|string|min:6|max:100",
                "role" => "required|in:president,vice_president,secretary,vice_secretary,treasurer,vice_treasurer"
            ], [
                'name.required' => 'الاسم مطلوب.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
                'password.required' => 'كلمة المرور مطلوبة.',
                'password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل.',
                'role.required' => 'الدور مطلوب.',
            ]);
            $admin = new \App\LoginAdmin($request->all());
            $admin->password = \Hash::make($request->password);
            $admin->save();

            Log::info('Admin account created', [
                'admin_id' => $admin->id,
                'email' => $admin->email,
                'role' => $admin->role,
                'created_by' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم بنجاح']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Admin creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'فشل التحقق من البيانات', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating admin account', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء إنشاء حساب المسؤول.'], 500);
        }
    }

    public function deleteAdmin($id) {
        try {
            $admin = \App\LoginAdmin::findOrFail($id);
            $admin->delete();

            Log::info('Admin account deleted', [
                'admin_id' => $id,
                'email' => $admin->email,
                'role' => $admin->role,
                'deleted_by' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Admin not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'المسؤول غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting admin account', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف حساب المسؤول.'], 500);
        }
    }

    public function deleteTuteur($id) {
        try {
            $tuteur = \App\Tuteur::findOrFail($id);
            $tuteur->enfants()->delete();
            $tuteur->delete();

            Log::info('Tuteur account deleted', [
                'tuteur_id' => $id,
                'username' => $tuteur->nom_utilisateur,
                'deleted_by' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم الحذف']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Tuteur not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'ولي الأمر غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting tuteur account', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'خطأ أثناء حذف حساب ولي الأمر.'], 500);
        }
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
        ], [
            'nomActivite.required' => 'اسم نوع النشاط مطلوب.',
            'nomActivite.unique' => 'هذا النوع موجود بالفعل.',
        ]);

        try {
            $type = TypeActivite::create([
                'nomActivite' => $request->nomActivite,
            ]);
            return response()->json(['message' => 'تم إضافة نوع النشاط بنجاح.', 'type' => $type], 201);
        } catch (\Exception $e) {
            Log::error('Error creating activity type', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء إضافة نوع النشاط.'], 500);
        }
    }
 public function updateType(Request $request, $id)
    {
        $request->validate([
            'nomActivite' => 'required|string|max:255|unique:type_activites,nomActivite,' . $id,
        ], [
            'nomActivite.required' => 'اسم نوع النشاط مطلوب.',
            'nomActivite.unique' => 'هذا النوع موجود بالفعل.',
        ]);

        try {
            $type = TypeActivite::findOrFail($id);
            $type->nomActivite = $request->nomActivite;
            $type->save();
            return response()->json(['message' => 'تم تحديث نوع النشاط بنجاح.', 'type' => $type]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'نوع النشاط غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating activity type', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء تحديث نوع النشاط.'], 500);
        }
    }
  public function deleteType($id)
     {
         try {
             $type = TypeActivite::findOrFail($id);
             $type->delete();
             return response()->json(['message' => 'تم حذف نوع النشاط بنجاح.']);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return response()->json(['message' => 'نوع النشاط غير موجود.'], 404);
         } catch (\Exception $e) {
             Log::error('Error deleting activity type', ['id' => $id, 'error' => $e->getMessage()]);
             return response()->json(['message' => 'خطأ أثناء حذف نوع النشاط.'], 500);
         }
     }

    // Regions
    public function storeRegion(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255|unique:regions,nom_region',
        ], [
            'nom_region.required' => 'اسم المنطقة مطلوب.',
            'nom_region.unique' => 'هذه المنطقة موجودة بالفعل.',
        ]);

        try {
            $region = Region::create([
                'nom_region' => $request->nom_region,
            ]);
            return response()->json(['message' => 'تم إضافة المنطقة بنجاح.', 'region' => $region], 201);
        } catch (\Exception $e) {
            Log::error('Error creating region', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء إضافة المنطقة.'], 500);
        }
    }

    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255|unique:regions,nom_region,' . $id,
        ], [
            'nom_region.required' => 'اسم المنطقة مطلوب.',
            'nom_region.unique' => 'هذه المنطقة موجودة بالفعل.',
        ]);

        try {
            $region = Region::findOrFail($id);
            $region->nom_region = $request->nom_region;
            $region->save();

            return response()->json(['message' => 'تم تحديث المنطقة بنجاح.', 'region' => $region]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'المنطقة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating region', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء تحديث المنطقة.'], 500);
        }
    }
public function deleteRegion($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->delete();
            return response()->json(['message' => 'تم حذف المنطقة بنجاح.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'المنطقة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting region', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء حذف المنطقة.'], 500);
        }
    }

    // Doctors (Specialities)
    public function storeDoctor(Request $request)
    {
        $request->validate([
            'specialite' => 'required|string|max:255|unique:doctors,specialite',
        ], [
            'specialite.required' => 'التخصص مطلوب.',
            'specialite.unique' => 'هذا التخصص موجود بالفعل.',
        ]);

        try {
            $doctor = Doctor::create([
                'specialite' => $request->specialite,
            ]);
            return response()->json(['message' => 'تم إضافة تخصص الطبيب بنجاح.', 'doctor' => $doctor], 201);
        } catch (\Exception $e) {
            Log::error('Error creating doctor speciality', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء إضافة تخصص الطبيب.'], 500);
        }
    }
 public function updateDoctor(Request $request, $id)
    {
        $request->validate([
            'specialite' => 'required|string|max:255|unique:doctors,specialite,' . $id,
        ], [
            'specialite.required' => 'التخصص مطلوب.',
            'specialite.unique' => 'هذا التخصص موجود بالفعل.',
        ]);

        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->specialite = $request->specialite;
            $doctor->save();

            return response()->json(['message' => 'تم تحديث تخصص الطبيب بنجاح.', 'doctor' => $doctor]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'تخصص الطبيب غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating doctor speciality', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء تحديث تخصص الطبيب.'], 500);
        }
    }
  public function deleteDoctor($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            return response()->json(['message' => 'تم حذف تخصص الطبيب بنجاح.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'تخصص الطبيب غير موجود.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting doctor speciality', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء حذف تخصص الطبيب.'], 500);
        }
    }

    public function getContactMessages()
    {
        try {
            $perPage = min(max((int) request('per_page', 15), 1), 100);
            return response()->json(\App\ContactMessage::orderBy('created_at', 'desc')->paginate($perPage));
        } catch (\Exception $e) {
            Log::error('Error fetching contact messages', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ في تحميل رسائل التواصل.'], 500);
        }
    }

    public function deleteContactMessage($id)
    {
        try {
            $message = \App\ContactMessage::findOrFail($id);
            $message->delete();

            Log::info('Contact message deleted', [
                'contact_message_id' => $id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'تم حذف الرسالة بنجاح.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'الرسالة غير موجودة.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting contact message', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'خطأ أثناء حذف الرسالة.'], 500);
        }
    }

}
    // ... other methods ...
