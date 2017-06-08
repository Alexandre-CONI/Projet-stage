<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class listeDesCapteursController extends Controller
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
            $ID = $_GET['ID'];
            $email = Session::get('user_email');
            $zone = $_GET['id'];

            $capteur = DB::Select(DB::raw("SELECT capteur.capteur,capteur.timestamp_actif,capteur.nom_capteur FROM capteur NATURAL join zones NATURAL  join site NATURAL join hote NATURAL join users WHERE email='$email' AND nom_site='$ID' AND nom_zone='$zone'order by (capteur)"));
        }
        elseif ($session=='visiteur-eiffage'){
            if (!isset($_GET['ID'])) {
                return Redirect::to('Liste-des-sites-vi');
            }
            $ID = $_GET['ID'];
            $email = Session::get('user_email');
            $zone = $_GET['id'];
            $capteur = DB::Select(DB::raw("SELECT capteur.capteur,capteur.nom_capteur 
                FROM capteur natural join zones Natural join site inner join clef_visiteur
                WHERE nom_site='$ID'
                AND nom_zone='$zone'
                AND clef_visiteur.ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID')
                AND clef_visiteur.ID_user=(SELECT ID_user FROM users WHERE email='$email')
                order by (nom_capteur)"));
        }

        return view('Liste-des-capteurs')->with('capteur',$capteur);

    }
    protected function validateformrenommer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'capteur' => 'required|string|max:100|exists:capteur',
            'nom_capteur' => 'required|string|max:100',
        ]);
        $capteur=$request['capteur'];
        $nom_capteur=$request['nom_capteur'];
        $ID=$_GET['ID'];
        $zone=$_GET['id'];
        $email=Session::get('user_email');

        $verif=DB::Select(DB::raw("SELECT users.email,capteur.capteur FROM capteur NATURAL JOIN users WHERE capteur.capteur='$capteur' AND users.email='$email'"));

        if($verif!=null){
            DB::table('capteur')
                ->where('capteur',$capteur)
                ->update(['nom_capteur' => $nom_capteur]);

            return Redirect::to("Liste-des-capteurs?ID=$ID&id=$zone")->with('message',trans('info.sensor').$capteur.trans('info.rename').$nom_capteur.' avec succés');
        }return Redirect::to("Liste-des-capteurs?ID=$ID&id=$zone")->with('message1',trans('info.sensor').$capteur.trans('info.notyours'));

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
