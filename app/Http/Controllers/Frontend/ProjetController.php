<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Projet;
use App\Info;

class ProjetController extends Controller
{
     public function index(){

        $projets = Projet::where('status', 1)->get();
        $projetPrincipale = Projet::where('status', -1)->first();
        
        return view('projets', ['projets'=>$projets, 'projetPrincipale' => $projetPrincipale ]);
    }

    public function projet($id){

        $projet = Projet::find($id);

        $news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

        return view('projet', ['projet'=>$projet, 'news'=>$news]);

    }

}