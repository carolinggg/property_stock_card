<h2>Edit Item</h2>

<div class="container">
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name" value="{{ $item->item_name }}" required>
        </div>

        <div class="form-group">
            <label for="item_description">Item Description</label>
            <textarea class="form-control" name="item_description">{{ $item->item_description }}</textarea>
        </div>

        <div class="form-group">
            <label for="supply_type">Supply Type</label>
            <select name="supply_type" class="form-control" required>
                <option value="Office Supply" {{ $item->supply_type == 'Office Supply' ? 'selected' : '' }}>Office Supply</option>
                <option value="Medical Supply" {{ $item->supply_type == 'Medical Supply' ? 'selected' : '' }}>Medical Supply</option>
                <option value="Janitorial Supply" {{ $item->supply_type == 'Janitorial Supply' ? 'selected' : '' }}>Janitorial Supply</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Item</button>
    </form>
</div>
