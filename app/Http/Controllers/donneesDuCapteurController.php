<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Khill\Lavacharts\Laravel\LavachartsFacade;
use Illuminate\Support\Facades\Cache;

class donneesDuCapteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $session = Session::get('user_rang');

        if ($session=='client-eiffage') {
            if (!isset($_GET['ID'])) {
                return Redirect::to('Liste-des-sites');
            }
            $ID=$_GET['ID'];
            $email=Session::get('user_email');
            $capteur=DB::select(DB::raw("SELECT nom_capteur FROM capteur NATURAL join users WHERE capteur='$ID' AND email='$email'"));

        }
        elseif ($session=='visiteur-eiffage') {
            if (!isset($_GET['ID'])) {
                return Redirect::to('Liste-des-sites-vi');
            }
            $ID=$_GET['ID'];
            $email=Session::get('user_email');
            $site=$_GET['id'];
            $capteur = DB::Select(DB::raw("SELECT capteur.capteur,capteur.nom_capteur 
                FROM capteur natural join zones Natural join site inner join clef_visiteur
                WHERE capteur='$ID'                          
                AND clef_visiteur.ID_site=(SELECT ID_site FROM site WHERE nom_site='$site')
                AND clef_visiteur.ID_user=(SELECT ID_user FROM users WHERE email='$email')
                order by (nom_capteur)"));
        }

        $typeuse=DB::select(DB::raw("SELECT type.type FROM type NATURAL join donnees NATURAL join capteur NATURAL join users WHERE capteur='$ID'GROUP BY type"));




        if($typeuse!=null){

            $Graph = \Lava::Datatable();

            $Graph
                ->addDateTimeColumn('Date');
            $i=0;
            foreach ($typeuse as $typeuse2) {
                $i++;

                $type='type'.$i;
                $$type = $typeuse2->type;
                $Graph
                    ->addNumberColumn($typeuse2->type);
            }

            $donnees1=DB::select(DB::raw("SELECT donnees.donnees,donnees.timestamp_donnee,type.type,capteur.capteur FROM type NATURAL join donnees NATURAL join capteur NATURAL join users WHERE capteur='$ID' AND type='$type1'"));

            foreach ($donnees1 as $donnees12){
                $datatime=$donnees12->timestamp_donnee;
                $Graph->addRow([$datatime, $donnees12->donnees,]);
            }

            if(isset($type2)){
            $donnees2=DB::select(DB::raw("SELECT donnees.donnees,donnees.timestamp_donnee,type.type,capteur.capteur FROM type NATURAL join donnees NATURAL join capteur NATURAL join users WHERE capteur='$ID' AND type='$type2'"));

            foreach ($donnees2 as $donnees22){
                $datatime=$donnees22->timestamp_donnee;
                $Graph->addRow([$datatime,null,$donnees22->donnees]);
            }
        }

            if(isset($type3)){
                $donnees3=DB::select(DB::raw("SELECT donnees.donnees,donnees.timestamp_donnee,type.type,capteur.capteur FROM type NATURAL join donnees NATURAL join capteur NATURAL join users WHERE capteur='$ID' AND type='$type3'"));

                foreach ($donnees3 as $donnees32){
                    $datatime=$donnees32->timestamp_donnee;
                    $Graph->addRow([$datatime,null,null,$donnees32->donnees]);
                }
            }



        $format=Session::get('user_type');
        $title=Session::get('user_format');

        \LAVA::$format('Graph', $Graph,[
            'title' => $title,
            'curveType'          => 'function',
        ]);

    }
            if ($capteur != null) {
                return view('Donnee-du-capteur')->with('capteur', $capteur)->with('typeuse', $typeuse);
            }


    }

    protected function validateformformat(Request $request)
    {
        $ID=$_GET['ID'];
        $id=$_GET['id'];
        $zone=$_GET['zone'];

        $request->all();
        $format =$request['format'];
        if($format=='Linéaires'){
            Session::put('user_type','LineChart');
            Session::put('user_format','Linéaires');
        }
        elseif ($format=='Histogrammes'){
            Session::put('user_type','ColumnChart');
            Session::put('user_format','Histogrammes');
        }
        elseif ($format=='Pointeurs'){
            Session::put('user_type','ScatterChart');
            Session::put('user_format','Pointeurs');
        }
        elseif ($format=='Zones'){
            Session::put('user_type','AreaChart');
            Session::put('user_format','Zones');
        }


        return Redirect::to("Donnee-du-capteur?ID=$ID&id=$id&zone=$zone");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
