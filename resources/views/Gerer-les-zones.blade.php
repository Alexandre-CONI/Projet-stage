@extends('template')

@section('head')
    <title id="title-doc">Gérer les zones</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))
            @foreach($site as $sites)
                <div class="col-md-12 col-sm-12 col-xs-12"><h1>{{$sites->nom_site}}</h1></div><br><br><br><br><br><br>
            @endforeach


            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                    <h4 href="#null" onclick="self.location.href='{{url('Detail-sur-un-client?ID='.$_GET['id'])}}'">Retour arrière</h4>
                </div></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                                                <td>{{$zones->nom_zone}}</td>
                                                <td><button onclick="self.location.href='{{url('Liste-des-capteurs-ad?ID='.$sites->nom_site.'&zone='.$zones->nom_zone.'&id='.$_GET['id'])}}'" >Liste des capteurs</button></td>
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
                                <div class="pageTitre">Ajouter une zone</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-zones/Ajouter?ID='.$_GET['ID'].'&id='.$_GET['id']) }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message1')!= null)
                                            <div class="alert alert-danger">{{Session::get('message1')}}</div>
                                        @endif
                                        <div class="form-group{{ $errors->has('nom_zone') ? ' has-error' : '' }}">
                                            <label for="nom_zone" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom de la zone</label>

                                            <div class="col-md-5 col-sm-5 col-xs-5 selectContainer">
                                                <input id="nom_zone" type="text" class="form-control" name="nom_zone" value="{{old('nom_zone')}}"  required >
                                                @if ($errors->has('nom_zone'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 col-sm-4 col-xs-4 control-label">email du client</label>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <input id="email" type="text" class="form-control" name="email" value="{{$_GET['id']}}"  required readonly>
                                                @if ($errors->has('email'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif

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
                                <div class="pageTitre">Supprimer une zone</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-zones/Supprimer?ID='.$_GET['ID'].'&id='.$_GET['id']) }}">
                                        {{ csrf_field() }}
                                        @if(Session::get('message2')!= null)
                                            <div class="alert alert-danger">{{Session::get('message2')}}</div>
                                        @endif
                                        <div class="form-group{{ $errors->has('Nom_zone') ? ' has-error' : '' }}">

                                            <label for="Nom_zone" class="col-md-4 col-sm-4 col-xs-4 control-label">Nom de la zone</label>

                                            <div class="col-md-5 col-sm-5 col-xs-5 selectContainer">
                                                <select name="Nom_zone" class="form-control" id="Nom_zone" required>
                                                    <option></option>
                                                    @foreach($zone as $zones)
                                                        <option>{{$zones->nom_zone}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                                            <label for="Email" class="col-md-4 col-sm-4 col-xs-4 control-label">email du client</label>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <input id="Email" type="text" class="form-control" name="Email" value="{{$_GET['id']}}"  required readonly>
                                                @if ($errors->has('Email'))<p style="color:red;">{{trans('message.unknownemail')}}</p>@endif
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