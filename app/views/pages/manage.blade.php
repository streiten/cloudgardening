@extends('layouts.layout')
@section ('content')

<div class="container">

    @if (count($typers))
        @foreach ($typers as $typer)
            <div class="typer-wrap">
                <div class="typer">
                    <a href="{{ URL::route('show', $typer->slug ); }}">{{ $typer->typer }}</a>
                </div>

                <div class="action-buttons">
{{--
                    <a href="{{ URL::route('shot', $typer->slug ); }}" ><i class="fa fa-download"></i></a>
--}}
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('delete', $typer->id))) }}
                    {{ Form::button('', array('class' => 'delete-typer fa fa-trash-o','type'=>'submit')) }}
                    {{ Form::close() }}
                </div>
            </div>
        @endforeach
    @endif


    @if (count($importTypers))
        <br><br>Oh look, we found some more:<br>
        @foreach ($importTypers as $typer)
            <div class="typer-wrap">
                <div class="typer">
                    <a href="{{ URL::route('show', $typer->slug ); }}">{{ $typer->typer }}</a>
                </div>

                <div class="action-buttons">
{{--
                    <a href="{{ URL::route('shot', $typer->slug ); }}" ><i class="fa fa-download"></i></a>
--}}
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('delete', $typer->id))) }}
                    {{ Form::button('', array('class' => 'delete-typer fa fa-trash-o','type'=>'submit')) }}
                    {{ Form::close() }}
                </div>
            </div>
        @endforeach
        <br><br>
        <a href="{{ URL::route('importCookieTypers'); }}" class="btn btn-primary" >Import</a>
    @endif

    @if (!Auth::check() && count($typers))
        <div class="cta"><br><br>Save them forever and access from other devices ?<br>
            <a href="{{ URL::route('userCreate'); }}" class="btn btn-primary">Register</a>
        </div>
    @endif

    @if (!count($typers))
        <div class="cta">Nothing here yet! <br>
            <a href="{{ URL::route('create'); }}" class="btn btn-primary" >Create</a>
        </div>
    @endif



</div>
@stop
