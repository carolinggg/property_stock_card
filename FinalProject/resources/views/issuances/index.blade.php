@php
    $pageTitle = 'Issuances';
@endphp

@extends('layouts.admin')

@section('content-small')
<div class="container mt-5">

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Issuances List</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('issuances.create') }}" class="btn btn-primary mb-3">Create Issuance</a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity Issued</th>
                            <th>Office</th>
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
        </div>
    </div>
</div>
@endsection
