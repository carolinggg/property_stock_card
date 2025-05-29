@extends('layouts.admin')
@php
    $pageTitle = 'Edit Office';
@endphp
@section('content')
<div class="container mt-4">
    <h2>Edit Office</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('offices.update', $office->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="office_name" class="form-label">Office Name</label>
            <input type="text" id="office_name" name="office_name" class="form-control" value="{{ old('office_name', $office->office_name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Office</button>
        <a href="{{ route('offices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
