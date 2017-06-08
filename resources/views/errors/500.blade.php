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
                <p>{{trans('message.500')}}</p>
            </div>
        </div>
    </div>
    <br><br><br>
    <br><br><br>
    <br><br><br>
@stop