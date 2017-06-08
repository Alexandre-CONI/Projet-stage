@extends('template')

@section('head')
    <title id="title-doc">Accueil</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Accueil.css">
@stop

@section('contenu')


    <div class="container">
        @if(Session::get('message')!= null)
            @if(Session::get('messagevisiteur')!= null)
        <div class="alert alert-success">{{Session::get('messagevisiteur')}}</div>
            @endif
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif

            @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
                @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
                    <div class="row head">
                        <div class="col-md-10 col-sm-10 col-xs-12"><br><h1>{{Session::get('user_name')}} {{Session::get('user_surname')}}</h1></div>
                        <div class="col-md-2 col-sm-2 col-xs-12"><img class="Profil" onclick="self.location.href='{{url('Profil')}}'" alt="Image de profil" src="/../Projet-capteur/public/image/Image/avatar/{{Session::get('user_avatar')}}"></div>
                    </div>

                    <a class="contact" data-toggle="modal" data-target="#contact">
                        Nous contacter
                    </a>

                    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Nous contacter</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-9 col-xs-12">
                                                <div class="panel panel-default">
                                                    <div class="pageTitre">Nous contacter</div>
                                                    <div class="panel-body">
                                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('Accueil/Contact') }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                            <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                                <label for="sujet" class="col-md-4 col-sm-4 col-xs-5 control-label">Sujet</label>

                                                                <div class="col-md-5 col-sm-5 col-xs-5 selectContainer">
                                                                    <select name="sujet" class="form-control" id="sujet" required>
                                                                        <option></option>
                                                                        <option>Capteur</option>
                                                                        <option>Site</option>
                                                                        <option>Zone</option>
                                                                        <option>Qestions</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">

                                                                <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 col-xs-12">
                                                                    <textarea id="Text" type="text" class="form-control" name="Text" value="{{ old('Text') }}" required ></textarea>

                                                                </div>
                                                            </div>


                                                            <div >
                                                                <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                                    <button type="submit" value="visiteur" class="btn connexion">
                                                                        Envoyer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                @endif
                @else

                <br><br><br> <br><br><br><br>
            @endif

    </div>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    <br><br><br>

@stop

