<?php
include '../includes/header.php';
require_once '../config.php';
$nombre = '';
$resultado = null;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apiUrl = "https://api.agify.io/?name=" . urlencode($nombre);
    $response = @file_get_contents($apiUrl);
    
    if ($response === FALSE) {
        $error = "No se pudo conectar con la API.";
    } else {
        $resultado = json_decode($response, true);
        if (empty($resultado) || $resultado['age'] === null) {
            $error = "No se pudo determinar la edad para el nombre '{$nombre}'.";
            $resultado = null;
        }
    }
}
?>

<div class="container text-center" style="max-width: 600px;">
    <h2 class="mb-4">2. Predicción de Edad 🎂</h2>
    <p>Ingresa un nombre y te diré la edad promedio asociada a él.</p>
    
    <form method="POST" action="">
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Ej: Meelad" value="<?php echo $nombre; ?>" required>
            <button class="btn btn-success" type="submit">Calcular Edad</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <?php
            $edad = $resultado['age'];
            if ($edad <= 30) {
                $categoria = "Joven 👶";
                $imagen = "/images/joven.jpeg";
            } elseif ($edad <= 60) {
                $categoria = "Adulto 🧑";
                $imagen = "/images/adulto.jpeg";
            } else {
                $categoria = "Anciano 👴";
                $imagen = "/images/anciano.jpeg";
            }
        ?>
        <div class="card mt-4">
            <img src="<?php echo $imagen; ?>" class="card-img-top mx-auto mt-3" style="width: 150px;" alt="<?php echo $categoria; ?>">
            <div class="card-body">
                <h5 class="card-title">La edad promedio para <strong><?php echo ucfirst($nombre); ?></strong> es:</h5>
                <p class="display-4"><?php echo $edad; ?> años</p>
                <p class="lead">Categoría: <?php echo $categoria; ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>