@extends('layouts.layout')
@section ('content')

    <div class="container text-center">
        <div class="col-md-6 col-md-offset-3">

            @if (Session::has('error'))
                <p class="bg-danger">{{ Session::get('error') }}</p>
            @endif

            {{ Form::open(array('route' => array('password.update', $token))) }}

            <div class="form-group">
                {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}
            </div>

            <div class="form-group">
                {{ Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm Password'])}}
            </div>

            {{ Form::hidden('token', $token) }}

            {{ Form::submit('submit',['class'=>'btn btn-primary']) }}
            {{ Form::close() }}

        </div>
    </div>
@stop
