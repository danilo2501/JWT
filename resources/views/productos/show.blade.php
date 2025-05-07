<!DOCTYPE html>
<html>
<head>
    <title>Producto {{  $producto->id }}</title>
</head>
<body>
    <h1>Producto con id = {{  $producto->id }}</h1>
    <ul>
        <li>{{ $producto->nombre }} - ${{ $producto->precio }} - Unidades en stock {{ $producto->stock }}</li>
    </ul>
</body>
</html>