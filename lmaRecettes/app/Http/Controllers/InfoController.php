<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function enregistrerStats(Request $request, $tag, $param2)
    {
        // Traiter et enregistrer les statistiques dans la base de données
        $info = new Info([
            'idUser' => $request->input('idUser'),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'heure_connexion' => now(),
            'tag' => $tag,
            'param2' => $param2
        ]);

        $info->save();

        return response()->json(['message' => 'Statistiques enregistrées avec succès']);
    }





    public function afficheGraphes()
    {
        // Récupérer les données pour le graphique d'ingrédients
        $ingredientInfos = Info::select('param2', DB::raw('COUNT(id) as totalActions'))
            ->groupBy('param2')
            ->orderByDesc('totalActions')
            ->get();

        // Récupérer les données pour le graphique quotidien
        $dailyInfos = Info::selectRaw("DATE(heure_connexion) as date_jour, COUNT(id) as totalActions")
            ->groupBy('date_jour') // jour
            ->orderBy('date_jour') // ranger par date
            ->get();

        // Récupérer les données pour le graphique horaire
        $hourlyInfos = Info::select(DB::raw('DATE_FORMAT(heure_connexion, "%d-%m-%Y à %HH") as date_heure_connexion'), DB::raw('COUNT(id) as totalActions'))
            ->groupBy(DB::raw('DATE_FORMAT(heure_connexion, "%d-%m-%Y à %HH")'), DB::raw('HOUR(heure_connexion)'))
            ->get();

        $userAgentData = Info::select('user_agent', DB::raw('COUNT(DISTINCT idUser) as totalActions'))
            ->groupBy('user_agent')
            ->orderByDesc('totalActions')
            ->get();

        return view('all_graphes')->with([
            'ingredientInfos' => $ingredientInfos,
            'dailyInfos' => $dailyInfos,
            'hourlyInfos' => $hourlyInfos,
            'userAgentData' => $userAgentData
        ]);
    }
}
