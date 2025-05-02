<!-- resources/views/items/create.blade.php -->
<h2>Create Item</h2>
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div>
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name" id="item_name" required>
    </div>

    <div>
        <label for="item_description">Description</label>
        <input type="text" name="item_description" id="item_description">
    </div>

    <div>
        <label for="supply_type">Supply Type</label>
        <select name="supply_type" id="supply_type" required>
            <option value="" disabled selected>Select supply type</option>
            <option value="Office Supply">Office Supply</option>
            <option value="Medical Supply">Medical Supply</option>
            <option value="Janitorial Supply">Janitorial Supply</option>
        </select>
    </div>

    <button type="submit">Create Item</button>
</form>
