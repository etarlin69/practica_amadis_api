<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal de APIs - Etarlin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <i class="fas fa-code me-2"></i> Portal de APIs
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        APIs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="api_pages/1_genero.php">1. Predicción de Género</a></li>
                        <li><a class="dropdown-item" href="api_pages/2_edad.php">2. Predicción de Edad</a></li>
                        <li><a class="dropdown-item" href="api_pages/3_universidades.php">3. Universidades</a></li>
                        <li><a class="dropdown-item" href="api_pages/4_clima.php">4. Clima</a></li>
                        <li><a class="dropdown-item" href="api_pages/5_pokemon.php">5. Pokémon</a></li>
                        <li><a class="dropdown-item" href="api_pages/6_noticias.php">6. Noticias WP</a></li>
                        <li><a class="dropdown-item" href="api_pages/7_monedas.php">7. Conversor de Monedas</a></li>
                        <li><a class="dropdown-item" href="api_pages/8_imagenes.php">8. Generador de Imágenes</a></li>
                        <li><a class="dropdown-item" href="api_pages/9_pais.php">9. Datos de País</a></li>
                        <li><a class="dropdown-item" href="api_pages/10_chistes.php">10. Chistes</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="acerca_de.php">Acerca de</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4 flex-grow-1">