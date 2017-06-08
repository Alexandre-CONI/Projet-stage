@extends('template')

@section('head')
    <title id="title-doc">Gérer les clients</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
        @if(Hash::check('admin-eiffage',Session::get('user_hash')))
            <div class="col-md-12 col-sm-12 col-xs-12"><h1>Gerer les clients</h1></div><br><br><br><br><br><br>

            <div class="container">
                @if(Session::get('message')!= null)
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Liste des clients</div>
                            <div class="panel-body">
                                <div id="scroll">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <td></td>
                                            <td><strong>Nom de la societe</strong></td>
                                            <td><strong>Email du client</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($client as $clients)
                                            <tr>
                                                <td><img class="Image" alt="Image du site" src="/../Projet-capteur/public/image/Image/avatar/{{$clients->avatar}}"></td>
                                                <td>{{$clients->nom_societe}}</td>
                                                <td>{{$clients->email}}</td>
                                                <td><button onclick="self.location.href='{{url('Detail-sur-un-client?ID='.$clients->email)}}'" >Détail du client</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="pageTitre">Ajouter une société</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('Gerer-les-clients') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 col-sm-4 col-xs-5 control-label">E-Mail</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))<p style="color:red;">{{trans('message.usedemail')}}</p>@endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 col-sm-4 col-xs-5 control-label">Mot de passe</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input id="password" type="password" class="form-control" name="password" required pattern=".{6,}" title="{{trans('message.pass')}}">

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                        <label for="nom_societe" class="col-md-4 col-sm-4 col-xs-5 control-label">Nom de la société</label>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input id="nom_societe" type="text" class="form-control" name="nom_societe" value="{{ old('nom_societe') }}" required >
                                            @if ($errors->has('nom_societe'))<p style="color:red;">{{trans('message.societe')}}</p>@endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn inscription">
                                                Ajouter
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