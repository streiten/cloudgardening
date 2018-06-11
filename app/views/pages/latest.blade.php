@extends('layouts.layout')
@section ('content')

<div class="container text-center">
	<table class="table table-hover">
		<tbody>
			@foreach ($typers as $typer) 
			<tr>
				<td>{{ $typer->typer }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop
