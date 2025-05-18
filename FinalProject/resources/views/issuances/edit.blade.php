@php
    $pageTitle = 'Edit Issuance';
    $action = route('issuances.update', $issuance->id);
    $methodOverride = 'PUT';
    $submitText = 'Update Issuance';
@endphp

@extends('layouts.form')

@section('form-content')
    <!-- Item -->
    <div class="form-group mb-4">
        <label for="item_id">Item</label>
        <select name="item_id" id="item_id" class="form-control" required>
            @foreach($items as $item)
                <option value="{{ $item->id }}" {{ $item->id == old('item_id', $issuance->item_id) ? 'selected' : '' }}>
                    {{ $item->item_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Office -->
    <div class="form-group mb-4">
        <label for="office">Office</label>
        <input type="text" name="office" id="office" class="form-control" value="{{ old('office', $issuance->office) }}" required>
    </div>

    <!-- Quantity Issued -->
    <div class="form-group mb-4">
        <label for="qty_issued">Quantity Issued</label>
        <input type="number" name="qty_issued" id="qty_issued" class="form-control" value="{{ old('qty_issued', $issuance->qty_issued) }}" required min="1">
    </div>
@endsection
