<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\carbon;
use Illuminate\Support\Facades\Cache;

class gererLesSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $client=DB::Select(DB::raw("SELECT users.email FROM users WHERE ID_rang=(SELECT ID_rang FROM rang WHERE rang='client-eiffage') ORDER BY (email)"));

        return view('Gerer-les-sites')->with('client',$client);

    }
    protected function validateformsupprimer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'nom_Site' => 'required|max:100|exists:site',
            'Email' => 'required|string|email|max:100|exists:users',
        ]);
        $nom_site=$request['nom_Site'];
        $email=$request['Email'];


        $result = DB::select(DB::raw("SELECT (SELECT users.ID_user FROM users WHERE users.email = '$email')as IDuser,(SELECT site.ID_site FROM site WHERE site.nom_site = '$nom_site')as IDsite FROM hote"));
        foreach ($result as $result){
        }
        $ID_site=$result->IDsite;
        $ID_user=$result->IDuser;

        $verif = DB::select(DB::raw("SELECT capteur.ID_capteur FROM capteur WHERE ID_site ='$result->IDsite'"));
        $verif2= DB::select(DB::raw("SELECT nom_zone FROM zones WHERE ID_site ='$result->IDsite' "));


        if($verif == null && $verif2 == null){

            DB::table('hote')->where('ID_user', '=', $ID_user)->where('ID_site', '=', $ID_site)->delete();
            DB::table('clef_visiteur')->where('ID_site','=',$ID_site)->delete();
            DB::table('site')->where('nom_site', '=', $nom_site)->delete();



            return Redirect::to('Gerer-les-sites')->with('message',trans('info.site').$nom_site.trans('info.supp'));

        }else{return Redirect::to('Gerer-les-sites')->with('messageava2',trans('info.site').$nom_site.trans('info.errorsite').$nom_site);}
        return Redirect::to('Gerer-les-sites')->with('messageava2',trans('info.site').$nom_site.trans('info.unsupp'));
    }

    protected function validateformajouter(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'nom_site' => 'required|max:100|unique:site',
            'email' => 'required|string|email|max:100|exists:users',
            'image' => 'required|image|max:100',
        ]);

        $nom_site=$request['nom_site'];
        $email=$request['email'];



        if($request->hasFile('image'))
        {

            do{
                $str = "";
                $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $rand = mt_rand(0, $max);
                    $str .= $characters[$rand];
                }
                $result = DB::select(DB::raw("SELECT site.clef_visiteur FROM site WHERE clef_visiteur = '$str'"));
                foreach ($result as $result){
                }
            }while($result != null);

            DB::table('site')->insert(
                array('nom_site' => $nom_site, 'clef_visiteur' => $str)
            );

            DB::insert(DB::raw("INSERT IGNORE INTO hote(ID_user,ID_site)
        SELECT ID_user,(SELECT site.ID_site FROM site WHERE site.nom_site = '$nom_site') FROM users WHERE Email='$email'
        "));

            $file = Input::file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/image/Image/site', $name);
            DB::table('site')
                ->where('nom_site',$nom_site)
                ->update(['image_site' => $name]);

            return Redirect::to('Gerer-les-sites')->with('message',trans('info.site').$nom_site.trans('info.creat'));
        }else {return redirect('Gerer-les-sites')->with('messageava',trans('info.unvalidimage'));}
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
