@extends('template')

@section('head')
    <title id="title-doc">Inscription</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Inscription.css">

@stop

@section('contenu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="pageTitre">Inscription</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('Inscription') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                <label for="user_name" class="col-md-4 col-sm-4 col-xs-5 control-label">Prénom</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required >


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">
                                <label for="user_surname" class="col-md-4 col-sm-4 col-xs-5 control-label">Nom</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="user_surname" type="text" class="form-control" name="user_surname" value="{{ old('user_surname') }}" required >


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 col-sm-4 col-xs-5 control-label">E-Mail</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))<p style="color:red;">{{trans('message.usedemail')}}</p>@endif


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 col-sm-4 col-xs-5 control-label">Mot de passe</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="password" type="password" class="form-control" name="password" required pattern=".{6,}" title="{{trans('message.pass')}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 col-sm-4 col-xs-5 control-label">Confirmation du mot de passe</label>


                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password'))<p style="color:red;">{{trans('message.confirmationpass')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_phone') ? ' has-error' : '' }}">
                                <label for="user_phone" class="col-md-4 col-sm-4 col-xs-5 control-label">Numéro de téléphone</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input style="-moz-appearance: textfield" id="user_phone" type="number" class="form-control" name="user_phone" value="{{ old('user_phone') }}" required >


                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn inscription">
                                        Inscription
                                    </button>
                                    <a class="connecter" href="{{ url('Connexion') }}">
                                        Déja inscrit?
                                    </a>
                                </div>
                            </div>
                            <a class="connecter" id="mentions" onclick="self.location.href='{{url('Mentions-info-et-libertes')}}'" title="Politique de confidentialité">Mention informatique et liberté</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop