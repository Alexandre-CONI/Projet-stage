<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class gererLesZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        if(!isset($_GET['ID'])){
            return Redirect::to('Gerer-les-clients');
        }
        $ID=$_GET['ID'];
        $email=$_GET['id'];

        $site = DB::Select(DB::raw("SELECT site.nom_site FROM site WHERE site.nom_site='$ID'"));
        $zone=DB::Select(DB::raw("SELECT zones.nom_zone FROM zones NATURAL join site WHERE site.nom_site='$ID' ORDER BY nom_zone"));


        return view('Gerer-les-zones')->with('zone',$zone)->with('site',$site);

    }


    protected function validateformreajouter(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'nom_zone' => 'required|string|max:100',
            'email' => 'required|email|max:100|exists:users'
        ]);

        $ID=$_GET['ID'];
        $email=$_GET['id'];

        $zone=$request['nom_zone'];
        $Email = $request['email'];
        $verif = DB::select(DB::raw("SELECT * FROM hote WHERE ID_user=(SELECT ID_user FROM users WHERE email='$Email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID')"));
        $verif2 = DB::select(DB::raw("SELECT * FROM zones WHERE ID_user=(SELECT ID_user FROM users WHERE email='$Email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID') AND nom_zone='$zone'"));



        if($verif != null){
            if($verif2 == null){

                DB::insert(DB::raw("INSERT INTO zones(nom_zone,ID_user,ID_site) VALUE ('$zone',(SELECT ID_user FROM users WHERE email='$Email'),(SELECT ID_site FROM site WHERE nom_site='$ID'))"));

                return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message',trans('info.zone').$zone.trans('info.creatsite').$ID);
            }return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message1',trans('info.zone').$zone.trans('info.presentsite').$ID);
        }return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message1',trans('info.unowned').$ID);



    }

    protected function validateformsupprimer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'Nom_zone' => 'required|string|max:100',
            'Email' => 'required|email|max:100|exists:users'
        ]);
        $ID=$_GET['ID'];
        $email=$_GET['id'];

        $zone=$request['Nom_zone'];
        $Email = $request['Email'];

        $verif = DB::select(DB::raw("SELECT * FROM hote WHERE ID_user=(SELECT ID_user FROM users WHERE email='$Email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID')"));
        $verif2 = DB::select(DB::raw("SELECT * FROM zones WHERE ID_user=(SELECT ID_user FROM users WHERE email='$Email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID') AND nom_zone='$zone'"));
        $verif3 = DB::select(DB::raw("SELECT * FROM capteur WHERE ID_zones=(SELECT ID_zones FROM zones WHERE nom_zone='$zone' AND ID_user=(SELECT ID_user FROM users WHERE email='$Email') AND ID_site=(SELECT ID_site FROM site WHERE nom_site='$ID') AND nom_zone='$zone')"));
        foreach ($verif2 as $verif2){}


        if($verif != null){
            if($verif2 !=null){
                if ($verif3==null){

                    DB::table('zones')->where('nom_zone', '=', $zone)->where('ID_user',$verif2->ID_user)->where('ID_site',$verif2->ID_site)->delete();


                    return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message',trans('info.zone').$zone.trans('info.suppsite2').$ID);

                }return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message2',trans('info.zone').$zone.trans('info.availablesensor'));
            }return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message2',trans('info.zone').$zone.trans('info.unknownsite').$ID);
        }return Redirect::to("Gerer-les-zones?ID=$ID&id=$email")->with('message2',trans('info.unowned').$ID);
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
