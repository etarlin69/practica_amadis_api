<?php
include '../includes/header.php';
require_once '../config.php';
$paisData = null;
$error = '';
$paisNombre = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['pais'])) {
    $paisNombre = htmlspecialchars($_POST['pais']);
    $apiUrl = "https://restcountries.com/v3.1/name/" . urlencode($paisNombre);

    $response = @file_get_contents($apiUrl);
    if ($response === FALSE) {
        $error = "País no encontrado. Asegúrate de escribir el nombre en inglés.";
    } else {
        $data = json_decode($response, true);
        $paisData = $data[0]; // La API devuelve un array, tomamos el primer resultado
    }
}
?>

<div class="container" style="max-width: 700px;">
    <h2 class="mb-4 text-center">9. Datos de un País 🌍</h2>
    <p class="text-center">Ingresa el nombre de un país (en inglés) para ver su información básica.</p>

    <form method="POST" action="" class="mb-4">
        <div class="input-group">
            <input type="text" name="pais" class="form-control" placeholder="Ej: Dominican Republic" value="<?php echo $paisNombre; ?>" required>
            <button class="btn btn-primary" type="submit">Buscar País</button>
        </div>
    </form>
    
    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($paisData): ?>
        <?php
            // Extraer datos de la moneda de forma segura
            $monedaInfo = array_values($paisData['currencies'])[0];
        ?>
        <div class="card mt-4">
            <div class="card-header text-center">
                <h3><?php echo htmlspecialchars($paisData['name']['common']); ?></h3>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center">
                        <img src="<?php echo $paisData['flags']['svg']; ?>" class="img-fluid border" alt="Bandera de <?php echo $paisData['name']['common']; ?>">
                    </div>
                    <div class="col-md-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Capital:</strong> <?php echo htmlspecialchars($paisData['capital'][0]); ?></li>
                            <li class="list-group-item"><strong>Población:</strong> <?php echo number_format($paisData['population']); ?></li>
                            <li class="list-group-item"><strong>Moneda:</strong> <?php echo htmlspecialchars($monedaInfo['name']) . " (" . htmlspecialchars($monedaInfo['symbol']) . ")"; ?></li>
                             <li class="list-group-item"><strong>Continente:</strong> <?php echo htmlspecialchars($paisData['region']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>