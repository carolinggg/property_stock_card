@php
    $pageTitle = 'Edit Item';
    $action = route('items.update', $item->id);
    $methodOverride = 'PUT';
    $submitText = 'Update Item';
@endphp

@extends('layouts.form')

@section('form-content')
    <!-- Item Name -->
    <div class="form-group mb-4">
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name', $item->item_name) }}" required>
    </div>

    <!-- Item Description -->
    <div class="form-group mb-4">
        <label for="item_description">Item Description</label>
        <input type="text" name="item_description" id="item_description" class="form-control" value="{{ old('item_description', $item->item_description) }}">
    </div>

    <!-- Supply Type -->
    <div class="form-group mb-4">
        <label for="supply_type">Supply Type</label>
        <select name="supply_type" id="supply_type" class="form-control" required>
            <option value="Office Supply" {{ old('supply_type', $item->supply_type) == 'Office Supply' ? 'selected' : '' }}>Office Supply</option>
            <option value="Medical Supply" {{ old('supply_type', $item->supply_type) == 'Medical Supply' ? 'selected' : '' }}>Medical Supply</option>
            <option value="Janitorial Supply" {{ old('supply_type', $item->supply_type) == 'Janitorial Supply' ? 'selected' : '' }}>Janitorial Supply</option>
        </select>
    </div>
@endsection
