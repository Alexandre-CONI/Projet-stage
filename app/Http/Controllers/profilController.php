<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Carbon\carbon;
use Illuminate\Support\Facades\Cache;

class profilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
        header("Pragma: no-cache");
        $Email = Session::get('user_email');
        $nbrsite = DB::select(DB::raw("SELECT COUNT(*)as nbrsite FROM hote WHERE hote.ID_user =(SELECT users.ID_user FROM users WHERE email='$Email')"));
        foreach ($nbrsite as $nbrsite){}


        $nbrcapteur = DB::select(DB::raw("SELECT COUNT(*)as nbrcapteur FROM capteur WHERE capteur.ID_user = (SELECT users.ID_user FROM users WHERE email='$Email')"));
        foreach ($nbrcapteur as $nbrcapteur){}


        $nbrzone = DB::select(DB::raw("SELECT COUNT(*) as nbrzone FROM zones where ID_user=(SELECT users.ID_user FROM users WHERE users.email='$Email')"));
        foreach ($nbrzone as $nbrzone){}

        return view('Profil')->with('nbrsite',$nbrsite)->with('nbrcapteur',$nbrcapteur)->with('nbrzone',$nbrzone);
    }

    protected function validateformnom(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'user_surname' => 'required|string|max:100',
        ]);
        $user_surname = $request['user_surname'];


        DB::table('users')
            ->where('email',Session::get('user_email'))
            ->update(['user_surname' => $user_surname]);
        Session::put('user_surname', $user_surname);

        return Redirect::to('Profil')->with('message',trans('info.surname'));

    }

    protected function validateformprenom(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'user_name' => 'required|string|max:100',
        ]);
        $user_name = $request['user_name'];

        DB::table('users')
            ->where('email',Session::get('user_email'))
            ->update(['user_name' => $user_name]);
        Session::put('user_name',$user_name);

        return Redirect::to('Profil')->with('message',trans('info.name'));
    }

    protected function validateformemail(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'email' => 'required|string|email|max:100|unique:users',
        ]);
        $Email = $request['email'];
        $result = DB::select(DB::raw("SELECT * FROM users WHERE email = '$Email'"));

        if ($result == null) {

            DB::table('users')
                ->where('email',Session::get('user_email'))
                ->update(['email' => $Email]);
            Session::put('user_email', $Email);

            return Redirect::to('Profil')->with('message',trans('info.email'));
        }else {return Redirect::to('Profil')->with('message',trans('info.error'));}
    }

    protected function validateformtel(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'user_phone' => 'required|max:100'
        ]);
        $user_phone = $request['user_phone'];

        DB::table('users')
            ->where('email',Session::get('user_email'))
            ->update(['user_phone' => $user_phone]);
        Session::put('user_phone',$user_phone);
        return Redirect::to('Profil')->with('message',trans('info.tel'));
    }

    protected function validateformavatar(Request $request)
    {
        $request->all();
        $this->validate($request, [
            'image' => 'required|image|max:100',
        ]);


        if($request->hasFile('image'))
        {
            $file = Input::file('image');

            $avatar=Session::get('user_avatar');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

            $name = $timestamp. '-' .$file->getClientOriginalName();
            if ($avatar!="avatar.png"){
                unlink(public_path().'/image/Image/avatar/'.$avatar);
            }
            $file->move(public_path().'/image/Image/avatar', $name);

            DB::table('users')
                ->where('email',Session::get('user_email'))
                ->update(['avatar' => $name]);
            Session::put('user_avatar',$name);





            return redirect('Profil')->with('message',trans('info.image'));
        }else {return redirect('Profil')->with('messageava',trans('info.unvalidimage'));}
    }

    protected function validateformpass(Request $request)
    {

        $request->all();
        $this->validate($request, [
            'Email' => 'required|string|email|max:100|exists:users',
            'password' => 'required|string|min:6|confirmed|max:100',
            'oldpassword' => 'required|string|min:6|max:100',
        ]);
        $Email = $request['Email'];
        $oldpass = $request['oldpassword'];

        $result = DB::select(DB::raw("SELECT users.password FROM users WHERE email = '$Email'"));
        foreach ($result as $result){

        }

        $checkpass=$result->password;

        if(Hash::check($oldpass,$checkpass )){

            $Pass = bcrypt($request['password']);
            DB::table('users')
                ->where('email',Session::get('user_email'))
                ->update(['password' => $Pass]);
            return Redirect::to('Profil')->with('message',trans('info.pass'));

        }
        else {return Redirect::to('Profil')->with('messagepass',trans('info.oldpass'));}
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
