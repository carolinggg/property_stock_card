<!-- Edit Stock for a Specific Item -->
<h1>Edit Stock for Item: {{ $stock->item->item_name }}</h1>

<form action="{{ route('stocks.update', $stock->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="ris_number">RIS Number</label>
        <input type="text" name="ris_number" value="{{ old('ris_number', $stock->ris_number) }}" placeholder="Enter RIS number (optional)">
    </div>

    <div>
        <label for="item_id">Item</label>
        <select name="item_id" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" @if($item->id == $stock->item_id) selected @endif>
                    {{ $item->item_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="quantity">Quantity to Add</label>
        <input type="number" name="quantity" value="{{ old('quantity', $stock->quantity) }}" required min="1">
    </div>

    <div>
        <label for="unit_cost">Unit Cost</label>
        <input type="number" name="unit_cost" value="{{ old('unit_cost', $stock->unit_cost) }}" step="0.01" required>
    </div>

    <div>
        <label for="reference">Reference</label>
        <input type="text" name="reference" value="{{ old('reference', $stock->reference) }}" placeholder="Enter reference (optional)">
    </div>

    <div>
        <label for="receipt_qty">Receipt Quantity</label>
        <input type="number" name="receipt_qty" value="{{ old('receipt_qty', $stock->receipt_qty) }}" placeholder="Enter receipt quantity (optional)">
    </div>

    <div>
        <label for="no_of_days_consume">Number of Days Consume</label>
        <input type="number" name="no_of_days_consume" value="{{ old('no_of_days_consume', $stock->no_of_days_consume) }}" placeholder="Enter number of days consumed (optional)">
    </div>

    <div>
        <label for="unit">Unit</label>
        <input type="text" name="unit" value="{{ old('unit', $stock->unit) }}" placeholder="Enter unit (optional)">
    </div>

    <div>
        <label for="supply_from">Supply From</label>
        <select name="supply_from">
            <option value="">-- Select --</option>
            <option value="purchased" @if(old('supply_from', $stock->supply_from) == 'purchased') selected @endif>Purchased</option>
            <option value="received" @if(old('supply_from', $stock->supply_from) == 'received') selected @endif>Received</option>
        </select>

    </div>

    <button type="submit">Update Stock</button>
</form>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
