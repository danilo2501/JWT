<!DOCTYPE html>
<html>
<head>
    <title>Crear nuevo Producto</title>
</head>
<body>
    <h1>Crear nuevo producto</h1>
    <form action="" method="POST"> {{-- El action apunta hacia una ruta de tipo POST --}}
        @csrf
        @method('POST')
        <span>Nombre:</span>
        <input type="text" name="nombre">
        <span>Precio:</span>
        <input type="number" name="precio" step="0.01">
        <span>Stock:</span>
        <input type="number" name="stock">
        <button type="submit">Guardar</button>
    </form>
</body>
</html>