@extends('layouts.admin')
@php
    $pageTitle = 'Isssuances';
@endphp
@section('content')
<div class="container">
    <a href="{{ route('issuances.create') }}" class="btn btn-primary mb-3">Create Issuance</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Office
                </th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issuances as $issuance)
                <tr>
                    <td>{{ $issuance->item->item_name }}</td>
                    <td>{{ $issuance->qty_issued }}</td>
                    <td>{{ $issuance->office }}</td>
                    <td>{{ $issuance->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('issuances.edit', $issuance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('issuances.destroy', $issuance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
