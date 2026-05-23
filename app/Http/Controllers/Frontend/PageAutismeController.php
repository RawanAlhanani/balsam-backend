<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PageAutisme;
use App\Info;


class PageAutismeController extends Controller
{
	public function index(){
		$pagesAutismes = PageAutisme::all();
		return view('lesPages', ['pagesAutismes'=>$pagesAutismes]);
	}

	public function unePage($id){

		$unePage = PageAutisme::find($id);

		$news = Info::orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

		return view('unePage', ['unePage'=>$unePage, 'news'=>$news]);

	}
}