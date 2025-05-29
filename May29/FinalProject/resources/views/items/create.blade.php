@php
    $pageTitle = 'Create Item';
@endphp

@extends('layouts.form')

@section('form-content')
    <div class="mb-4">
        <label for="item_name" class="form-label">Item Name</label>
        <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name') }}" required>
    </div>

    <div class="mb-4">
        <label for="item_description" class="form-label">Description</label>
        <input type="text" name="item_description" id="item_description" class="form-control" value="{{ old('item_description') }}">
    </div>

    <div class="mb-4">
        <label for="supply_type" class="form-label">Supply Type</label>
        <select name="supply_type" id="supply_type" class="form-control" required>
            <option value="Office Supply" {{ old('supply_type') == 'Office Supply' ? 'selected' : '' }}>Office Supply</option>
            <option value="Medical Supply" {{ old('supply_type') == 'Medical Supply' ? 'selected' : '' }}>Medical Supply</option>
            <option value="Janitorial Supply" {{ old('supply_type') == 'Janitorial Supply' ? 'selected' : '' }}>Janitorial Supply</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="unit_of_measure" class="form-label">Unit of measure</label>
        <input type="text" name="unit_of_measure" id="unit_of_measure" class="form-control" value="{{ old('unit_of_measure') }}">
    </div>

    <div class="mb-4">
        <label for="stock_number" class="form-label">Stock Number</label>
        <input type="text" name="stock_number" id="stock_number" class="form-control" value="{{ old('stock_number') }}">
    </div>
@endsection

@php
    $action = route('items.store');
    $methodOverride = null;  // POST method, no override
    $submitText = 'Create Item';
@endphp
