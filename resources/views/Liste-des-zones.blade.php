@extends('template')

@section('head')
    <title id="title-doc">Liste des zones</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
        @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"><h1>Liste des zones</h1></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(Session::get('user_rang')=="client-eiffage")
                            <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4 href="#null" onclick="self.location.href='{{url('Liste-des-sites')}}'">Retour arrière</h4>
                            </div>
                            @elseif(Session::get('user_rang')=="visiteur-eiffage")
                            <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4 href="#null" onclick="self.location.href='{{url('Liste-des-sites-vi')}}'">Retour arrière</h4>
                            </div>
                        @endif
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Site : {{$_GET['ID']}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">
                    <div class="@if(Session::get('user_rang')=="visiteur-eiffage")col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-12 @else col-md-6 col-sm-6 col-xs-12 @endif">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des zones</div>
                            <div class="panel-body">
                                <div id="scroll">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td><strong>Nom de la zone</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($zone as $zones)
                                            <tr>

                                                <td><br>{{$zones->nom_zone}}</td>
                                                @foreach($site as $sites)
                                                    <td><button onclick="self.location.href='{{url('Liste-des-capteurs?ID='.$sites->nom_site.'&id='.$zones->nom_zone)}}'" >Liste des capteurs</button></td>
                                                    @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Session::get('user_rang')=="client-eiffage")
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="pageTitre">Changer le nom d'une zone</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-zones/Renommer?ID='.$_GET['ID']) }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message1')!= null)
                                            <div class="alert alert-danger">{{Session::get('message1')}}</div>
                                        @endif
                                        <div class="form-group{{ $errors->has('nom_zone') ? ' has-error' : '' }}">
                                            <label for="nom_zone" class="col-md-4 col-sm-4 col-xs-4 control-label">Ancien nom de la zone</label>
                                            <div class="col-md-5 col-sm-5 col-xs-5 ">
                                            <select name="nom_zone" class="form-control" id="nom_zone" required>
                                                <option></option>
                                                @foreach($zone as $zones)
                                                <option>{{$zones->nom_zone}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('Nom_zone') ? ' has-error' : '' }}">
                                            <label for="capteur" class="col-md-4 col-sm-4 col-xs-4 control-label">nouveau nom de la zone</label>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <input id="Nom_zone" type="text" class="form-control" name="Nom_zone" value="{{ old('Nom_zone') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('nom_site') ? ' has-error' : '' }}">
                                            <label for="nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <input id="nom_site" type="text" class="form-control" name="nom_site" value="{{ $_GET['ID'] }}" readonly required>
                                                @if ($errors->has('nom_site'))<p style="color:red;">{{trans('message.unknownsite')}}</p>@endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn gerer">
                                                    Renommer
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
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