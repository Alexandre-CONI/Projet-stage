@extends('template')

@section('head')
    <title id="title-doc">Gérer les sites</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))
            <div class="col-md-12 col-sm-12 col-xs-12"><h1>Gérer les sites</h1></div><br><br><br><br><br><br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>

                @endif
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12 ">
                        <div class="panel panel-default">
                            <div class="pageTitre">Ajouter un site pour un client</div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('Gerer-les-sites/Ajouter') }}">
                                    {{ csrf_field() }}
                                    @if(Session::get('messageava')!= null)
                                        <div><div class="alert alert-danger">{{Session::get('messageava')}}</div></div>
                                    @endif
                                    <div class="form-group{{ $errors->has('nom_site') ? ' has-error' : '' }}">
                                        <label for="nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input id="nom_site" type="text" class="form-control" name="nom_site" value="{{ old('nom_site') }}" required >
                                            @if ($errors->has('nom_site'))<p style="color:red;">{{trans('message.sensor')}}</p>@endif

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 col-sm-4 col-xs-4 control-label">E-Mail du client</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6 ">
                                            <select name="email" class="form-control" id="email" required>
                                                <option></option>
                                                @foreach($client as $clients)
                                                    <option>{{$clients->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('user_surname') ? ' has-error' : '' }}">
                                        <label for="avatar" class="col-md-4 col-sm-4 col-xs-5 control-label">Image du site</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input type="file" name="image">
                                            @if ($errors->has('image'))<p style="color:red;">{{trans('message.image')}}</p>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                            <button type="submit" class="btn gerer">
                                                Ajouter
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-6 col-xs-12 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="pageTitre">Supprimer un site d'un client</div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-sites/Supprimer') }}">
                                    {{ csrf_field() }}
                                    @if(Session::get('messageava2')!= null)
                                        <div ><div class="alert alert-danger">{{Session::get('messageava2')}}</div></div>
                                    @endif
                                    <div class="form-group{{ $errors->has('nom_Site') ? ' has-error' : '' }}">
                                        <label for="nom_Site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input id="nom_Site" type="text" class="form-control" name="nom_Site" value="{{ old('nom_Site') }}" required >
                                            @if ($errors->has('nom_Site'))<p style="color:red;">{{trans('message.unknownsensor')}}</p>@endif

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                                        <label for="Email" class="col-md-4 col-sm-4 col-xs-4 control-label">E-Mail du client</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6 ">
                                            <select name="Email" data-show-subtext="true" data-live-search="true" class="form-control selectpicker" id="Email" required>
                                                <option></option>
                                                @foreach($client as $clients)
                                                    <option data-tokens="{{$clients->email}}">{{$clients->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                            <button type="submit" class="btn gerer">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </form>

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