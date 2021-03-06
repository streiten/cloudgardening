@extends('layouts.layout')
@section ('content')

  <div class="container text-center">
  	<div class="col-md-6 col-md-offset-3">

      {{ Form::open() }}
        @foreach ($errors->all() as $message)
         <p class="bg-danger"> {{ $message }} </p>
        @endforeach
        <div class="form-group">
          {{ Form::text('email',NULL,['class'=>'form-control','placeholder'=>'Email'])}}
        </div>
        <div class="form-group">
          {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password']) }}
        </div>
        <div class="form-group">
          {{ Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm password']) }}
        </div>
       {{ Form::submit('Create',['class'=>'btn btn-primary']) }}
      {{ Form::close() }}

  	</div>
  </div>
@stop


