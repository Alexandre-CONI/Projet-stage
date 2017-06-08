<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class listeDesZonesController extends Controller
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
        $zone='';
        $site='';
        if ($session=='client-eiffage'){

        if(!isset($_GET['ID'])){
            return Redirect::to('Liste-des-sites');
        }
        $ID=$_GET['ID'];
        $email=Session::get('user_email');

        $site = DB::Select(DB::raw("SELECT site.nom_site FROM site WHERE site.nom_site='$ID'"));
        $zone=DB::Select(DB::raw("SELECT zones.nom_zone FROM zones NATURAL join site NATURAL join users WHERE site.nom_site='$ID' AND users.email='$email' ORDER BY nom_zone"));

        }
        else if($session=='visiteur-eiffage'){
            if(!isset($_GET['ID'])){
                return Redirect::to('Liste-des-sites-vi');
            }
            $ID=$_GET['ID'];
            $email=Session::get('user_email');
            $site = DB::Select(DB::raw("SELECT site.nom_site FROM site WHERE site.nom_site='$ID'"));
            $zone=DB::Select(DB::raw("SELECT zones.nom_zone 
                FROM zones NATURAL join site INNER join clef_visiteur 
                WHERE nom_site='$ID' 
                AND clef_visiteur.ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID')
                AND clef_visiteur.ID_user=(SELECT ID_user FROM users WHERE email='$email')ORDER BY nom_zone"));

        }


        return view('Liste-des-zones')->with('zone',$zone)->with('site',$site);

    }


    protected function validateformrenommer(Request $request)
    {
        $request->all();

        $this->validate($request, [
            'nom_zone' => 'required|string|max:100|exists:zones',
            'Nom_zone' => 'required|string|max:100',
            'nom_site' => 'required|string|max:100|exists:site'
        ]);
        $nom_zone=$request['nom_zone'];
        $newnom_zone=$request['Nom_zone'];
        $nom_site=$request['nom_site'];
        $ID=$_GET['ID'];

        $email=Session::get('user_email');

        $verif=DB::select(DB::raw("SELECT nom_zone,email,nom_site FROM zones NATURAL join users NATURAL join site WHERE nom_zone='$nom_zone' AND email='$email' AND nom_site='$nom_site'"));
        $verif2=DB::select(DB::raw("SELECT nom_zone,email,nom_site FROM zones NATURAL join users NATURAL join site WHERE nom_zone='$newnom_zone' AND email='$email' AND nom_site='$nom_site'"));

        if ($verif!=null){
            if ($verif2==null){
                DB::update(DB::raw("UPDATE zones SET nom_zone='$newnom_zone' WHERE nom_zone='$nom_zone' AND ID_user=(SELECT ID_user FROM users WHERE email='$email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$nom_site')"));

                return Redirect::to("Liste-des-zones?ID=$ID")->with('message',$nom_zone.trans('info.rename').$newnom_zone.trans('info.success'));
            }return Redirect::to("Liste-des-zones?ID=$ID")->with('message1',trans('info.zone').$newnom_zone.trans('info.sitealready').$nom_site);
        }return Redirect::to("Liste-des-zones?ID=$ID")->with('message1',trans('info.zone').$nom_zone.trans('info.sitealready').$nom_site.trans('info.unfounds'));


        dd($nom_zone,$newnom_zone,$nom_site);

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
