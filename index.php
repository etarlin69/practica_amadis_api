<?php
require_once 'config.php';
include 'includes/header.php'; 
?>

<div class="p-5 mb-4 bg-light rounded-3 text-center">
    <div class="container-fluid py-5">
        <img src="images/foto_perfil.jpg" alt="Foto de Etarlin" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        <h1 class="display-5 fw-bold">¡Bienvenido a mi Portal de APIs!</h1>
        <p class="fs-4">Soy Estarlin De La Cruz</p>
        <p>Este es un proyecto para demostrar la integración de diversas APIs utilizando PHP y Bootstrap 5. Navega por el menú para explorar las diferentes funcionalidades.</p>
        <a href="#apis" class="btn btn-primary btn-lg">Ver APIs</a>
    </div>
</div>

<div class="row text-center" id="apis">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Predicción de Género</h5>
                <p class="card-text">Descubre el género probable de un nombre.</p>
                <a href="api_pages/1_genero.php" class="btn btn-secondary">Probar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
         <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datos de Pokémon</h5>
                <p class="card-text">Encuentra información sobre tu Pokémon favorito.</p>
                <a href="api_pages/5_pokemon.php" class="btn btn-secondary">Probar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generador de Chistes</h5>
                <p class="card-text">¡Ríete un poco con un chiste al azar!</p>
                <a href="api_pages/10_chistes.php" class="btn btn-secondary">Probar</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>