<h1>Edit Issuance</h1>

<form action="{{ route('issuances.update', $issuance->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="item_id">Item</label>
        <select name="item_id" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" @if($item->id == $issuance->item_id) selected @endif>{{ $item->item_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="office">Office</label>
        <input type="text" name="office" value="{{ $issuance->office }}" required>
    </div>
    <div>
        <label for="qty_issued">Quantity Issued</label>
        <input type="number" name="qty_issued" value="{{ $issuance->qty_issued }}" required>
    </div>
    <button type="submit">Update</button>
</form>
