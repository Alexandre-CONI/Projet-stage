@extends('template')

@section('head')
    <title id="title-doc">Liste des sites</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') )|| Session::get('user_rang')=="visiteur-eiffage" )
        @if(Hash::check('visiteur-eiffage',Session::get('user_hash') ))


            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"><h1>Liste des sites</h1></div>
                </div>
            </div>
            <br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des sites</div>
                            <div class="panel-body">
                                <div id="scroll">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td><strong>Image du site</strong></td>
                                            <td><strong>Nom du site</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($site as $sites)
                                            <tr>
                                                <td><img class="Image" alt="Image du site" src="/../Projet-capteur/public/image/Image/site/{{$sites->image_site}}"></td>
                                                <td><br>{{$sites->nom_site}}</td>
                                                <td><button onclick="self.location.href='{{url('Liste-des-zones?ID='.$sites->nom_site)}}'" >Liste des zones</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="pageTitre">Ajouter une clef d'accès</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-sites-vi/Ajouter') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('clef_visiteur') ? ' has-error' : '' }}">
                                            <label for="clef_visiteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Clef d'accés</label>

                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <input id="clef_visiteur" type="text" class="form-control" name="clef_visiteur" value="{{ old('clef_visiteur') }}" required>
                                                @if ($errors->has('clef_visiteur'))<p style="color:red;">{{trans('message.unknownkey')}}</p>@endif

                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <button type="submit" class="btn gerer">
                                                    Ajouter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="pageTitre">Supprimer un accés à un site</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-sites-vi/Supprimer') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('nom_site') ? ' has-error' : '' }}">
                                            <label for="nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>

                                            <div class="col-md-4 col-sm-4 col-xs-4 ">
                                                <select name="nom_site" data-show-subtext="true" data-live-search="true" class="form-control selectpicker" id="nom_site" required>
                                                    <option></option>
                                                    @foreach($site as $sites)
                                                        <option data-tokens="{{$sites->nom_site}}">{{$sites->nom_site}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
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