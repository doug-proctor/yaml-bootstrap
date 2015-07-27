@extends('app')

@section('content')

{{-- 	<header>
		<h1>{{ $project->name }}</h1>
	</header> --}}

	<div class="preview sidebar-closed">

		{!! Form::open(array('route' => ['projects.update', $project->id], 'method' => 'PATCH')) !!}
			{!! Form::textarea('yaml', $project->yaml, array('placeholder' => 'Yaml goes here...', 'class' => 'preview__textarea')) !!}
			{!! Form::submit('Save project', array('class' => 'btn btn-success preview__update-btn')) !!}

			<a href="/view/{{ $project->hash }}" target="_blank" class="btn btn-secondary preview__share-link">
				<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
				Get public URL
			</a>

		{!! Form::close() !!}

		<iframe src="/preview/{{$project->id}}" class="preview__iframe" seamless></iframe>

		<button href="#" class="btn btn-primary preview__toggle js-toggle">
			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>

	</div>

@endsection