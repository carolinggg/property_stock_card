@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Summary of Supplies and Materials Issued</h2>
    <table class="table table-bordered table-striped">
       <thead>
    <tr>
        <th>Item Name</th>
        <th>RIS Number</th>
        <th>Unit</th>
        <th>Quantity Issued</th>
        <th>Unit Cost</th>
        <th>Office</th>
        <th>Total Cost</th>
        <th>Date Issued</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach($summary as $row)
    <tr>
        <td>{{ $row['item_name'] }}</td>
        <td>{{ $row['ris_number'] }}</td>
        <td>{{ $row['unit'] }}</td>
        <td>{{ $row['qty_issued'] }}</td>
        <td>{{ number_format($row['unit_cost'], 2) }}</td>
        <td>{{ $row['office'] }}</td>
        <td>{{ number_format($row['total_cost'], 2) }}</td>
        <td>{{ $row['created_at'] }}</td>
        <td></td>
    </tr>
    @endforeach
</tbody>
<a href="{{ route('issuances.summary.download') }}" class="btn btn-success mb-3">
    Download Summary (Excel)
</a>

    </table>
</div>
@endsection
