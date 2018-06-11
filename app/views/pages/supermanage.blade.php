@extends('layouts.layout')
@section ('content')

<div class="container">
	<table class="table table-hover">
		<thead>
			<th>Typer</th>
			<th>Delete / Feature</th>
			<th>uid</th>
		</thead>

		<tbody>
			@foreach ($typers as $typer) 
			<tr>
				<td><a href="{{ URL::route('show', $typer->slug ); }}">{{ $typer->typer }}</a></td>
				<td>
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('delete', $typer->id))) }}
                    {{ Form::button('', array('class' => 'delete-typer fa fa-trash-o','type'=>'submit')) }}
                    {{ Form::close() }}

                    @if( $typer->featured )
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('unfeature', $typer->id))) }}
                        {{ Form::button('', array('class' => 'delete-typer fa fa-times','type'=>'submit')) }}
                        {{ Form::close() }}
                    @else
                        {{ Form::open(array('method' => 'PUT', 'route' => array('feature', $typer->id))) }}
                        {{ Form::button('', array('class' => 'delete-typer fa fa-check','type'=>'submit')) }}
                        {{ Form::close() }}
                    @endif

				</td>
				<td>{{ $typer->uid }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop
