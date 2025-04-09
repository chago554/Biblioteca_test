<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Editar libro</h1>

        <?php if (isset($libro)): ?> 
            
            <form action="index.php?url=libro/actualizar/<?= $libro['id'] ?>" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($libro['id']); ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($libro['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo ($libro['description']); ?>">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($libro['author']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="published_year" class="form-label">Año de publicación</label>
                    <input type="number" class="form-control" id="published_year" name="published_year" value="<?php echo htmlspecialchars($libro['published_year']); ?>" required min="1" max="<?php echo date('Y') ?>">
                </div>

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo htmlspecialchars($libro['isbn']); ?>" required minlength="17" maxlength="17" onkeyup="formatearISBN(this)">
                </div>

                <div class="mb-3">
                    <label for="update_at" class="form-label">Última actualización</label>
                    <input type="text" class="form-control" id="update_at" name="update_at" value="<?php echo ($libro['update_at'] == null) ? 'No hay actualizaciones' : htmlspecialchars($libro['update_at']); ?>" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="index.php?url=libro/listar" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Libro no encontrado.
            </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isbnInput = document.getElementById('isbn');
        if (isbnInput) {
            formatearISBN(isbnInput);
        }
    });

    function formatearISBN(isbn) {
        let value = isbn.value.replace(/[^0-9]/g, '');
        let formato = '';

        if (value.length > 0) {
            formato += value.substring(0, 3);
            if (value.length > 3) {
                formato += '-' + value.substring(3, 4);
            }
            if (value.length > 4) {
                formato += '-' + value.substring(4, 9);
            }
            if (value.length > 9) {
                formato += '-' + value.substring(9, 12);
            }
            if (value.length > 12) {
                formato += '-' + value.substring(12, 13);
            }
        }
        isbn.value = formato;
    }
</script>

</html>