@extends('template')

@section('head')
    <title id="title-doc">Donnée du capteur</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/gerer.css">
@stop

@section('contenu')


    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
        @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
            <div class="container">
                @if(Session::get('message1')!= null)
                    <div class="alert alert-danger">{{Session::get('message1')}}</div>
                @endif
                <div class="row">
                    @foreach($capteur as $capteurs)
                        <div class="col-md-12 col-sm-12 col-xs-12"><h1>{{$capteurs->nom_capteur}}</h1></div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4 href="#null" onclick="self.location.href='{{url('Liste-des-capteurs?ID='.$_GET['id'].'&id='.$_GET['zone'])}}'">Retour arrière</h4>
                        </div>
                    @endforeach
                </div>
            </div><br>

            <div class="container">
                <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="pageTitre">{{$capteurs->nom_capteur}}</div>
                                <div class="panel-body">
                                    <div class="graph" id="Graph"style="width: 100%; height: 100%;"></div><br>
                                    @if($typeuse!=null)
                                    {!! \Lava::render(Session::get('user_type'),'Graph','Graph') !!}
                                    @else
                                    <div class="panel panel-danger error col-md-4 col-sm-8 col-xs-12">
                                    {{trans('message.graph')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>



                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Donnee-du-capteur/Format?ID='.$_GET['ID'].'&id='.$_GET['id'].'&zone='.$_GET['zone']) }}">
                                        {{ csrf_field() }}

                                        <label class="control-label">Changer le format</label>
                                        <br><br>
                                        <div class="form-group{{ $errors->has('format') ? ' has-error' : '' }}">

                                            <div class="col-md-2 col-sm-3 col-xs-6 ">
                                                <select name="format" class="form-control" id="format" required>
                                                    <option></option>
                                                    <option>Linéaires</option>
                                                    <option>Histogrammes</option>
                                                    <option>Pointeurs</option>
                                                    <option>Zones</option>
                                                </select>

                                            </div>
                                            <button  type="submit" class="btn gerer col-md-2 col-sm-2 col-xs-2">
                                                Changer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>





            <br>

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