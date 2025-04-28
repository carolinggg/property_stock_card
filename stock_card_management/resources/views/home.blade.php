<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Card Management</title>
    <!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <h1>Welcome to Stock Card Management</h1>

    <div style="display: flex; gap: 20px;">
        <a href="{{ route('items.index') }}">
            <button style="padding: 10px 20px;">Items</button>
        </a>

        <a href="{{ route('stocks.index') }}">
            <button style="padding: 10px 20px;">Stocks</button>
        </a>

        <a href="{{ route('issuances.index') }}">
            <button style="padding: 10px 20px;">Issuances</button>
        </a>
    </div>

</body>
</html>
<!-- Bootstrap 5.3 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>