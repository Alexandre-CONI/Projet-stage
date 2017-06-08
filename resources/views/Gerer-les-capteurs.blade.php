@extends('template')

@section('head')
    <title id="title-doc">Gérer les capteurs</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))
            <div class="col-md-12 col-sm-12 col-xs-12"><h1>Gérer les capteurs</h1></div><br><br><br><br><br><br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="pageTitre">Ajouter un capteur</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-capteurs/Ajouter') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('CApteur') ? ' has-error' : '' }}">
                                            <label for="CApteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Identifiant du capteur</label>

                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input id="CApteur" type="text" class="form-control" name="CApteur" value="{{ old('CApteur') }}" required>
                                                @if ($errors->has('CApteur'))<p style="color:red;">{{trans('message.sensor')}}</p>@endif

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
                                <div class="pageTitre">Supprimer un capteur</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-capteurs/Supprimer') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('CAPteur') ? ' has-error' : '' }}">
                                            <label for="CAPteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Identifiant du capteur</label>

                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input id="CAPteur" type="text" class="form-control" name="CAPteur" value="{{ old('CAPteur') }}" required>
                                                @if ($errors->has('CAPteur'))<p style="color:red;">{{trans('message.unknownsensor')}}</p>@endif

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

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des capteurs libres</div>
                            <div class="panel-body">

                                <div id="scroll">


                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td><strong>Identifiant capteur</strong></td>
                                            <td><strong>Date d'enregistrement du capteur</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($capteur as $capteurs)
                                            <tr>
                                                <td>{{$capteurs->capteur}}</td>
                                                <td>{{$capteurs->timestamp_capteur}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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