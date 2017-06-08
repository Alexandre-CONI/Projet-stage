@extends('template')

@section('head')
    <title id="title-doc">Profil</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Profil.css">
@stop

@section('contenu')
    @if(Session::get('message')!= null)
        <div class="container"><div class="alert alert-success">{{Session::get('message')}}</div></div>
    @endif
    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
        @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-7"><h1>Profil</h1></div>
                    <div class="col-md-2 col-sm-2 col-xs-3"><img class="Profil" onclick="alert('Oui c\'est votre image de profil. Pas la peine de clicker dessus')" alt="Image de profil" src="/../Projet-capteur/public/image/Image/avatar/{{Session::get('user_avatar')}}"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <div >
                            <div class="panel panel-default">
                                <div class="pageTitre">Informations diverses</div>
                                <div class="panel-body">
                                    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage")
                                        <div class="form-group1 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nom de la societe</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{Session::get('nom_societe')}}</label>
                                        </div><br><br>

                                    <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                        <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de sites</label>
                                        <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$nbrsite->nbrsite}}</label>
                                    </div><br><br>

                                    <div class="form-group1 col-md-12 col-sm-12 col-xs-12">
                                        <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de zones</label>
                                        <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$nbrzone->nbrzone}}</label>
                                    </div><br><br>

                                    <div class="form-group2 col-md-12 col-sm-12 col-xs-12">
                                        <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de capteurs</label>
                                        <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$nbrcapteur->nbrcapteur}}</label>
                                    </div><br><br>
                                        @endif
                                    <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                        <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Date de création du compte</label>
                                        <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{Session::get('user_timestamp')}}</label>
                                    </div><br><br>
                                </div>
                            </div>

                        </div>

                        <div>
                            <div class="panel panel-default">
                                <div class="pageTitre">Modifier son mot de passe</div>
                                <div class="panel-body">
                                    @if(Session::get('messagepass')!= null)
                                        <div class="container"><div class="alert alert-danger">{{Session::get('messagepass')}}</div></div>
                                    @endif
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Profil/Pass') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                            <label for="oldpassword" class="col-md-4 col-sm-4 col-xs-6 control-label">Ancien mot de passe</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" required pattern=".{6,}" title="{{trans('message.pass')}}">

                                                @if ($errors->has('oldpassword'))
                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('oldpassword') }}</strong>
                                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 col-sm-4 col-xs-6 control-label">Nouveau mot de passe</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="password" type="password" class="form-control" name="password" required pattern=".{6,}" title="{{trans('message.pass')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm" class="col-md-4 col-sm-4 col-xs-6 control-label">Confirmation nouveau du mot de passe</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                @if ($errors->has('password'))<p style="color:red;">{{trans('message.confirmationpass')}}</p>@endif
                                            </div>
                                        </div>


                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="Email" class="col-md-4 col-sm-4 col-xs-6 control-label">E-Mail</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="Email" type="email" class="form-control" name="Email" value="{{ old('Email') }}" required>
                                                @if ($errors->has('Email'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-4 col-xs-offset-4 col-sm-offset-4">
                                                <button type="submit" class="btn change">
                                                    Changer de mot de passe
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div>
                            <div class="panel panel-default">
                                <div class="pageTitre">Modifier son compte</div>
                                <div class="panel-body ">

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Profil/Nom') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">
                                            <label for="user_surname" class="col-md-4 col-sm-4 col-xs-5 control-label">Nom</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="user_surname" type="text" class="form-control textProfil" name="user_surname" value="{{Session::get('user_surname')}}" required >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn change">
                                                    Rectifier
                                                </button>

                                            </div>
                                        </div>
                                    </form><br>

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Profil/Prenom') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                            <label for="user_name" class="col-md-4 col-sm-4 col-xs-5 control-label">Prénom</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="user_name" type="text" class="form-control textProfil" name="user_name" value="{{Session::get('user_name')}}" required >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn change">
                                                    Rectifier
                                                </button>

                                            </div>
                                        </div>
                                    </form><br>

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Profil/Email') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 col-sm-4 col-xs-5 control-label">E-Mail</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="email" type="email" class="form-control textProfil" name="email" value="{{Session::get('user_email')}}" required>
                                                @if ($errors->has('email'))<p style="color:red;">{{trans('message.usedemail')}}</p>@endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn change">
                                                    Changer
                                                </button>

                                            </div>
                                        </div>
                                    </form><br>

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Profil/Tel') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group{{ $errors->has('user_phone') ? ' has-error' : '' }}">
                                            <label for="user_phone" class="col-md-4 col-sm-4 col-xs-5 control-label">Numéro de téléphone</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input style="-moz-appearance: textfield" id="user_phone" type="number" class="form-control textProfil" name="user_phone" value="{{Session::get('user_phone')}}" required >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn change">
                                                    Changer
                                                </button>

                                            </div>
                                        </div>
                                    </form><br>

                                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('Profil/avatar') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @if(Session::get('messageava')!= null)
                                            <div class="container"><div class="alert alert-danger">{{Session::get('messageava')}}</div></div>
                                        @endif
                                        <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">
                                            <label for="avatar" class="col-md-4 col-sm-4 col-xs-5 control-label">Image de profil</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="file" name="image">
                                                @if ($errors->has('image'))<p style="color:red;">{{trans('message.image')}}</p>@endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn change">
                                                    Changer
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




        @else
            <br>
            <div class="col-sm-offset-4 col-sm-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('message.problem')}}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{trans('message.404')}}</p>
                    </div>
                </div>
            </div>
            <br><br><br>
            <br><br><br>
            <br><br><br>
        @endif
    @else
        <br>
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('message.problem')}}</h3>
                </div>
                <div class="panel-body">
                    <p>{{trans('message.404')}}</p>
                </div>
            </div>
        </div>
        <br><br><br>
        <br><br><br>
        <br><br><br>
    @endif


@stop