@extends('template')
@section('head')
@stop

@section('contenu')
    <br>

    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans('message.problem')}}</h3>
            </div>
            <div class="panel-body">
                <p>{{trans('message.404')}}</p>
                <h5 href="#null" onclick="javascript:history.back();" >Retour arrière</h5>
            </div>
        </div>
    </div>
    <br><br><br>
    <br><br><br>
    <br><br><br>
@stop