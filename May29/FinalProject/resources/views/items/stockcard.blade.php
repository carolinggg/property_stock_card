@php
    $pageTitle = 'Stock Card';
@endphp

@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-4">
        <h2 class="mb-0">STOCK CARD</h2>
        <h4 class="mb-0">PSU-Urdaneta Campus</h4>
        <h5>Agency</h5>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <strong>Item:</strong> {{ $item->item_name }}
                </div>
                <div class="col-md-4">
                    <strong>Description:</strong> {{ $item->item_description }}
                </div> 
                <div class="col-md-4">
                    <strong>Stock #:</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Month Filter Form --}}
    <form action="{{ route('items.stockcard', $item->id) }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="month" class="col-form-label">Filter by Month:</label>
            </div>
            <div class="col-auto">
                <input 
                    type="month" 
                    id="month" 
                    name="month" 
                    value="{{ old('month', $month ?? '') }}" 
                    class="form-control"
                >
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
                @if(!empty($month))
                    <a href="{{ route('items.stockcard', $item->id) }}" class="btn btn-secondary ms-2">Clear</a>
                @endif
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm table-striped text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th colspan="3"></th>
                        <th colspan="2">ISSUANCE</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Receipt Qty</th>
                        <th>Issuance Qty</th>
                        <th>Office</th>
                        <th>Balance Qty</th>
                        <th>No. of Days Consume</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grouped = [];

                        // Group stocks by reference (or fallback)
                        foreach ($stocks as $stock) {
                            $ref = $stock->reference ?? 'no-ref-' . $stock->id;
                            $grouped[$ref] = [
                                'date' => $stock->created_at->format('Y-m-d'),
                                'reference' => $stock->reference,
                                'receipt_qty' => $stock->receipt_qty ?? $stock->quantity,
                                'balance_qty' => $stock->quantity,
                                'no_of_days' => $stock->no_of_days_consume ?? '',
                                // empty issuance columns
                                'issuance_qty' => '',
                                'office' => '',
                            ];
                        }

                        // Append or merge issuance data with same reference keys
                        foreach ($issuances as $issuance) {
                            $ref = $issuance->reference ?? 'no-ref-' . $issuance->id;

                            // If already exists (stock), append issuance details
                            if (isset($grouped[$ref])) {
                                $grouped[$ref]['issuance_qty'] = $issuance->qty_issued;
                                $grouped[$ref]['office'] = $issuance->office;
                                // Update balance and no_of_days if needed
                                $grouped[$ref]['balance_qty'] = $issuance->balance_qty ?? $grouped[$ref]['balance_qty'];
                                $grouped[$ref]['no_of_days'] = $issuance->no_of_days ?? $grouped[$ref]['no_of_days'];
                            } else {
                                // New entry for issuance only
                                $grouped[$ref] = [
                                    'date' => $issuance->created_at->format('Y-m-d'),
                                    'reference' => $issuance->reference,
                                    'receipt_qty' => '',
                                    'issuance_qty' => $issuance->qty_issued,
                                    'office' => $issuance->office,
                                    'balance_qty' => $issuance->balance_qty ?? '',
                                    'no_of_days' => $issuance->no_of_days ?? '',
                                ];
                            }
                        }

                        // Sort entries by date ascending (optional)
                        usort($grouped, function($a, $b) {
                            return strtotime($a['date']) <=> strtotime($b['date']);
                        });
                    @endphp

                    @foreach ($grouped as $entry)
                        <tr>
                            <td>{{ $entry['date'] ?? '' }}</td>
                            <td>{{ $entry['reference'] ?? '' }}</td>
                            <td>{{ $entry['receipt_qty'] ?? '' }}</td>
                            <td>{{ $entry['issuance_qty'] ?? '' }}</td>
                            <td>{{ $entry['office'] ?? '' }}</td>
                            <td>{{ $entry['balance_qty'] ?? '' }}</td>
                            <td>{{ $entry['no_of_days'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
