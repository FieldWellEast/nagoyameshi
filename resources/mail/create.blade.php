@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Email Template</h1>
        <form action="{{ route('email-templates.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Template</button>
        </form>
    </div>
@endsection