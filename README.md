# Biblioteca_test_practico

La version de PHP utilizada es: PHP 8.4.1
La versión de MySQL utilizada es: 8.0.41

# Script SQL para crear la base de datos

CREATE DATABASE BIBLIOTECA; 

USE BIBLIOTECA; 

CREATE TABLE books(id int PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255), author VARCHAR(255), published_year int, isbn VARCHAR (13), description TEXT, created_at TIMESTAMP DEFAULT (CURRENT_TIMESTAMP), update_at TIMESTAMP);
