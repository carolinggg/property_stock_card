@extends('layouts.admin')
@php
    $pageTitle = 'Add Office';
@endphp
@section('content')
<div class="container mt-4">
    <h2>Add New Office</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('offices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="office_name" class="form-label">Office Name</label>
            <input type="text" id="office_name" name="office_name" class="form-control" value="{{ old('office_name') }}" required placeholder="Enter office">
        </div>
        <button type="submit" class="btn btn-primary">Add Office</button>
        <a href="{{ route('offices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
