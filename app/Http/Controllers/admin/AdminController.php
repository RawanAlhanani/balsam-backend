<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
	// liste des activites
	public function index(){
		return view('admin.seConnecter');
	}

	public function seConnecter(Request $req){
		if($req->login == 'balsam' && $req->mdp == 'balsam_02_04'){

			session(['admin' => 'un admin']);

			return redirect()->route('tuteurs');
		}

		return redirect()->back()->withErrors(['Login ou mot de passe non valides !!!!']);
	}

	public function seDeconnecter(){
		session(['admin' => null]);
		
		return redirect()->route('home');
	}
}