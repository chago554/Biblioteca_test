<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>


<body>
    <div class="container">
        <h1>Lista de Libros</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Autor</th>
                    <th>Año de Publicación</th>
                    <th>ISBN</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($libros): ?>
                    <?php foreach ($libros as $libro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($libro['title']); ?></td>
                            <td><?php echo htmlspecialchars($libro['description']); ?></td>
                            <td><?php echo htmlspecialchars($libro['author']); ?></td>
                            <td><?php echo htmlspecialchars($libro['published_year']); ?></td>
                            <td><?php echo htmlspecialchars($libro['isbn']); ?></td>
                            <td class="d-flex gap-2">
                                <a href="index.php?url=libro/editar/<?php echo $libro['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="index.php?url=libro/eliminarConfirmado/<?php echo $libro['id']; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Está seguro de que desea eliminar este libro?')">Eliminar</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay libros disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>



            <a href="index.php?url=libro/crear" class="btn btn-success mt-3">Agregar Nuevo Libro</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>