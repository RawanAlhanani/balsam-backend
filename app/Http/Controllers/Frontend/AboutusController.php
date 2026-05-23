<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aboutus;
use App\Info;

class AboutusController extends Controller
{
    public function index(){
        $abouts = Aboutus::where('status', 1)->get();
        $aboutPrincipale = Aboutus::where('status', -1)->first();
        
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('aboutuses', ['aboutPrincipale' => $aboutPrincipale, 'abouts'=>$abouts, 'news'=>$news]);
    }

    public function about($id){

        $about = Aboutus::find($id);

        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

        return view('about', ['about'=>$about, 'news'=>$news]);

    }
}
