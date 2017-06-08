@extends('template')

@section('head')
    <title id="title-doc">Liste des sites</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage")
        @if(Hash::check('client-eiffage',Session::get('user_hash') ) ))

            <div class="container">
                <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12"><h1>Liste des sites</h1></div>

                </div>
            </div>
            <br>

            <div class="container">
                <div class="row">

                    <div class="col-md-offset-2 col-sm-offset-2 col-md-8 col-sm-8 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des sites</div>
                            <div class="panel-body">
                                <div id="scroll">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td><strong>Image du site</strong></td>
                                            <td><strong>Nom du site</strong></td>
                                            <td><strong>Clef d'accés</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($site as $sites)
                                            <tr>
                                                <td><img class="Image" alt="Image du site" src="/../Projet-capteur/public/image/Image/site/{{$sites->image_site}}"></td>
                                                <td><br>{{$sites->nom_site}}</td>
                                                <td><br>{{$sites->clef_visiteur}}</td>
                                                <td><button onclick="self.location.href='{{url('Liste-des-zones?ID='.$sites->nom_site)}}'" >Liste des zones</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
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