<?php
include '../includes/header.php';
require_once '../config.php';
$pokemonData = null;
$error = '';
$pokemonNombre = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['pokemon'])) {
    // Convertimos a minúsculas y quitamos espacios
    $pokemonNombre = strtolower(trim($_POST['pokemon']));
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/" . urlencode($pokemonNombre);

    $response = @file_get_contents($apiUrl);

    if ($response === FALSE) {
        $error = "Pokémon no encontrado. Intenta con otro nombre o revisa la ortografía.";
    } else {
        $pokemonData = json_decode($response, true);
    }
}
?>
<style>
    /* Estilo temático Pokémon */
    .pokemon-card {
        border: 5px solid #FFCB05; /* Amarillo Pokémon */
        background-color: #F0F8FF;
    }
    .pokemon-card .card-header {
        background-color: #3B4CCA; /* Azul Pokémon */
        color: white;
        font-family: 'Press Start 2P', cursive; /* Opcional, si quieres una fuente pixelada */
    }
    .pokemon-abilities li {
        background-color: #eee;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        display: inline-block;
        margin-bottom: 5px;
    }
</style>

<div class="container text-center" style="max-width: 600px;">
    <h2 class="mb-4">5. Buscador de Pokémon ⚡</h2>
    <p>Ingresa el nombre de un Pokémon para ver sus datos.</p>
    
    <form method="POST" action="">
        <div class="input-group mb-3">
            <input type="text" name="pokemon" class="form-control" placeholder="Ej: pikachu o 25" value="<?php echo htmlspecialchars($pokemonNombre); ?>" required>
            <button class="btn" style="background-color: #e63946; color: white;" type="submit">¡Atrapalo ya!</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($pokemonData): ?>
        <div class="card pokemon-card mt-4">
            <div class="card-header text-center">
                <h3 class="text-capitalize m-0"><?php echo htmlspecialchars($pokemonData['name']); ?></h3>
            </div>
            <div class="card-body text-center">
                <img src="<?php echo $pokemonData['sprites']['front_default']; ?>" class="img-fluid" style="width: 200px;" alt="Sprite de <?php echo $pokemonData['name']; ?>">
                
                <h5 class="mt-3">Sonido del Pokémon</h5>
                <audio controls class="mb-3" style="width: 100%;">
                    <source src="<?php echo $pokemonData['cries']['latest']; ?>" type="audio/ogg">
                    Tu navegador no soporta el audio.
                </audio>
                
                <p><strong>Experiencia Base:</strong> <?php echo $pokemonData['base_experience']; ?></p>
                
                <h5>Habilidades:</h5>
                <ul class="list-unstyled pokemon-abilities">
                    <?php foreach ($pokemonData['abilities'] as $habilidad): ?>
                        <li class="text-capitalize"><?php echo htmlspecialchars($habilidad['ability']['name']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>