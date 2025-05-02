<!-- List all stocks -->
<h1>Stocks</h1>

<a href="{{ route('stocks.create') }}">Create New Stock</a>

<table border = 1>
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Cost</th>
            <th>Total Cost</th>
            <th>Reference</th>
            <th>Receipt Quantity</th>
            <th>Number of Days Consume</th>
            <th>Unit</th>
            <th>Supply From</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->item->item_name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ number_format($stock->unit_cost, 2) }}</td>
                <td>{{ number_format($stock->total_cost, 2) }}</td>
                <td>{{ $stock->reference }}</td>
                <td>{{ $stock->receipt_qty }}</td>
                <td>{{ $stock->no_of_days_consume }}</td>
                <td>{{ $stock->unit }}</td>
                <td>{{ $stock->supply_from }}</td>
                <td>
                    <a href="{{ route('stocks.edit', $stock->id) }}">Add Stock</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
 