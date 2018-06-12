@extends('layouts.layout')
@section ('content')

    <div class="container text-center">
        <div class="col-md-6 col-md-offset-3">

            @if (Session::has('error'))
                <p class="bg-danger">{{ Session::get('error') }}</p>
            @elseif (Session::has('success'))
                <p class="bg-success">{{ Session::get('success') }}</p>
            @endif

            {{ Form::open(array('route' => 'password.request')) }}
            <div class="form-group">
                {{ Form::text('email',NULL,['class'=>'form-control','placeholder'=>'Email'])}}
            </div>
            {{ Form::submit('submit',['class'=>'btn btn-primary']) }}
            {{ Form::close() }}

        </div>
    </div>
@stop


