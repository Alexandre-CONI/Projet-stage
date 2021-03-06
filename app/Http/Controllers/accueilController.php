<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class accueilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Cache::flush();
        return view('Accueil');
    }

    protected function validateformcontact(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'sujet' => 'required|string|max:100',
            'Text' => 'required|string|max:500',
        ]);
        $name = Session::get('user_name');
        $surname = Session::get('user_surname');
        $email = Session::get('user_email');
        $sujet = $request['sujet'];
        $text = $request['Text'];
        $data=['name' => $name, 'surname' => $surname, 'email' => $email, 'text' => $text, 'sujet' => $sujet];

        Mail::send('email.contact',$data , function ($message)use ($data) {

            $email=$data['email'];
            $name = $data['name'];
            $suname = $data['surname'];
            $sujet = $data['sujet'];

            $message->from($email, $name . ' ' . $suname);
            $message->to('admin@eiffage.fr', 'Imformiciel')->subject($sujet);
        });

        return Redirect::to('Accueil')->with('message', trans('info.send'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
                                                                                                                                                                                                                                                                                                                 