@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Email Templates</h1>
        <a href="{{ route('email-templates.create') }}" class="btn btn-primary">Create New Template</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $template)
                    <tr>
                        <td>{{ $template->name }}</td>
                        <td>{{ $template->subject }}</td>
                        <td>
                            <a href="{{ route('email-templates.show', $template->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('email-templates.edit', $template->id) }}" class="btn btn-primary">Edit</a>
                            {{-- Add delete button if needed --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection