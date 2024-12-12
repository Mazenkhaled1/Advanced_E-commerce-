<!DOCTYPE html>
<html>
<head>
    <title>Product Out of Stock</title>
</head>
<body>
    <h1>Product is Out of Stock</h1>
    <p>Product ID: {{ $product->id }}</p>
    <p>Product Name: {{ $product->title }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <p>Stock Quantity: {{ $product->quantity }}</p>
</body>
</html>
