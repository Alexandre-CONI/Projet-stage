<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class gererLesClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        $client=DB::Select(DB::raw("SELECT societe.nom_societe,users.email,users.avatar FROM users NATURAL join societe WHERE ID_rang=(SELECT ID_rang FROM rang WHERE rang='client-eiffage') ORDER BY (email)"));


        return view('Gerer-les-clients')->with('client',$client);

    }

    protected function validateformajouter(Request $request)
    {

        $request->all();
        $this->validate($request, [
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|max:100',
            'nom_societe' => 'required|max:100|unique:societe',
        ]);

        $passnon= $request['password'];
        $Pass = bcrypt($request['password']);
        $Email = $request['email'];
        $Rank = "3";
        $nom_societe=$request['nom_societe'];


        $result = DB::select(DB::raw("SELECT * FROM users WHERE email = '$Email'"));
        if ($result == null) {

            DB::table('users')->insert(
                array('email' => $Email,'password' => $Pass,'ID_rang' => $Rank)
            );

            $ID_users = DB::select(DB::raw("SELECT ID_user FROM users WHERE email = '$Email'"));
            foreach ($ID_users as $ID_users){}

            DB::table('societe')->insert(
                array('nom_societe' => $nom_societe,'ID_user' => $ID_users->ID_user)
            );

            return Redirect::to('Gerer-les-clients')->with('message',trans('info.societe').$nom_societe.'success');

        }else {

            return Redirect::to('Gerer-les-clients');
        }




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
