<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;

class AutismController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autisme()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism', ['news' => $news]);
    }

     public function autisme1()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism1', ['news' => $news]);
    }

     public function autisme2()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism2', ['news' => $news]);
    }

     public function autisme3()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism3', ['news' => $news]);
    }

     public function autisme4()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism4', ['news' => $news]);
    }

     public function autisme5()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism5', ['news' => $news]);
    }

     public function autisme6()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism6', ['news' => $news]);
    }

     public function autisme7()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism7', ['news' => $news]);
    }
    
     public function autisme8()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism8', ['news' => $news]);
    }

     public function autisme9()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('autism9', ['news' => $news]);
    }

     public function formation()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('formation', ['news' => $news]);
    }

    public function pleading()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('pleading', ['news' => $news]);
    }

    public function sensibiliser()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('sensibiliser', ['news' => $news]);
    }

    public function centre()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('centre', ['news' => $news]);
    }

     public function mission()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('mission', ['news' => $news]);
    }
  
    public function object()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('object', ['news' => $news]);
    }

    public function project()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('project', ['news' => $news]);
    }
    
    
     public function about()
    {
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        return view('about', ['news' => $news]);
    }
    
}
