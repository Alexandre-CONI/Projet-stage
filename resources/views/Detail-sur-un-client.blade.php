@extends('template')

@section('head')
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
    <title id="title-doc">Détail sur un client</title>
@stop

@section('contenu')

    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))
            @foreach($client as $clients)
            <div class="col-md-12 col-sm-12 col-xs-12"><h1>{{$clients->user_surname}} {{$clients->user_name}}</h1></div><br><br><br><br><br><br>
            @endforeach
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 href="#null" onclick="self.location.href='{{url('Gerer-les-clients')}}'">Retour arrière</h4>
                </div></div>
                    <div class="col-md-6 col-sm-7 col-xs-12">
                        <div>
                            <div class="panel panel-default">
                                <div class="pageTitre">Informations relatives au compte</div>
                                @foreach($client as $clients)
                                    <div class="panel-body">
                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nom</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->user_surname}}</label>
                                        </div><br><br>

                                        <div class="form-group2 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Prénom</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->user_name}}</label>
                                        </div><br><br>

                                        <div class="form-group1 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Email</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->email}}</label>
                                        </div><br><br>

                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Numéro de téléphone</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->user_phone}}</label>
                                        </div><br><br>

                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Date de création du compte</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->timestanp}}</label>
                                        </div><br><br>

                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de sites</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->site}}</label>
                                        </div><br><br>

                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de capteurs</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->capteur}}</label>
                                        </div><br><br>

                                        <div class="form-group3 col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="col-md-6 col-sm-6 col-xs-6 control-label">Nombre de zones</label>
                                            <label class="col-md-6 col-sm-6 col-xs-6 text control-label">{{$clients->zones}}</label>
                                        </div><br>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5 col-xs-12">
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
                                                <td><button onclick="self.location.href='{{url('Gerer-les-zones?ID='.$sites->nom_site.'&id='.$clients->email)}}'" >Gerer les zones</button></td>
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