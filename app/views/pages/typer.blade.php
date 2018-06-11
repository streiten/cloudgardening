@extends('layouts.layout')

@section('content')
    <div class="container">
        
        {{ Form::model($typer, ['class'=>'horizontal-form']) }}

        <fieldset>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                  @foreach ($errors->all() as $message)
                      <p class="bg-danger text-center"> {{ $message }} </p>
                  @endforeach
                {{ Form::textarea('typer',null,['class'=>'form-control input-sm','placeholder'=>'','rows'=>3])}}
                {{ Honeypot::generate('my_name', 'my_time') }}
              </div>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-md-offset-3 text-center">
                {{Form::submit('Save',['class'=>'btn btn-primary text-center','id'=>'save',]); }}
                </div>
            </div>
          </div>
        </fieldset>
      {{ Form::close() }}
</div>
@stop
