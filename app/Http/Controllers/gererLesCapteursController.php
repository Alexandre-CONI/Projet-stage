<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class gererLesCapteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $capteur=DB::Select(DB::raw("SELECT capteur.capteur,capteur.timestamp_capteur FROM capteur WHERE ID_user is null AND ID_site is null AND ID_zones is null order by (capteur)"));

        return view('Gerer-les-capteurs')->with('capteur',$capteur);

    }
    protected function validateformajouter(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'CApteur' => 'required|string|max:100|unique:capteur',
        ]);
        $capteur=$request['CApteur'];
        DB::table('capteur')->insert(
            array('capteur' => $capteur)
        );
        return Redirect::to('Gerer-les-capteurs')->with('message',trans('info.sensor').$capteur.trans('info.add'));

    }

    protected function validateformsupprimer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'CAPteur' => 'required|string|max:100|exists:capteur',
        ]);
        $capteur=$request['CAPteur'];
        DB::table('capteur')->where('capteur', '=', $capteur)->delete();
        return Redirect::to('Gerer-les-capteurs')->with('message',trans('info.sensor').$capteur.trans('info.supp'));
    }

    protected function validateformdefinir(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'capteur' => 'required|string|max:100|exists:capteur',
            'nom_site' => 'required|string|max:100|exists:site',
            'email' => 'required|string|max:100|email|exists:users',
        ]);
        $capteur=$request['capteur'];
        $nom_site=$request['nom_site'];
        $Email=$request['email'];

        $ID_site=DB::select(DB::raw("SELECT ID_site FROM site WHERE nom_site='$nom_site'"));
        foreach ($ID_site as $ID_site2){}
        $ID_user=DB::select(DB::raw("SELECT ID_user FROM users WHERE email='$Email'"));
        foreach ($ID_user as $ID_user2){}
        $verif=DB::select(DB::raw("SELECT * FROM hote WHERE hote.ID_user='$ID_user2->ID_user' AND hote.ID_site='$ID_site2->ID_site'"));
        $verif2=DB::select(DB::raw("SELECT ID_user FROM capteur WHERE capteur='$capteur'"));
        foreach ($verif2 as $verif21){}

        if($verif != null){
            if($verif21->ID_user==null){
                DB::table('capteur')
                    ->where('capteur',$capteur)
                    ->update(['ID_user' => $ID_user2->ID_user,'ID_site' => $ID_site2->ID_site,'timestamp_actif' => DB::raw('now()')]);
                return Redirect::to('Gerer-les-capteurs')->with('message',trans('info.sensor').$capteur.trans('info.addsite').$nom_site.trans('info.success'));

            }else{return Redirect::to('Gerer-les-capteurs')->with('message1',trans('info.sensor').$capteur.trans('info.alreadyonwned'));}
        }else{return Redirect::to('Gerer-les-capteurs')->with('message1',trans('info.unowned').$nom_site);}


    }

    protected function validateformenlever(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'Capteur' => 'required|string|max:100|exists:capteur',
            'Nom_site' => 'required|string|max:100|exists:site',
            'Email' => 'required|string|max:100|email|exists:users',
        ]);
        $capteur=$request['Capteur'];
        $nom_site=$request['Nom_site'];
        $Email=$request['Email'];
        $ID_site=DB::select(DB::raw("SELECT ID_site FROM site WHERE nom_site='$nom_site'"));
        foreach ($ID_site as $ID_site2){}
        $ID_user=DB::select(DB::raw("SELECT ID_user FROM users WHERE email='$Email'"));
        foreach ($ID_user as $ID_user2){}
        $verif=DB::select(DB::raw("SELECT ID_site FROM capteur WHERE capteur='$capteur' AND ID_site='$ID_site2->ID_site'"));
        $verif2=DB::select(DB::raw("SELECT ID_user FROM capteur WHERE capteur='$capteur' AND ID_user='$ID_user2->ID_user'"));
        if($verif!=null){
            if($verif2!=null){
                DB::table('capteur')
                    ->where('capteur',$capteur)
                    ->update(['ID_user' => null,'ID_site' => null,'ID_zones'=>null,'nom_capteur'=>null]);
                return Redirect::to('Gerer-les-capteurs')->with('message',trans('info.sensor').$capteur.trans('info.suppsite').$nom_site.' avec succés');

            }else{return Redirect::to('Gerer-les-capteurs')->with('message2',trans('info.unowned').$capteur);}
        }else{return Redirect::to('Gerer-les-capteurs')->with('message2',trans('info.sensor').$capteur.trans('info.untargetsite').$nom_site);}

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
