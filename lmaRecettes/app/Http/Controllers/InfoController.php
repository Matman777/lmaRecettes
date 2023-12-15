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

    public function Graphe_ingredient()
    {
        $infos = Info::select('param2', DB::raw('COUNT(id) as totalActions'))
            ->groupBy('param2')
            ->orderByDesc('totalActions')
            ->get();

        return view("/graphe_ingredient", ["infos" => $infos]);
    }



    public function Graphe_user()
    {
        $infos = Info::select(DB::raw('DATE_FORMAT(heure_connexion, "%Y-%m-%d %H") as date_heure_connexion'), DB::raw('COUNT(id) as totalActions'))
            ->groupBy(DB::raw('DATE_FORMAT(heure_connexion, "%Y-%m-%d %H")'), DB::raw('HOUR(heure_connexion)'))
            ->get();

        return view('graphe_user', ['infos' => $infos]);
    }

    

    public function graphe_state_journaliere()
    {
        //$infos = Info::select(DB::raw('DATE(heure_connexion) as date_jour') ,DB::raw('COUNT(id) as totalActions')) // date du jour et le nombre cliques par jour
        $infos = Info::selectRaw("DATE(heure_connexion) as date_jour, COUNT(id) as totalActions")
            ->groupBy('date_jour') // jour
            ->orderBy('date_jour') // ranger par date
            ->get();

        return view('graphe_state_journaliere', ['infos' => $infos]);      
    }


    public function graphe3()
    {
        $infos = Info::select('user_agent', DB::raw('COUNT(DISTINCT idUser) as totalActions'))
            ->groupBy('user_agent')
            ->orderByDesc('totalActions')
            ->get();

        return view('graphe3', ['infos' => $infos]);
    }

}
