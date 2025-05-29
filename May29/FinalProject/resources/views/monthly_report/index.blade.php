@php
    $pageTitle = 'Monthly Report';
@endphp

@extends('layouts.admin')

@section('content-small')
<div class="container mt-5">
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Summary Table</h4>
        </div>
        <div class="card-body">

            <h5>Monthly Report</h5>

            {{-- Month filter form --}}
            <form method="GET" action="{{ route('monthly_report.index') }}" class="mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="month" class="col-form-label">Select Month:</label>
                    </div>
                    <div class="col-auto">
                        <input type="month" id="month" name="month" class="form-control" value="{{ request('month', $month ?? '') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('monthly_report.index') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>RIST Number</th>
                            <th>Office</th>
                            <th>Item Name</th>
                            <th>Stock Quantity</th>
                            <th>Stock Unit Cost</th>
                            <th>Total Cost</th>
                                                        <!-- <th>Created At</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($report as $row)
                        <tr>
                            <td>{{ $row->ris_number }}</td>
                            <td>{{ $row->office ?? 'N/A' }}</td>
                            <td>{{ $row->item_name }}</td>
                            <td>{{ $row->quantity }}</td>
                            <td>₱{{ number_format($row->stock_unit_cost, 2) }}</td>
                            <td>₱{{ number_format($row->stock_total_cost, 2) }}</td>
                            <!-- <td>{{ $row->created_at }}</td> -->

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data found for selected month.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('monthly_report.download') }}" class="btn btn-success">
                Download CSV
            </a>
        </div>
    </div>
</div>
@endsection
