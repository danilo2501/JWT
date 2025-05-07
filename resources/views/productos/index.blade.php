<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Productos Disponibles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <th>{{ $producto->id }}</th>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <button>Editar</button>
                        <button>Eliminar</button>
                        <a href="{{ route('productos.create') }}">Registrar nuevo producto</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>