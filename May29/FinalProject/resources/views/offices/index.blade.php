@extends('layouts.admin')
@php
    $pageTitle = 'Office Management';
@endphp
@section('content')
<div class="container mt-4">
    <h2>Offices</h2>

    <a href="{{ route('offices.create') }}" class="btn btn-primary mb-3">Add New Office</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Office Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offices as $office)
                <tr>
                    <td>{{ $office->office_name }}</td>
                    <td>
                        <a href="{{ route('offices.edit', $office->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('offices.destroy', $office->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this office?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($offices->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">No offices found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
