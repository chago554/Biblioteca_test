<?php
/**
 * @author Santiago Jesus Laureano Flores
 */
class LibroModel {
    private $pdo;

    public function __construct($pdo) { $this->pdo = $pdo; }

    /**
     * Obtiene los primeros 10 libros
     *
     * @return array|false Un array asociativo con los datos de los libros o false en caso de error.
     */
    public function listar() {
        try {
            $stmt = $this->pdo->query("SELECT id, title, description, author, published_year, isbn FROM books LIMIT 10");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener los libros: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Crear un nuevo libro
     * 
     * @param array $datos Recibe un arreglo con los datos del nuevo libro
     */
    public function crearNuevoLibro($datos){

        $created_at = date('Y-m-d H:i:s');

        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, description, author, published_year, isbn, created_at) VALUES (:title, :description, :author, :published_year, :isbn, :created_at)");
            $stmt->bindParam(':title', $datos['title']);
            $stmt->bindParam(':description', $datos['description']);
            $stmt->bindParam(':author', $datos['author']);
            $stmt->bindParam(':published_year', $datos['published_year']);
            $stmt->bindParam(':isbn', $datos['isbn']);
            $stmt->bindParam(':created_at', $created_at);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al guardar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene un libro por su ID.
     *
     * @param int $id El ID del libro a buscar.
     * @return array|false Un array asociativo con los datos del libro o false si no se encuentra.
     */
    public function buscarByID($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, title, description, author, published_year, isbn, update_at FROM books WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener libro por ID: " . $e->getMessage());
            return false;
        }
    }

    /**
     *Actualiza la información de un libro existente.
     *
     * @param int $id El ID del libro a actualizar.
     * @param array $datos Un array asociativo con los datos a actualizar (title, description, author, published_year, isbn).
     * @return bool True si la actualización fue exitosa, false en caso de error.
     */
   
    public function actualizar($id, array $datos) {
        $update_at = date('Y-m-d H:i:s');
        try {
            $stmt = $this->pdo->prepare("UPDATE books SET title = :title, description = :description, author = :author, published_year = :published_year, isbn = :isbn, update_at = :update_at WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $datos['title']);
            $stmt->bindParam(':description', $datos['description']);
            $stmt->bindParam(':author', $datos['author']);
            $stmt->bindParam(':published_year', $datos['published_year']);
            $stmt->bindParam(':isbn', $datos['isbn']);
            $stmt->bindParam(':update_at', $update_at);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un libro por su ID.
     *
     * @param int $id El ID del libro a eliminar.
     * @return bool True si la eliminación fue exitosa, false en caso de error.
     */
    public function eliminar($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar libro: " . $e->getMessage());
            return false;
        }
    }
  
}