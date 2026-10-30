<?php
session_start();
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [
        [
            'titulo'=>'Don Quijote de la Mancha',
            'autor'=>'Miguel de Cervantes',
            'imagen'=>'https://covers.openlibrary.org/b/isbn/9788420412146-L.jpg','descripcion'=>'Las aventuras de don Quijote y Sancho Panza.'
        ],
        [
            'titulo'=>'La metamorfosis',
            'autor'=>'Franz Kafka',
            'imagen'=>'https://covers.openlibrary.org/b/isbn/9788491050292-L.jpg','descripcion'=>'La historia de Gregor Samsa y su transformación.'
        ],
        [
            'titulo'=>'El principito',
            'autor'=>'Antoine de Saint-Exupéry',
            'imagen'=>'https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg',
            'descripcion'=>'Un relato sobre la amistad y la vida.'
        ]
    ];
}
function agregarLibro($titulo,$autor,$imagen,$descripcion) {
    $_SESSION['libros'][] = compact('titulo','autor','imagen','descripcion');
}
function editarLibro($id,$titulo,$autor,$imagen,$descripcion) {
    if (isset($_SESSION['libros'][$id])) $_SESSION['libros'][$id] = compact('titulo','autor','imagen','descripcion');
}
function eliminarLibro($id) {
    if (isset($_SESSION['libros'][$id])) {
        unset($_SESSION['libros'][$id]);
        $_SESSION['libros'] = array_values($_SESSION['libros']);
    }
}
function exigirLogin() {
    if (empty($_SESSION['username'])) { 
        header('Location: login.php'); 
        exit; 
    }
}
function exigirAdmin() {
    exigirLogin();
    if (($_SESSION['role'] ?? '') !== 'admin') { 
        header('Location: home.php'); 
        exit; 
    }
}
