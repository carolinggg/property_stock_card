<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 16px; border: none;">
                ISSUANCE SUMMARY REPORT
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 14px; border: none;">
                Pangasinan State University
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 12px; border: none;">
                Urdaneta City, Pangasinan
            </th>
        </tr>

        <tr><td colspan="8" style="border: none;">&nbsp;</td></tr>
        <tr><td colspan="8" style="border: none;">&nbsp;</td></tr>

        <tr>
            <th>Item Name</th>
            <th>RIS Number</th>
            <th>Unit</th>
            <th>Quantity Issued</th>
            <th>Unit Cost</th>
            <th>Office</th>
            <th>Total Cost</th>
            <th>Date Issued</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($summary as $item)
            <tr>
                <td>{{ $item['item_name'] }}</td>
                <td>{{ $item['ris_number'] }}</td>
                <td>{{ $item['unit'] }}</td>
                <td>{{ $item['qty_issued'] }}</td>
                <td>{{ number_format($item['unit_cost'], 2) }}</td>
                <td>{{ $item['office'] }}</td>
                <td>{{ number_format($item['total_cost'], 2) }}</td>
                <td>{{ $item['created_at'] }}</td>
            </tr>
        @endforeach

        <tr><td colspan="8" style="border: none;">&nbsp;</td></tr>

        {{-- Footer Signatories --}}
        <tr>
            <td colspan="4" style="border: none;">I hereby certify the correctness of the above information</td>
            <td colspan="2" style="border: none;">Posted by / Date</td>
            <td colspan="2" style="border: none;">Noted</td>
        </tr>
        <tr><td colspan="8" style="border: none;">&nbsp;</td></tr>
        <tr>
            <td colspan="2" style="border: none; text-align:center;"><strong>JOJE A. UBANDO</strong></td>
            <td colspan="2" style="border: none; text-align:center;"><strong>ERNOBILLE M. PLACO</strong></td>
            <td colspan="2" style="border: none; text-align:center;"><strong>CHENNA ANNE C. LANDINGIN</strong></td>
            <td colspan="2" style="border: none; text-align:center;"><strong>ROY C. FERRER, PhD</strong></td>
        </tr>
        <tr>
            <td colspan="2" style="border: none; text-align:center;">Supply Staff</td>
            <td colspan="2" style="border: none; text-align:center;">Campus Supply Officer</td>
            <td colspan="2" style="border: none; text-align:center;">Campus Accountant</td>
            <td colspan="2" style="border: none; text-align:center;">Campus Executive Director</td>
        </tr>
    </tbody>
</table>
