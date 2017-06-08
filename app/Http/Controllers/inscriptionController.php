<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class inscriptionController extends Controller
{
    protected $redirectTo = '/Accueil';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        return view('Inscription');
    }

    protected function validateform(Request $request)
    {
        $request->all();
        $this->validate($request,[
            'user_name' => 'required|string|max:255',
            'user_surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_phone' => 'required||max:255'
        ]);


        if ($request['password'] == $request['password_confirmation']) {


            $Surname = $request['user_surname'];
            $Name = $request['user_name'];
            $Pass = bcrypt($request['password']);
            $Email = $request['email'];
            $Rank = "2";
            $User_phone = $request['user_phone'];

            $result = DB::select(DB::raw("SELECT * FROM users WHERE email = '$Email'"));
            if ($result == null) {

                DB::table('users')->insert(
                    array('user_name' => $Name, 'user_surname' => $Surname, 'email' => $Email,'password' => $Pass, 'user_phone' => $User_phone, 'ID_rang' => $Rank)
                );
            }
            $data=['name' => $Name, 'surname' => $Surname, 'email' => $Email];
            Mail::send('email.inscription',$data, function($message)use ($data)
            {

                $email= $data['email'];

                $message->from('alexandre.coni@viacesi.fr', 'Informiciel');
                $message->to($email, 'Alexandre CONI')->subject('Inscription');
            });

            return Redirect::to('Accueil')->with('message',trans('info.register'));
        }else {return redirect()->action('inscriptionController@index');}

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
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
