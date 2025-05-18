@php
    $pageTitle = 'Add Stock for ' . $stock->item->item_name;
    $action = route('stocks.update', $stock->id);
    $methodOverride = 'PUT';
    $submitText = 'Update Stock';
@endphp

@extends('layouts.form')

@section('form-content')
    <div class="mb-3">
        <label for="item_id" class="form-label">Item</label>
        <select name="item_id" class="form-control" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" @if($item->id == $stock->item_id) selected @endif>
                    {{ $item->item_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity to Add</label>
        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') ?: $stock->quantity }}" required min="1">
    </div>

    <div class="mb-3">
        <label for="unit_cost" class="form-label">Unit Cost</label>
        <input type="number" name="unit_cost" class="form-control" value="{{ old('unit_cost') ?: $stock->unit_cost }}" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="reference" class="form-label">Reference</label>
        <input type="text" name="reference" class="form-control" value="{{ old('reference') ?: $stock->reference }}">
    </div>

    <div class="mb-3">
        <label for="ris_number" class="form-label">RIS Number</label>
        <input type="text" name="ris_number" class="form-control" value="{{ old('ris_number') ?: $stock->ris_number }}">
    </div>

    <div class="mb-3">
        <label for="receipt_qty" class="form-label">Receipt Quantity</label>
        <input type="number" name="receipt_qty" class="form-control" value="{{ old('receipt_qty') ?: $stock->receipt_qty }}">
    </div>

    <div class="mb-3">
        <label for="no_of_days_consume" class="form-label">Number of Days Consume</label>
        <input type="number" name="no_of_days_consume" class="form-control" value="{{ old('no_of_days_consume') ?: $stock->no_of_days_consume }}">
    </div>

    <div class="mb-3">
        <label for="unit" class="form-label">Unit</label>
        <input type="text" name="unit" class="form-control" value="{{ old('unit') ?: $stock->unit }}">
    </div>

    <div class="mb-3">
        <label for="supply_from" class="form-label">Supply From</label>
        <select name="supply_from" class="form-control">
            <option value="" disabled {{ is_null($stock->supply_from) ? 'selected' : '' }}>Select Supply Source</option>
            <option value="purchased" {{ $stock->supply_from === 'purchased' ? 'selected' : '' }}>Purchased</option>
            <option value="received" {{ $stock->supply_from === 'received' ? 'selected' : '' }}>Received</option>
        </select>
    </div>
@endsection
