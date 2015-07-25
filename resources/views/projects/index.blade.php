@extends('app')

@section('content')

	@if (count($projects))
		<ul>
			@foreach($projects as $project)
				<li class="card">
					<a href="{{ URL::action('ProjectsController@show', $project->id) }}" class="card__title">
						{{ $project->name }}
					</a>
				</li>
			@endforeach
		</ul>
	@else 
		<p>You have no projects. Create a project to get started.</p>
	@endif

	<h4>Create a new project</h4>

	{!! Form::open(array('route' => 'projects.store', 'method' => 'POST')) !!}
		{!! Form::text('name', null, array('placeholder' => 'New project\'s name', 'class' => 'Xform-control')) !!}
		{!! Form::submit('Save project', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}

@endsection