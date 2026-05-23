<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Activite;
use App\Info;
use App\TypeActivite;
use App\Tuteur;
use App\Partenaire;
use App\Tuteur_Activite;
use App\ImagesPrincipales;
use App\ImageExpo;
use App\Aboutus;
use App\Projet;
use Carbon\Carbon;
use App\Enfant;

use PDF;

class PagesController extends Controller
{

// HOME
    public function index()
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

        return view('home', ['news'=>$news, 'images' => $images, 'imagesexpos' => $imagesexpos, 'aboutuses'=>$aboutuses, 'projetsPrincipale'=>$projetsPrincipale]);
    }

// se connecter aux tuteurs
	public function seConnecter(){
        return view('loginTuteur');
    }

    public function postSeConnecter(Request $req){
    	$tuteur = Tuteur::where([
								    ['nom_utilisateur', '=', $req->login],
								    ['mot_de_pass', '=', $req->mdp]
								])->first();

    	if($tuteur != null){
    		session(['nom_tuteur' => $tuteur->nom_tuteur,
    			'prenom_tuteur' => $tuteur->prenom_tuteur,
    			'tuteur_id' => $tuteur->id]);

    		return redirect()->route('home');
    	}

        return redirect()->route('Login')->with(['msg1' => 'اسم المستخدم أوكلمة المرور غير صحيحة.']);
    }

    public function seDeconnecter(){
    	//Session::flush();
    	session(['nom_tuteur' => null,
    			'prenom_tuteur' => null,
    			'tuteur_id' => null]);
    	return  redirect()->route('home');
    }

 // participer aux activites
    public function vouloirparticiper($activite_id, $tuteur_id = -1){
    	if( $tuteur_id != -1){
    		$tuteur = Tuteur::find($tuteur_id);
    		$activite = Activite::where('id', $activite_id)->with('typeactivite')->first();
    		$enfant = Enfant::where('tuteur_id', $tuteur->id)->first();

    		return view('participer', ['tuteur'=>$tuteur, 'activite'=>$activite, 'enfant'=>$enfant]);
    	}

    	return redirect()->route('Login');
    }

// generer PDF
    public function genererPDF($activite_id, $tuteur_id = -1){
    	if( $tuteur_id != -1){
    		$tuteur = Tuteur::find($tuteur_id);
    		$activite = Activite::where('id', $activite_id)->with('typeactivite')->first();
            $enfant = Enfant::where('tuteur_id', $tuteur->id)->first();

        $data = ['tuteur'=> $tuteur, 'activite'=>$activite, 'enfant'=>$enfant];

	        $pdf = PDF::loadView('participer', $data);

	        $participant = Tuteur_Activite::where('tuteur_id', $tuteur_id)
	                                        ->where('activite_id', $activite_id)
	                                        ->first();
	       if($participant == null){
	           $nve_parti = new Tuteur_Activite([
	               'tuteur_id' => $tuteur_id,
	               'activite_id' => $activite_id
	               ]);
	           $nve_parti->save();
	       }

	    	return $pdf->download('demande.pdf');
	    }

    	return response()->json(['ok'=>-1]);
    }

// page nos activites
	public function activites(){

		$activites = Activite::orderBy('date_activite', 'DESC')->with('typeactivite')->get();
		return view('lesActivites', ['activites'=> $activites]);
	}

// page une activite
	public function uneActivite($id){
		$activite = Activite::where('id', $id)->with('typeactivite')->first();

        $derniersActivites = Activite::where('id', '!=' , $id)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

		return view('activite', ['activite'=> $activite, 'derniersActivites' => $derniersActivites]);
	}

// Page nos infos
	public function infos(){

		$infos = Info::orderBy('created_at', 'DESC')->get();
		return view('lesInfos', ['infos'=> $infos]);
	}
// page une info
	public function uneInfo($id){
		$info = Info::where('id', $id)->first();

        $derniersInfos = Info::where('id', '!=' , $id)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

		return view('info', ['info'=> $info, 'derniersInfos'=> $derniersInfos]);
	}

// last news
    public function getLastNews(){
        $news = Info::orderBy('updated_at', 'desc')
                        ->take(3)
                        ->get();

        return response()->json(['news'=>$news]);
    }

// partenaires
    public function getPartenaires()
    {
        $partenaires = Partenaire::all();
        return view('partenaires', ['partenaires'=> $partenaires]);
    }

// Projets
    public function getProjets()
    {
       return view('project');
    }

// photos
    public function photos()
    {
        $photosexpos = ImageExpo::orderBy('updated_at', 'desc')
                                 ->get();
        return view('photos', ['photosexpos'=> $photosexpos]);
    }

}
