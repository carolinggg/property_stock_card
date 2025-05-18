@php
    $pageTitle = 'Create Stock';
@endphp

@extends('layouts.form')

@section('form-content')
    <div class="mb-4">
        <label for="item_id" class="form-label">Item</label>
        <select name="item_id" class="form-control" required>
            <option value="" disabled {{ old('item_id') ? '' : 'selected' }}>Select an Item</option>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->item_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
    </div>

    <div class="mb-4">
        <label for="unit_cost" class="form-label">Unit Cost</label>
        <input type="number" name="unit_cost" class="form-control" step="0.01" value="{{ old('unit_cost') }}" required>
    </div>

    <div class="mb-4">
        <label for="reference" class="form-label">Reference (Optional)</label>
        <input type="text" name="reference" class="form-control" value="{{ old('reference') }}" placeholder="Reference (Optional)">
    </div>

    <div class="mb-4">
        <label for="ris_number" class="form-label">RIS Number (Optional)</label>
        <input type="text" name="ris_number" class="form-control" value="{{ old('ris_number') }}" placeholder="RIS Number (Optional)">
    </div>

    <div class="mb-4">
        <label for="receipt_qty" class="form-label">Receipt Quantity (Optional)</label>
        <input type="number" name="receipt_qty" class="form-control" value="{{ old('receipt_qty') }}" placeholder="Receipt Quantity (Optional)">
    </div>

    <div class="mb-4">
        <label for="no_of_days_consume" class="form-label">Number of Days to Consume (Optional)</label>
        <input type="number" name="no_of_days_consume" class="form-control" value="{{ old('no_of_days_consume') }}" placeholder="Number of Days Consume (Optional)">
    </div>

    <div class="mb-4">
        <label for="unit" class="form-label">Unit</label>
        <input type="text" name="unit" class="form-control" value="{{ old('unit') }}" placeholder="Unit (e.g., pcs)">
    </div>

    <div class="mb-4">
        <label for="supply_from" class="form-label">Supply From</label>
        <select name="supply_from" class="form-control">
            <option value="" disabled {{ old('supply_from') ? '' : 'selected' }}>Select Supply Source</option>
            <option value="purchased" {{ old('supply_from') == 'purchased' ? 'selected' : '' }}>Purchased</option>
            <option value="received" {{ old('supply_from') == 'received' ? 'selected' : '' }}>Received</option>
        </select>
    </div>
@endsection

@php
    $action = route('stocks.store');
    $methodOverride = null;  // POST method no override needed
    $submitText = 'Create Stock';
@endphp