@extends('layouts.admin')
@php
    $pageTitle = 'Unit Management';
@endphp
@section('content')
<div class="container">
    <a href="{{ route('units.create') }}" class="btn btn-primary mb-3">Add Unit</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{ $unit->unit_name }}</td>
                    <td>
                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection