@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $task->title }}</h1>
    <p class="text-gray-600">{{ $task->description }}</p>
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Tasks</a>
    </div>
</div>
@endsection