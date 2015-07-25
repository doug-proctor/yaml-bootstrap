@if (Session::has('message'))
	<div class="alert" role="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif