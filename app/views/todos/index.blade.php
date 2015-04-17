@extends('layouts.main')
@section('content')
	<h2>All Todo Lists</h2>
	@foreach ($tasks as $task)
		<h4>{{ link_to_route('todos.show', $task->name, [$task->id]) }}</h4>
		<ul class="no-bullet button-group ">
			<li>
				{{ link_to_route('todos.edit', 'edit', [$list->id], ['class' => 'tiny button'])}}
			</li>
			<li>
				{{ Form::model($task, ['route' => ['todos.destroy', $task->id], 'method' => 'delete' ]) }}
					{{ Form::button('destroy', ['type' => 'submit', 'class' => 'tiny alert button'])}}
				{{ Form::close() }}
			</li>
		</ul>
	@endforeach
	{{ link_to_route('todos.create', 'Create New List', null, ['class' => 'success button']) }}
@stop