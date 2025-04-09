<?php
class LibroController
{
    private $modeloLibro;

    // El constructor recibe $pdo y lo usa para crear el modelo
    public function __construct($pdo)
    {
        $this->modeloLibro = new LibroModel($pdo);
    }


    // Métodos para interactuar con el modelo y la vista
    public function listar()
    {
        $libros = $this->modeloLibro->listar();
        ob_start();
        require __DIR__ . '/../view/libro/listar.php';
        $content = ob_get_clean();
        require __DIR__ . '/../view/template.php';
    }

    /**
     * Carga el formulario para crear un nuevo libro.
     */
    public function cargarFormEditar($id)
    {
        $libro = $this->modeloLibro->buscarByID($id);
        ob_start();
        require __DIR__ . '/../view/libro/editar.php';
        $content = ob_get_clean();
        require __DIR__ . '/../view/template.php';
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
     * Elimina un libro de la base de datos después de confirmar la acción.
     */
    public function eliminarConfirmado($id)
    {
        if ($this->modeloLibro->buscarByID($id)) {
            if ($this->modeloLibro->eliminar($id)) {
                $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">Libro eliminado correctamente.</div>';
            } else {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Error al eliminar el libro.</div>';
            }
        } else {
            $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">El libro no existe.</div>';
        }

        header("Location: index.php?url=libro/listar");
        exit();
    }

    /**
     * Crear un nuevo libro.
     */
    public function crearNuevoLibro()
    {
        $_SESSION['old'] = $_POST;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $published_year = $_POST['published_year'];
            $isbn = str_replace('-', '', $_POST['isbn']);

            if (strlen($isbn) !== 13 || !ctype_digit($isbn)) {
                $_SESSION['alerta'] = '<div class="alert alert-warning" role="alert">El ISBN debe tener exactamente 13 dígitos numéricos.</div>';
                header("Location: index.php?url=libro/crear");
                exit();
            }

            if (
                empty($title) || trim($title) === '' ||
                empty($author) || trim($author) === '' ||
                empty($published_year) || trim($published_year) === '' ||
                empty($isbn) || trim($isbn) === ''
            ) {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Complete los campos obligatorios.</div>';
                header("Location: index.php?url=libro/crear");
                exit();
            }
            if ($published_year > date('Y')) {
                $_SESSION['alerta'] = '<div class="alert alert-warning" role="alert">El año de publicación está fuera de rango.</div>';
                header("Location: index.php?url=libro/crear");
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
                $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">Libro creado correctamente.</div>';
                header("Location: index.php?url=libro/listar");
                exit();
            } else {
                $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">Error al crear el libro.</div>';
                header("Location: index.php?url=libro/crear");
                exit();
            }
        } else {
            ob_start();
            require __DIR__ . '/../view/libro/crear.php';
            $content = ob_get_clean();
            require __DIR__ . '/../view/template.php';
        }
    }
}
