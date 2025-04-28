<!-- Create Stock -->
<h1>Create Stock</h1>

<form action="{{ route('stocks.store') }}" method="POST">
    @csrf
    <div>
        <label for="item_id">Item</label>
        <select name="item_id" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" required>
    </div>
    <div>
        <label for="unit_cost">Unit Cost</label>
        <input type="number" name="unit_cost" step="0.01" required>
    </div>
    <button type="submit">Create</button>
</form>
