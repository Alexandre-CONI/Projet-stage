<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class listDesSiteViController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $email = Session::get('user_email');
        $site=DB::Select(DB::raw("SELECT site.nom_site,site.image_site FROM site NATURAL join clef_visiteur NATURAL join users WHERE users.email='$email'"));

        return view('Liste-des-sites-vi')->with('site',$site);
    }

    protected function validateformajouter(Request $request)
    {

        $request->all();
        $this->validate($request, [
            'clef_visiteur' => 'required|string|max:100|exists:site'
        ]);
        $clef_visiteur = $request['clef_visiteur'];
        $email= Session::get('user_email');



        $verif=DB::select(DB::raw("SELECT clef_visiteur.ID_user,clef_visiteur.ID_site FROM clef_visiteur NATURAL join users NATURAL  join site WHERE clef_visiteur='$clef_visiteur' AND email='$email'"));


        if($verif==null){
            $idsite=DB::select(DB::raw("SELECT ID_site FROM site WHERE clef_visiteur='$clef_visiteur'"));
            foreach ($idsite as $idsites){}
            $iduser=DB::select(DB::raw("SELECT ID_user FROM users WHERE email='$email'"));
            foreach ($iduser as $idusers){}

            DB::table('clef_visiteur')->insert(
                array('ID_site' => $idsites->ID_site, 'ID_user' => $idusers->ID_user)
            );
            return Redirect::to('Liste-des-sites-vi')->with('message',trans('info.keyused').$clef_visiteur.trans('info.success'));
        }else{return Redirect::to('Liste-des-sites-vi')->with('message',trans('info.keyalready'));}

    }
    protected function validateformsupprimer(Request $request)
    {

        $request->all();
        $this->validate($request, [
            'nom_site' => 'required|string|max:100|exists:site'
        ]);
        $nom_site = $request['nom_site'];
        $email = Session::get('user_email');

        $verif = DB::select(DB::raw("SELECT clef_visiteur.ID_user,clef_visiteur.ID_site FROM clef_visiteur NATURAL join users NATURAL  join site WHERE nom_site='$nom_site' AND email='$email'"));

        if($verif!=null){

            $idsite=DB::select(DB::raw("SELECT ID_site FROM site WHERE nom_site='$nom_site'"));
            foreach ($idsite as $idsites){}
            $iduser=DB::select(DB::raw("SELECT ID_user FROM users WHERE email='$email'"));
            foreach ($iduser as $idusers){}

            DB::table('clef_visiteur')->where('ID_site', '=', $idsites->ID_site)->where('ID_user', '=', $idusers->ID_user)->delete();
            return Redirect::to('Liste-des-sites-vi')->with('message',trans('info.suppacces').$nom_site);
        }else{return Redirect::to('Liste-des-sites-vi')->with('message',trans('info.errorunexpected'));}
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
