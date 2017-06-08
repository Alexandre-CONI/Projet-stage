@extends('template')

@section('head')
    <title id="title-doc">Connexion</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Connexion.css">
@stop

@section('contenu')


    <div class="container">
        @if(Session::get('message1')!= null)

            <div class="alert alert-warning">{{Session::get('message1')}}</div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="pageTitre">Connexion</div>
                    <div class="panel-body">
                        @if(Session::get('message')!= null)

                            <div class="alert alert-warning">{{Session::get('message')}}</div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('Connexion/Client') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 col-sm-4 col-xs-4 control-label">E-Mail</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >
                                    @if ($errors->has('email'))<p style="color:red;">{{trans('message.mail')}}</p>@endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 col-sm-4 col-xs-4 control-label">Mot de passe</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                    <button type="submit" class="btn connexion">
                                        Connexion
                                    </button>

                                    <a class="inscrire" href="{{ url('Inscription') }}">
                                        Pas encore inscrit?
                                    </a>

                                </div>
                            </div>
                        </form>
                            <a class="inscrire" data-toggle="modal" data-target="#oublipass">
                                Mot de passe oublié?
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="oublipass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Oubli de mot de passe</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="pageTitre">Oubli de mot de passe</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('Connexion/Oublipasss') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                <label for="user_name" class="col-md-4 col-sm-4 col-xs-5 control-label">Prénom</label>

                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required >
                                                    @if ($errors->has('user_name'))<p style="color:red;">{{trans('message.unvalid')}}</p>@endif

                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">
                                                <label for="user_surname" class="col-md-4 col-sm-4 col-xs-5 control-label">Nom</label>

                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input id="user_surname" type="text" class="form-control" name="user_surname" value="{{ old('user_surname') }}" required >
                                                    @if ($errors->has('user_surname'))<p style="color:red;">{{trans('info.unvalid')}}</p>@endif

                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('EMail') ? ' has-error' : '' }}">
                                                <label for="EMail" class="col-md-4 col-sm-4 col-xs-5 control-label">E-Mail</label>

                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input id="EMail" type="email" class="form-control" name="EMail" value="{{ old('EMail') }}" required>
                                                    @if ($errors->has('EMail'))<p style="color:red;">{{trans('info.unvalid')}}</p>@endif


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
    </div><!-- /.modal -->

@stop