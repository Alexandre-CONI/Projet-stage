@extends('template')

@section('head')
    <title id="title-doc">Liste-des-capteurs</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
    <script type="text/javascript" src="/../Projet-capteur/public/js/Find.js"></script>
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))

            <div class="col-md-12 col-sm-12 col-xs-12"><h1>{{$_GET['zone']}}</h1></div><br><br><br><br><br><br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 href="#null" onclick="self.location.href='{{url('Gerer-les-zones?ID='.$_GET['ID'].'&id='.$_GET['id'])}}'">Retour arrière</h4>
                </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="pageTitre">Liste des capteurs</div>

                        <div class="panel-body">

                <div id="scroll">


                <table class="table table-hover" >
                    <thead>
                    <tr>
                        <td><strong>Identifiant capteur</strong></td>
                        <td><strong>Date d'enregistrement du capteur</strong></td>
                        <td><strong>Date de mise en service</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($capteur as $capteurs)
                    <tr>
                        <td>{{$capteurs->capteur}}</td>
                        <td>{{$capteurs->timestamp_capteur}}</td>
                        <td>{{$capteurs->timestamp_actif}}</td>
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
                            <div class="pageTitre">Ajouter un capteur</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-capteurs-ad/Ajouter?ID='.$_GET['ID'].'&id='.$_GET['id']) }}">
                                    {{ csrf_field() }}
                                    @if(Session::get('message1')!= null)
                                        <div class="alert alert-danger">{{Session::get('message1')}}</div>
                                    @endif
                                    <div class="form-group{{ $errors->has('capteur') ? ' has-error' : '' }}">
                                        <label for="capteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Identifiant du capteur</label>

                                        <div class="col-md-5 col-sm-5 col-xs-5 ">
                                            <input id="capteur" type="text" class="form-control" name="capteur" value="{{old('capteur')}}" required>
                                            @if ($errors->has('capteur'))<p style="color:red;">{{trans('message.unknownsensor')}}</p>@endif

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 col-sm-4 col-xs-4 control-label">email du client</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="email" type="email" class="form-control" name="email" value="{{$_GET['id']}}" required readonly>
                                            @if ($errors->has('email'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('nom_site') ? ' has-error' : '' }}">
                                        <label for="nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">nom du site</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="nom_site" type="text" class="form-control" name="nom_site" value="{{$_GET['ID']}}" required readonly>
                                            @if ($errors->has('nom_site'))<p style="color:red;">{{trans('message.unknownsite')}}</p>@endif

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('nom_zone') ? ' has-error' : '' }}">
                                        <label for="nom_zone" class="col-md-4 col-sm-4 col-xs-4 control-label">nom de la zone</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="nom_zone" type="text" class="form-control" name="nom_zone" value="{{$_GET['zone']}}" required readonly>
                                            @if ($errors->has('nom_zone'))<p style="color:red;">{{trans('message.zone')}}</p>@endif

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

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Supprimer un capteur</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('Liste-des-capteurs-ad/Supprimer?ID='.$_GET['ID'].'&id='.$_GET['id']) }}">
                                    {{ csrf_field() }}
                                    @if(Session::get('message2')!= null)
                                        <div class="alert alert-danger">{{Session::get('message2')}}</div>
                                    @endif
                                    <div class="form-group{{ $errors->has('Capteur') ? ' has-error' : '' }}">
                                        <label for="Capteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Identifiant du capteur</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5 ">
                                            <select name="Capteur" class="form-control" id="Capteur" required>
                                                <option></option>
                                                @foreach($capteur as $capteurs)
                                                    <option>{{$capteurs->capteur}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                                        <label for="Email" class="col-md-4 col-sm-4 col-xs-4 control-label">email du client</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="Email" type="text" class="form-control" name="Email" value="{{$_GET['id']}}" required readonly>
                                            @if ($errors->has('Email'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('Nom_site') ? ' has-error' : '' }}">
                                        <label for="Nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">nom du site</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="Nom_site" type="text" class="form-control" name="Nom_site" value="{{$_GET['ID']}}" required readonly>
                                            @if ($errors->has('Nom_site'))<p style="color:red;">{{trans('message.unknownsite')}}</p>@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('Nom_zone') ? ' has-error' : '' }}">
                                        <label for="Nom_zone" class="col-md-4 col-sm-4 col-xs-4 control-label">nom de la zone</label>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input id="Nom_zone" type="text" class="form-control" name="Nom_zone" value="{{$_GET['zone']}}" required readonly>
                                            @if ($errors->has('Nom_zone'))<p style="color:red;">{{trans('message.zone')}}</p>@endif

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
            </div>
        @else
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