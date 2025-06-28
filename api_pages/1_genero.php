<?php
include '../includes/header.php';
require_once '../config.php';
$nombre = '';
$resultado = null;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apiUrl = "https://api.genderize.io/?name=" . urlencode($nombre);
    
    // Usar @ para suprimir warnings si la API falla, lo manejaremos nosotros
    $response = @file_get_contents($apiUrl);
    
    if ($response === FALSE) {
        $error = "No se pudo conectar con la API o el nombre no es válido.";
    } else {
        $resultado = json_decode($response, true);
        if (empty($resultado) || $resultado['gender'] === null) {
            $error = "No se pudo determinar el género para el nombre '{$nombre}'.";
            $resultado = null;
        }
    }
}
?>

<div class="container text-center" style="max-width: 600px;">
    <h2 class="mb-4">1. Predicción de Género 👦👧</h2>
    <p>Ingresa un nombre para predecir si es masculino o femenino.</p>
    
    <form method="POST" action="">
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Ej: Irma" value="<?php echo $nombre; ?>" required>
            <button class="btn btn-primary" type="submit">Predecir</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <?php
            $genero = $resultado['gender'];
            $probabilidad = $resultado['probability'] * 100;
            $colorClass = ($genero == 'female') ? 'alert-pink' : 'alert-info';
            $icono = ($genero == 'female') ? '💖' : '💙';
        ?>
        <style>.alert-pink { background-color: #ffc0cb; border-color: #ffb6c1; color: #333; }</style>
        <div class="alert <?php echo $colorClass; ?> mt-4">
            <h3>Resultado <?php echo $icono; ?></h3>
            <p class="lead">El nombre <strong><?php echo ucfirst($nombre); ?></strong> es probablemente <strong><?php echo ucfirst($genero); ?></strong>.</p>
            <p>Probabilidad: <strong><?php echo $probabilidad; ?>%</strong></p>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>