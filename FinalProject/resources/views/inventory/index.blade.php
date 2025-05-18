@php
    $pageTitle = 'Inventory Report';
@endphp

@extends('layouts.admin')

@section('content-small')

<div class="container mt-5">

    {{-- Month Filter Form --}}
    <form method="GET" action="{{ route('inventory.index') }}" class="mb-4 d-flex align-items-center gap-2">
        <label for="month" class="form-label mb-0"><strong>Filter by Month:</strong></label>
        <input 
            type="month" 
            id="month" 
            name="month" 
            class="form-control" 
            style="max-width: 180px;"
            value="{{ request('month', $month ?? '') }}"
        >
        <button type="submit" class="btn btn-primary">Filter</button>
        @if($month)
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>

   {{-- Optional header when month is selected --}}
@if($month)
    <div class="mb-4">
        <h5>Showing results for: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F, Y') }}</strong></h5>
    </div>
@endif

{{-- ✅ Always show table, regardless of month --}}
@foreach ($stocksByCategory as $category => $stocksBySupplyType)
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ ucfirst($category) }} Supplies</h4>
        </div>
        <div class="card-body">
            @foreach ($stocksBySupplyType as $supplyType => $stocks)
                <h5 class="mt-4 mb-3 text-secondary">{{ ucfirst($supplyType) }} Supplies</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Purchased Supplies and Materials (FUND 05-206441)</th>
                                <th>Purchased Amount</th>
                                <th>Received Supplies and Materials from Lingayen</th>
                                <th>Received Amount</th>
                                <th>Issued</th>
                                <th>Total Quantity</th>
                                <th>Unit Cost</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->item->item_name }}</td>
                                    <td>{{ $stock->unit }}</td>
                                    <td>{{ $stock->purchased_quantity }}</td>
                                    <td>{{ number_format($stock->purchased_amount, 2) }}</td>
                                    <td>{{ $stock->received_quantity }}</td>
                                    <td>{{ number_format($stock->received_amount, 2) }}</td>
                                    <td>{{ $stock->issued_count }}</td>
                                    <td>{{ $stock->total_quantity }}</td>
                                    <td>{{ number_format($stock->unit_cost, 2) }}</td>
                                    <td>{{ number_format($stock->total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        <table>
            <tfoot>
                <tr style="background-color: #e9f7ef; font-weight: 700; color: #2f855a; font-size: 1.15rem;">
                    <td colspan="9" class="text-end">Grand Total:</td>
                    <td>₱{{ number_format($grandTotalAmount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endforeach

{{-- ✅ Show download button only when month is selected --}}
@if($month)
    <form method="GET" action="{{ route('inventory.index') }}">
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="export" value="1">
        <button type="submit" class="btn btn-success mb-4">
            <i class="bi bi-download"></i> Download Excel Report
        </button>
    </form>
@endif
@endsection