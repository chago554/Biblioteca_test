<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<script>
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

<body>
    <div class="container">
        <h1>Agregar nuevo libro</h1>

        <form action="index.php?url=libro/crear" method="post">

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" >
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Año de publicación</label>
                <input type="number" class="form-control" id="published_year" name="published_year" require max="<?php echo date('Y') ?>" min="1" required>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" maxlength="17" onkeyup="formatearISBN(this)" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Libro</button>
            <a href="index.php?url=libro/listar" class="btn btn-danger">Cancelar</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>