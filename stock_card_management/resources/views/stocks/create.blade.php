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
    <div>
        <label for="reference">Reference</label>
        <input type="text" name="reference" placeholder="Enter reference (optional)">
    </div>
    <div>
        <label for="supply_from">Supply From</label>
        <select name="supply_from" required>
            <option value="purchased">Purchased</option>
            <option value="received">Received</option>
        </select>
    </div>
    <div>
        <label for="receipt_qty">Receipt Quantity</label>
        <input type="number" name="receipt_qty" placeholder="Enter receipt quantity (optional)">
    </div>
    <div>
        <label for="unit">Unit</label>
        <input type="text" name="unit" placeholder="Enter unit (optional)">
    </div>
    
    <div>
        <label for="no_of_days_consume">Number of Days Consume</label>
        <input type="number" name="no_of_days_consume" placeholder="Enter number of days consumed (optional)">
    </div>
    <button type="submit">Create</button>
</form>
