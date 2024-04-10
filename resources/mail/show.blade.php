@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Email Template: {{ $template->name }}</h1>
        <p><strong>Subject:</strong> {{ $template->subject }}</p>
        <p><strong>Body:</strong></p>
        <p>{{ $template->body }}</p>
    </div>
@endsection