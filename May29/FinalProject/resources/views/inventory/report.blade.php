@php
    $total_amount_received = 0;
    $total_amount = 0;
    $total_amount_issued = 0;
@endphp

<table border="1">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Quantity (Remaining)</th> <!-- Updated label -->
            <th>Amount Received</th>
            <th>Purchased supply and material fund</th>
            <th>Received Supply from Lingayen</th>
            <th>Amount (Purchases + Received × Unit Cost)</th>
            <th>Qty Issued</th>
            <th>Unit Cost</th>
            <th>Amount Issued</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $row)
            @php
                $remaining_qty = $row['qty_received'] - $row['qty_issued'];
                $total_amount_received += $row['amount_received'];
                $total_amount += $row['amount'];
                $total_amount_issued += $row['amount_issued'];
            @endphp
            <tr>
                <td>{{ $row['item_name'] }}</td>
                <td>{{ $row['unit'] }}</td>
                <td>{{ $remaining_qty }}</td> <!-- Show remaining instead of received -->
                <td>{{ number_format($row['amount_received'], 2) }}</td>
                <td>{{ $row['purchases'] }}</td>
                <td>{{ $row['received_supply'] }}</td>
                <td>{{ number_format($row['amount'], 2) }}</td>
                <td>{{ $row['qty_issued'] }}</td>
                <td>{{ number_format($row['unit_cost'], 2) }}</td>
                <td>{{ number_format($row['amount_issued'], 2) }}</td>
            </tr>
        @endforeach

        {{-- Totals Row --}}
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td colspan="3" align="right">TOTAL</td>
            <td>{{ number_format($total_amount_received, 2) }}</td>
            <td></td>
            <td></td>
            <td>{{ number_format($total_amount, 2) }}</td>
            <td></td>
            <td></td>
            <td>{{ number_format($total_amount_issued, 2) }}</td>
        </tr>
    </tbody>
</table>
