<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Card</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        .center-text {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="center-text">
        <p>General Form No. <br>
        Revised </p>
    </div>

    <h2 class="center-text">STOCK CARD</h2>
    <h4 class="center-text">PSU-Urdaneta Campus</h4>
    <h5 class="center-text">Agency</h5>

    <table>
        <tr>
            <td colspan="2" class="bold">Item: 
                <span style="font-weight:normal;">{{ $item->item_name }}</span>
            </td>
            <td colspan="2" class="bold">Description: 
                <span style="font-weight:normal;">{{ $item->item_description }}</span>
            </td>
            <td class="bold">Stock #:</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <td colspan="3" class="bold"></td>
                <td colspan="2" class="bold">ISSUANCE</td>
                <td colspan="2" class="bold"></td>
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
            @foreach ($stocks as $stock)
                @php
                    $hasIssuance = false;
                @endphp


                <!-- Then show issuances -->
                @foreach ($issuances as $issuance)
                    @if ($issuance->item_id == $item->id && $issuance->created_at->isSameDay($stock->created_at))
                        @php
                            $hasIssuance = true;
                        @endphp
                        <tr>
                            <td>{{ $issuance->created_at->format('Y-m-d') }}</td> <!-- Issuance Date -->
                            <td>{{ $issuance->reference ?? '' }}</td> <!-- Reference -->
                            <td></td> <!-- No receipt quantity in issuance -->
                            <td>{{ $issuance->qty_issued }}</td> <!-- Issuance quantity -->
                            <td>{{ $issuance->office }}</td> <!-- Office -->    
                            <td>{{ $issuance->balance_qty }}</td> <!-- Balance after issuance -->
                            <td>{{ $issuance->no_of_days ?? '' }}</td> <!-- Days consumed (optional) -->
                        </tr>
                    @endif
                @endforeach

            @endforeach
        </tbody>
    </table>

</body>
</html>
