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

            <button type="submit" class="btn btn-primary mt-3">Update Item</button>
        </form>
    </div>

