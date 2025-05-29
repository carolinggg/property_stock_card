@extends('layouts.admin')
@php
    $pageTitle = 'Dashboard';
@endphp
@section('content')
<div class="container mt-4">

    <!-- Filter Form -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
        <div class="form-group" style="max-width: 300px;">
            <label for="item_id">Select Item:</label>
            <select name="item_id" id="item_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Choose Item --</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $selectedItemId == $item->id ? 'selected' : '' }}>
                        {{ $item->item_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Graph -->
    @if (!empty($stockData) && count($stockData) > 0)
        <canvas id="stockChart" height="100"></canvas>
    @else
        <p>No stock data available for this item.</p>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const stockData = @json($stockData);

    if (stockData.length > 0) {
        const ctx = document.getElementById('stockChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: stockData.map(item => item.date),
                datasets: [{
                    label: 'Stock Quantity',
                    data: stockData.map(item => item.quantity),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Stock Level Over Time'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantity'
                        }
                    }
                }
            }
        });
    }
</script>
@endsection
