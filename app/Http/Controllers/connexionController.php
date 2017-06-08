<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class connexionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        return view('Connexion');
    }
    protected function validateformcli(Request $request)
    {

        $request->all();
        $this->validate($request,[
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string',
        ]);

        $Email = $request['email'];
        $pass = $request['password'];

        $result = DB::select(DB::raw("SELECT users.password FROM users WHERE email = '$Email'"));
        foreach ($result as $result){

        }
        $checkpass=$result->password;

        if(Hash::check($pass,$checkpass )){

            $resulte=DB::select(DB::raw("SELECT users.ID_user,users.user_name,users.user_surname,users.email,users.user_phone,users.avatar,users.timestanp,(SELECT rang FROM rang WHERE rang.ID_rang=users.ID_rang)as rang FROM users WHERE users.email='$Email' "));

            foreach ($resulte as $resulte){

                $user_name=$resulte->user_name;
                $user_surname=$resulte->user_surname;
                $user_email=$resulte->email;
                $user_phone=$resulte->user_phone;
                $user_avatar=$resulte->avatar;
                $user_rang=$resulte->rang;
                $user_hash=bcrypt($resulte->rang);
                $user_timestamp=$resulte->timestanp;
            }
            if(isset($pass)AND isset($Email)){


                Session::put('user_name', $user_name);
                Session::put('user_surname', $user_surname);
                Session::put('user_email', $user_email);
                Session::put('user_phone', $user_phone);
                Session::put('user_avatar', $user_avatar);
                Session::put('user_timestamp', $user_timestamp);
                Session::put('user_rang', $user_rang);
                Session::put('user_hash', $user_hash);
                Session::put('user_type','LineChart');
                Session::put('user_format','Linéaires');

                if ($user_rang=="client-eiffage"){
                    $societe=DB::select(DB::raw("SELECT nom_societe FROM users NATURAL join societe WHERE email='$Email'"));
                    foreach ($societe as $societe){
                        $nom_societe=$societe->nom_societe;
                    }
                    Session::put('nom_societe', $nom_societe);
                }


            }else{ return Redirect::to('Connexion')->with('message',trans('info.unfound')); }


            if(Session::get('user_rang')=="admin-eiffage"){
                return Redirect::to('Accueil')->with('message',trans('info.coadmin'));
            }else{return Redirect::to('Accueil')->with('message',trans('info.co').Session::get('user_name').' '.Session::get('user_surname'));}

        }else {return Redirect::to('Connexion')->with('message',trans('info.unvalidpass'));}
    }

    protected function validateformoublipass(Request $request)
    {

        $request->all();
        $this->validate($request, [
            'user_name'=> 'required|string|max:100|exists:users',
            'user_surname'=> 'required|string|max:100|exists:users',
            'EMail' => 'required|string|email|max:100|exists:users',
        ]);
        $name=$request['user_name'];
        $surname=$request['user_surname'];
        $email=$request['EMail'];

        $verif=DB::select(DB::raw("SELECT * FROM users WHERE user_name='$name' AND user_surname='$surname' AND email='$email'"));

        if($verif!=null){

            $pass = "";
            $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 8; $i++) {
                $rand = mt_rand(0, $max);
                $pass .= $characters[$rand];
            }

            Mail::send('email.pass',['newpass' => $pass], function($message)
            {
                $message->from('alexandre.coni@viacesi.fr', 'Informiciel');
                $message->to('alexandre.coni@gmail.com', 'Alexandre CONI')->subject('Oubli de mot de passe');
            });

            $Pass = bcrypt($pass);

            DB::table('users')
                ->where('email',$email)
                ->update(['password' => $Pass]);

            return Redirect::to('Accueil')->with('message',trans('info.forgetpass'));
        }
        return Redirect::to('Connexion')->with('message1',trans('info.unvalid'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
