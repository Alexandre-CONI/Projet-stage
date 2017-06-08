@extends('template')

@section('head')
    <title id="title-doc">Liste des capteurs</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
        @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"><h1>Liste des capteurs</h1></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4 href="#null" onclick="self.location.href='{{url('Liste-des-zones?ID='.$_GET['ID'])}}'">Retour arrière</h4>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Site : {{$_GET['ID']}}</h3>
                        <h3>Zone : {{$_GET['id']}}</h3>
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
                            <div class="pageTitre">Liste des capteurs</div>
                            <div class="panel-body">

                                <div id="scroll">


                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            @if(Session::get('user_rang')=="client-eiffage")
                                            <td><strong>Identifiant capteur</strong></td>
                                            @endif
                                            <td><strong>Nom du capteur</strong></td>
                                            @if(Session::get('user_rang')=="client-eiffage")
                                            <td><strong>Date de mise en service</strong></td>
                                            @endif
                                            <td><strong></strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($capteur as $capteurs)
                                            <tr>
                                                @if(Session::get('user_rang')=="client-eiffage")
                                                <td>{{$capteurs->capteur}}</td>
                                                @endif
                                                <td>{{$capteurs->nom_capteur}}</td>
                                                @if(Session::get('user_rang')=="client-eiffage")
                                                <td>{{$capteurs->timestamp_actif}}</td>
                                                @endif
                                                <td><button onclick="self.location.href='{{url('Donnee-du-capteur?ID='.$capteurs->capteur.'&id='.$_GET['ID'].'&zone='.$_GET['id'])}}'" >Donnée du capteur</button></td>
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
                            <div class="pageTitre">Changer le nom d'un capteur</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-capteurs/Renommer?ID='.$_GET['ID'].'&id='.$_GET['id']) }}">
                                    {{ csrf_field() }}
                                    @if(Session::get('message1')!= null)
                                        <div class="alert alert-danger">{{Session::get('message1')}}</div>
                                    @endif
                                    <div class="form-group{{ $errors->has('nom_capteur') ? ' has-error' : '' }}">
                                        <label for="nom_capteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Nouveau nom du capteur</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="nom_capteur" type="text" class="form-control" name="nom_capteur" value="{{ old('nom_capteur') }}" required>
                                            @if ($errors->has('nom_capteur'))<p style="color:red;">{{trans('message.maxsize')}}</p>@endif

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('capteur') ? ' has-error' : '' }}">
                                        <label for="capteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Identifiant du capteur</label>

                                        <div class="col-md-5 col-sm-5 col-xs-5 ">
                                            <select name="capteur" class="form-control" id="capteur" required>
                                                <option></option>
                                                @foreach($capteur as $capteurs)
                                                    <option>{{$capteurs->capteur}}</option>
                                                @endforeach
                                            </select>
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