<h1>Issuances</h1>
<a href="{{ route('issuances.create') }}">Create New Issuance</a>

<table border = 1>
    <thead>
        <tr>
            <th>Item</th>
            <th>Office</th>
            <th>Quantity Issued</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($issuances as $issuance)
            <tr>
                <td>{{ $issuance->item->item_name }}</td>
                <td>{{ $issuance->office }}</td>
                <td>{{ $issuance->qty_issued }}</td>
                <td>
                    <a href="{{ route('issuances.edit', $issuance->id) }}">Edit</a>
                    <form action="{{ route('issuances.destroy', $issuance->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
