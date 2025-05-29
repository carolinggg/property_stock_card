<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 16px; border: none;">
                {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F, Y') ?? 'All Dates' }} INVENTORY
            </th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 14px; border: none;">
                Pangasinan State University
            </th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 12px; border: none;">
                Urdaneta City, Pangasinan
            </th>
        </tr>

        <tr style="border: none;"><td colspan="10" style="border: none;">&nbsp;</td></tr>
        <tr style="border: none;"><td colspan="10" style="border: none;">&nbsp;</td></tr>

        <tr>
            <th colspan="8" style="text-align: center;"></th>
            <th colspan="2" style="text-align: center;">To be filled up by the Accounting Unit</th>
        </tr>
        <tr>
            <th>Supply Type</th>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Purchased Quantity</th>
            <th>Purchased Amount</th>
            <th>Received Quantity</th>
            <th>Received Amount</th>
            <th>Issued Count</th>
            <th>Unit Cost</th>
            <th>Amount</th>
            <th>Total Amount</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($stocksByCategory as $category => $supplyGroups)
            @foreach ($supplyGroups as $supplyType => $stocks)
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ ucfirst($supplyType) }}</td>
                        <td>{{ $stock->item->item_name }}</td>
                        <td>{{ $stock->unit }}</td>
                        <td>{{ $stock->purchased_quantity }}</td>
                        <td>{{ number_format($stock->purchased_amount, 2) }}</td>
                        <td>{{ $stock->received_quantity }}</td>
                        <td>{{ number_format($stock->received_amount, 2) }}</td>
                        <td>{{ $stock->issued_count }}</td>
                        <td>{{ number_format($stock->unit_cost, 2) }}</td>
                        <td></td>
                        <td>{{ number_format($stock->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
        <tr>
            <td colspan="4" style="text-align: right;"></td>
            <td colspan="1" style="text-align: right;color:red">{{ number_format($grandTotalPurchasedAmount, 2) }}</td>
            <td colspan="4" style="text-align: right;"></td>

        </tr>
        <tr>
            <td colspan="9" style="text-align: right;"><strong>Grand Total</strong></td>
            <td><strong>{{ number_format($grandTotalAmount, 2) }}</strong></td>
        </tr>

    </tbody>

    {{-- Footer Signatories --}}
    <tr style="border: none;"><td colspan="10" style="border: none;">&nbsp;</td></tr>
    <tr>
        <td colspan="5" style="border: none;">I hereby certify the correctness of the above information</td>
        <td colspan="2" style="border: none;">Posted by / Date</td>
        <td colspan="2" style="border: none;">Noted</td>
    </tr>
        <tr style="border: none;"><td colspan="10" style="border: none;">&nbsp;</td></tr>

    <tr>
        <td colspan="2" style="border: none; text-align:center;"><strong>JOJE A. UBANDO</strong></td>
        <td colspan="2" style="border: none; text-align:center;"><strong>ERNOBILLE M. PLACO</strong></td>
        <td colspan="2" style="border: none; text-align:center;"><strong>CHENNA ANNE C. LANDINGIN</strong></td>
        <td colspan="4" style="border: none; text-align:center;"><strong>ROY C. FERRER, PhD</strong></td>
    </tr>
    <tr>
        <td colspan="2" style="border: none; text-align:center;">Supply Staff</td>
        <td colspan="2" style="border: none; text-align:center;">Campus Supply Officer</td>
        <td colspan="2" style="border: none; text-align:center;">Campus Accountant</td>
        <td colspan="4" style="border: none; text-align:center;">Campus Executive Director</td>
    </tr>
</table>
