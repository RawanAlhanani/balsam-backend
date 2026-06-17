<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        $sessions = DB::table('doctor_enfants')
            ->whereYear('created_at', '>=', 2020)
            ->count();

        $activites = DB::table('activites')
            ->whereYear('created_at', '>=', 2020)
            ->count();

        $enfants = DB::table('tuteurs')
            ->join('enfants', 'tuteurs.id', '=', 'enfants.tuteur_id')
            ->whereYear('enfants.created_at', '>=', 2020)
            ->distinct('enfants.id')
            ->count('enfants.id');

        $formations = DB::table('type_activites')
            ->where('nomActivite', 'LIKE', '%دورة%')
            ->whereYear('created_at', '>=', 2020)
            ->count();

        return response()->json([
            'sessions' => $sessions,
            'activites' => $activites,
            'enfants' => $enfants,
            'formations' => $formations,
        ]);
    }
}