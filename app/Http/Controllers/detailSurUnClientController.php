<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class detailSurUnClientController extends Controller
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

        $client=DB::Select(DB::raw("SELECT users.user_name,users.user_surname,users.email,users.user_phone,users.timestanp,(SELECT COUNT(*) FROM hote WHERE ID_user=(SELECT ID_user FROM users WHERE email='$ID'))as site,(SELECT COUNT(*) FROM capteur WHERE ID_user=(SELECT ID_user FROM users WHERE email='$ID'))as capteur,(SELECT COUNT(*) FROM zones WHERE ID_user=(SELECT ID_user FROM users WHERE email='$ID'))as zones FROM users WHERE email='$ID'"));
        $site=DB::Select(DB::raw("SELECT site.nom_site, site.image_site FROM site NATURAL join hote NATURAL join users WHERE users.email='$ID'"));

        return view('Detail-sur-un-client')->with('client',$client)->with('site',$site);

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
