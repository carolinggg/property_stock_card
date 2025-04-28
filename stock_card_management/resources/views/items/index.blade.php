<!-- resources/views/items/index.blade.php -->
<h2> Items</h2>
<a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
<table border =1>
    <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->item_description }}</td>
                <td>
                    <a href="{{ route('items.edit', $item) }}">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>|
                    <a href="{{ route('items.stockcard', $item->id) }}" class="btn btn-info btn-sm">View Stock Card</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
