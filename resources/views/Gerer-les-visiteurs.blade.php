@extends('template')

@section('head')
    <title id="title-doc">Gérer les visiteurs</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage")
        @if(Hash::check('client-eiffage',Session::get('user_hash')))

            <div class="col-md-12 col-sm-12 col-xs-12"><h1>Gérer les visiteurs</h1></div><br><br><br><br><br><br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div>
                            <div class="panel panel-default">
                                <div class="pageTitre">Gerer la clef d'accés</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-visiteurs/Reatribuer') }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message1')!= null)
                                            <div><div class="alert alert-danger">{{Session::get('message1')}}</div></div>
                                        @endif
                                        <div class="form-group{{ $errors->has('nom_site') ? ' has-error' : '' }}">
                                            <label for="nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>


                                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                                <select name="nom_site" class="form-control" id="nom_site" required>
                                                    <option></option>
                                                    @foreach($site as $sites)
                                                        <option>{{$sites->nom_site}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group{{ $errors->has('clef_visiteur') ? ' has-error' : '' }}">
                                                <label for="clef_visiteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Réattribuer la clef d'accés</label>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                    <button type="submit" class="btn gerer">
                                                        Réattribuer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form><br>

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-visiteurs/Definir') }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message2')!= null)
                                            <div><div class="alert alert-danger">{{Session::get('message2')}}</div></div>
                                        @endif
                                        <div class="form-group{{ $errors->has('Nom_site') ? ' has-error' : '' }}">
                                            <label for="Nom_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                                <select name="Nom_site" class="form-control" id="Nom_site" required>
                                                    <option></option>
                                                    @foreach($site as $sites)
                                                        <option>{{$sites->nom_site}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group{{ $errors->has('clef_visiteur') ? ' has-error' : '' }}">
                                            <label for="clef_visiteur" class="col-md-4 col-sm-4 col-xs-4 control-label">Définir la clef d'accés</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input id="clef_visiteur" type="text" class="form-control" name="clef_visiteur" value="{{ old('clef_visiteur') }}" required >
                                                @if ($errors->has('clef_visiteur'))<p style="color:red;">{{trans('message.key')}}</p>@endif

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-sm-8 col-xs-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                <button type="submit" class="btn gerer">
                                                    Réattribuer
                                                </button>
                                            </div>
                                        </div>


                                    </form>



                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="panel panel-default">
                                <div class="pageTitre">Supprimer des visiteurs</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-visiteurs/Supprimer') }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message3')!= null)
                                            <div><div class="alert alert-danger">{{Session::get('message3')}}</div></div>
                                        @endif
                                        <div class="form-group">
                                            <label class="col-md-7 col-sm-7 col-xs-7 control-label">Supprimer tous les visiteurs pour un site</label>
                                        </div>
                                        <div class="form-group{{ $errors->has('NOm_site') ? ' has-error' : '' }}">
                                            <label for="NOm_site" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom du site</label>

                                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                                <select name="NOm_site" class="form-control" id="NOm_site" required >
                                                    <option></option>
                                                    @foreach($site as $sites)
                                                        <option>{{$sites->nom_site}}</option>
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

                                    </form><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des visiteurs</div>
                            <div class="panel-body">
                                <div id="scroll2">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td>Image de profil</td>
                                            <td>Nom du site</td>
                                            <td><strong>Nom</strong></td>
                                            <td><strong>Prénom</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($visiteur as $visiteur)
                                            <tr>
                                                <td><img class="Image" alt="Image de profil" src="/../Projet-capteur/public/image/Image/avatar/{{$visiteur->avatar}}"></td>
                                                <td>{{$visiteur->nom_site}}</td>
                                                <td>{{$visiteur->user_surname}}</td>
                                                <td>{{$visiteur->user_name}}</td>
                                                <td></td>
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