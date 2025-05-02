

@foreach ($stocksByCategory as $category => $stocksBySupplyType)
    <h2>{{ ucfirst($category) }} Inventory</h2> <!-- Display the category name -->
    
    @foreach ($stocksBySupplyType as $supplyType => $stocks)
        <h3>{{ ucfirst($supplyType) }} Supplies</h3> <!-- Display the supply type (purchased/received) -->
        <table border="1">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Unit</th>
                    <th>Purchased Qty</th>
                    <th>Purchased Amount</th>
                    <th>Received Qty</th>
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
    @endforeach
@endforeach

<!-- Display Grand Total -->
<h3>Grand Total</h3>
<table border="1">
    <thead>
        <tr>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ number_format($grandTotalAmount, 2) }}</td>
        </tr>
    </tbody>
</table>
