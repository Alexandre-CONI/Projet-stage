<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class gererLesVisiteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $email=Session::get ('user_email');
        $visiteur= DB::select(DB::raw("SELECT users.user_name,users.user_surname,users.avatar,site.nom_site FROM clef_visiteur Natural join users natural join  site LEFT OUTER JOIN hote on site.ID_site=hote.ID_site where hote.ID_user=(SELECT users.ID_user
 from users WHERE users.email='$email') ORDER BY nom_site"));
        $site=DB::select(DB::raw("SELECT nom_site FROM site NATURAL join hote NATURAL join users WHERE email ='$email'"));

        return view('Gerer-les-visiteurs')->with('visiteur',$visiteur)->with('site',$site);

    }

    protected function validateformreatribuer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'nom_site' => 'required|max:100|exists:site',
        ]);
        $nom_site=$request['nom_site'];
        $email=Session::get('user_email');

        $verif=DB::select(DB::raw("SELECT * FROM users NATURAL join hote NATURAL join site WHERE nom_site='$nom_site' AND email='$email'"));
        if ($verif!=null){

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

            DB::table('site')
                ->where('nom_site',$nom_site)
                ->update(['clef_visiteur' => $str]);
            return Redirect::to('Gerer-les-visiteurs')->with('message',$str.trans('info.newkey').$nom_site);
        }return Redirect::to('Gerer-les-visiteurs')->with('message1',trans('info.site').$nom_site.trans('info.notyours'));
    }

    protected function validateformdefinir(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'Nom_site' => 'required|max:100|exists:site',
            'clef_visiteur' => 'required|string|max:100|unique:site',
        ]);

        $nom_site=$request['Nom_site'];
        $clef_visiteur =$request['clef_visiteur'];
        $email=Session::get('user_email');

        $verif=DB::select(DB::raw("SELECT * FROM users NATURAL join hote NATURAL join site WHERE nom_site='$nom_site' AND email='$email'"));
        if ($verif!=null){

            DB::table('site')
                ->where('nom_site',$nom_site)
                ->update(['clef_visiteur' => $clef_visiteur]);

            return Redirect::to('Gerer-les-visiteurs')->with('message',$clef_visiteur.trans('info.newkey').$nom_site);
        }return Redirect::to('Gerer-les-visiteurs')->with('message2',trans('info.site').$nom_site.trans('info.notyours'));
    }

    protected function validateformsupprimer(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'NOm_site' => 'required|max:100|exists:site'
        ]);
        $nom_site=$request['NOm_site'];
        $email=Session::get('user_email');
        $verif=DB::select(DB::raw("SELECT ID_user,ID_site FROM site NATURAL join hote NATURAL join users where nom_site='$nom_site' AND email='$email'"));
        foreach ($verif as $verifs)

        if ($verif!=null){

            DB::table('clef_visiteur')->where('ID_site', '=', $verifs->ID_site)->delete();

            return Redirect::to('Gerer-les-visiteurs')->with('message',trans('info.visitor').$nom_site.trans('info.allsupp'));

        }return Redirect::to('Gerer-les-visiteurs')->with('message3',trans('info.site').$nom_site.trans('info.notyours'));

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
