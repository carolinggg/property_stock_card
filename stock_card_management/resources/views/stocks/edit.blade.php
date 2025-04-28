<!-- Edit Stock for a Specific Item -->
<h1>Edit Stock for Item: {{ $stock->item->item_name }}</h1>

<form action="{{ route('stocks.update', $stock->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- This tells Laravel we're updating an existing resource -->
    
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
        <input type="number" name="quantity" value="{{ old('quantity') }}" required min="1">
    </div>

    <div>
        <label for="unit_cost">Unit Cost</label>
        <input type="number" name="unit_cost" value="{{ old('unit_cost') ?: $stock->unit_cost }}" step="0.01" required>
    </div>

    <button type="submit">Update Stock</button>
</form>

<!-- Display Validation Errors (if any) -->
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
