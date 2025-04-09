# 🛠️ Biblioteca_test_practico

- **Versión:** 1.0.0
- **Fecha:** 2024-04-08
- **Autor:** Santiago Jesús Laureano Flores

---

## 📋 Descripción del Proyecto

Este es un proyecto de prueba para evaluar habilidades en desarrollo web. El objetivo es crear una aplicación web utilizando **PHP**, **HTML**, **CSS** y **JavaScript**.

La aplicación interactúa con una **API RESTful** para realizar operaciones **CRUD** (Crear, Leer, Actualizar, Eliminar) sobre una base de datos en **MySQL**. Además, debe contar con una interfaz de usuario amigable y responsiva, usando **Bootstrap** u otro framework CSS similar.

Se espera que el código esté bien estructurado, siguiendo el patrón **MVC (Modelo-Vista-Controlador)** y las **mejores prácticas de desarrollo web**.

---

## 🚀 Tecnologías Utilizadas

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP 8.4.1
- **Base de Datos:** MySQL 8.0.41
- **Control de Versiones:** Git
- **Entorno de Desarrollo:** Visual Studio Code
- **Servidor Local:** Apache 2 (XAMPP, LAMP o similar)

---

## 💻 Requisitos del Sistema

- PHP >= 8.0
- MySQL >= 8.0
- Apache2 o servidor compatible con PHP
- Navegador web moderno (Chrome, Firefox, Edge, etc.)
- Sistema operativo: Windows, Linux o macOS

---

## 📦 Instrucciones de Instalación

1. Clona este repositorio:

```bash
git clone https://github.com/chago554/Biblioteca_test.git
cd Biblioteca_test_practico
```

---

2. Configura las credenciales de la base de datos:
   - Crea una base de datos llamada `BIBLIOTECA` en tu servidor MySQL.
   - Importa el archivo `biblioteca.sql` que se encuentra en la carpeta `config/` a tu base de datos.
    
Edita el archivo config/config.php con tus datos:

```bash
<?php
$DB_HOST = '127.0.0.1';
$DB_NAME = 'BIBLIOTECA';
$DB_USER = 'tu_usuario';
$DB_PASSWORD = 'tu_contraseña';
?>
```

---

3. Importa la base de datos:

4. Abre el proyecto en tu navegador desde la carpeta public:

```bash
http://localhost/Biblioteca_test_practico/public/
```

---

## 📁 Estructura de Carpetas

```bash
Biblioteca_test/
├── config/
│   ├── config.php
│   └── database.php
├── controller/
│   └── LibroController.php
├── model/
│   └── LibroModel.php
├── public/
│   └── index.php
└── view/
    ├── layouts/
    │   ├── footer.php
    │   └── header.php
    └── libro/
        ├── editar.php
        ├── listar.php
        └── template.php
```

---

## 🧠 Decisiones de Diseño

Patrón MVC: Se separaron responsabilidades en modelos, vistas y controladores para mantener el código limpio y modular.

Diseño responsivo: Se utilizó Bootstrap para asegurar una buena experiencia en distintos dispositivos.

Paleta de colores: Azul y blanco, para transmitir una estética profesional y ordenada.

Simplicidad: Se priorizó un código fácil de mantener y escalar, evitando dependencias innecesarias.

Base de datos: Estructura normalizada para facilitar relaciones entre entidades en futuras ampliaciones.
