<?php

class LibroController
{
    private $modeloLibro;
    private $pdo;

    public function __construct($pdo)
    {
        $this->modeloLibro = new LibroModel($pdo);
        $this->pdo = $pdo; // Guardar la instancia de PDO
    }

    /**
     * Listar los primeros 10 libros que se obtengan de la BD
     */
    public function listar()
    {
        $libros = $this->modeloLibro->listar();
        echo ' <div class=""><a href="index.php?url=libro/agregarFormulario" class="btn btn-success mt-3">Agregar Nuevo Libro</a></div>';
        $htmlTabla = '<table class="table table-striped table-hover ">
         <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Descripción</th>
            <th scope="col">Autor</th>
            <th scope="col">Año de publicación</th>
            <th scope="col">ISBN</th>
            <th scope="col">Acciones</th>
          </tr>
         </thead>
         <tbody>';

        if ($libros) {
            foreach ($libros as $libro) {
                $htmlTabla .= '<tr>';
                $htmlTabla .= '<th scope="row">' . htmlspecialchars($libro['title']) . '</th>';
                $htmlTabla .= '<td>' . htmlspecialchars($libro['description']) . '</td>';
                $htmlTabla .= '<td>' . htmlspecialchars($libro['author']) . '</td>';
                $htmlTabla .= '<td>' . htmlspecialchars($libro['published_year']) . '</td>';
                $htmlTabla .= '<td>' . htmlspecialchars($libro['isbn']) . '</td>';
                $htmlTabla .= '<td>
                    <button type="button" onclick="window.location.href=\'index.php?url=libro/editar/' . htmlspecialchars($libro['id']) . '\'" class="btn btn-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </button>
                    <button type="button" onclick="window.location.href=\'index.php?url=libro/eliminar/' . htmlspecialchars($libro['id']) . '\'" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </button>
       </td>';
                $htmlTabla .= '</tr>';
            }
        } else {
            $htmlTabla .= '<tr><td colspan="6">No se encontraron libros.</td></tr>';
        }
        $htmlTabla .= '</tbody></table>';
        echo $htmlTabla;
    }


    /**
     * Abre el formulario para modificar un libro
     * @param int $id El ID del libro que se desea modificar
     */
    public function editar($id)
    {
        $libro =  $this->modeloLibro->buscarByID($id);
        if ($libro) {
            include __DIR__ . '/../view/libro/editar.php';
        } else {
            $_SESSION['alerta'] = '<div class="alert alert-warning" role="alert">Libro no encontrado.</div>';
            header("Location: index.php?url=libro/listar");
            exit();
        }
    }

    /**
     * Procesa el formulario de edición y actualiza el libro en la base de datos.
     */
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title']; 
            $description = $_POST['description'];
            $author = $_POST['author'];
            $published_year = $_POST['published_year'];
            $isbn = str_replace('-', '', $_POST['isbn']);

            if (
                empty($title) || trim($title) === '' ||
                empty($author) || trim($author) === '' ||
                empty($published_year) || trim($published_year) === '' ||
                empty($isbn) || trim($isbn) === ''
            ) {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Complete los campos obligatorios.</div>';
                header("Location: index.php?url=libro/editar&id=" . urlencode($id));
                exit();
            }
            if ($published_year > date('Y')) {
                $_SESSION['alerta'] = '<div class="alert alert-warning" role="alert">El año de publicación está fuera de rango.</div>';
                header("Location: index.php?url=libro/editar&id=" . urlencode($id));
                exit();
            }

            $datos = [
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'published_year' => $published_year,
                'isbn' => $isbn
            ];


            if ($this->modeloLibro->actualizar($id, $datos)) {
                $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">Libro guardado correctamente.</div>';
                header("Location: index.php?url=libro/listar&mensaje=Libro actualizado correctamente");
                exit();
            } else {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Error al actualizar el libro.</div>';
                header("Location: index.php?url=libro/editar&id=" . urlencode($id));
                exit();
            }
        } else {
            header("Location: index.php?url=libro/listar");
            exit();
        }
    }

    /**
     * Elimina un libro de la base de datos.
     * @param int $id El ID del libro a eliminar.
     */
    public function eliminar($id)
    {
        if ($this->modeloLibro->eliminar($id)) {
            $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">Libro eliminado correctamente.</div>';
            header("Location: index.php?url=libro/listar&mensaje=Libro eliminado correctamente");
            exit();
        } else {
            $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Error al eliminar el libro.</div>';
            header("Location: index.php?url=libro/listar&error=Error al eliminar el libro");
            exit();
        }
    }

    /**
     * Muestra el formulario para agregar un nuevo libro.
     */
    public function agregarFormulario()
    {
        include __DIR__ . '/../view/libro/crear.php';
    }

    /**
     * Procesa el formulario para guardar un nuevo libro.
     */
    public function crearNuevoLibro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $published_year = $_POST['published_year'];
            $isbn = str_replace('-', '', $_POST['isbn']);

            if (
                empty($title) || trim($title) === '' ||
                empty($author) || trim($author) === '' ||
                empty($published_year) || trim($published_year) === '' ||
                empty($isbn) || trim($isbn) === ''
            ) {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Complete los campos obligatorios.</div>';
                header("Location: index.php?url=libro/agregarFormulario");
                exit();
            }


            if ($published_year > date('Y')) {
                $_SESSION['alerta'] = '<div class="alert alert-warning" role="alert">El año de publicación está fuera de rango.</div>';
                header("Location: index.php?url=libro/agregarFormulario");
                exit();
            }

            $datos = [
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'published_year' => $published_year,
                'isbn' => $isbn
            ];


            if ($this->modeloLibro->crearNuevoLibro($datos)) {
                $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">Libro guardado correctamente.</div>';
                header("Location: index.php?url=libro/listar&mensaje=Libro guardado correctamente");
                exit();
            } else {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Error al crear el libro.</div>';
                header("Location: index.php?url=libro/agregarFormulario");
                exit();
            }
        } else {
            header("Location: index.php?url=libro/listar");
            exit();
        }
    }
}
