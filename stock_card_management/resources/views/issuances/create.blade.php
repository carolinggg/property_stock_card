<h1>Create Issuance</h1>

<form action="{{ route('issuances.store') }}" method="POST">
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
        <label for="office">Office</label>
        <input type="text" name="office" required>
    </div>
    <div>
        <label for="qty_issued">Quantity Issued</label>
        <input type="number" name="qty_issued" required>
    </div>
    <button type="submit">Create</button>
</form>
