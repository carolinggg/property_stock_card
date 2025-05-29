@extends('layouts.admin')
@php
    $pageTitle = 'Edit Stock';
@endphp
@section('content')
<div class="container">
    <h2>Edit Unit</h2>
    <form action="{{ route('units.update', $unit->id) }}" method="POST"> @csrf @method('PUT')
        <div class="mb-3">
            <label for="unit_name" class="form-label">Unit Name</label>
            <input type="text" name="unit_name" class="form-control" value="{{ $unit->unit_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection