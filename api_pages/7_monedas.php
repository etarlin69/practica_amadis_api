<?php
include '../includes/header.php';
require_once '../config.php';
$rates = null;
$error = '';
$cantidadUSD = 1; // Valor por defecto

// Usamos una API gratuita que no requiere Key
$apiUrl = "https://open.er-api.com/v6/latest/USD";
$response = @file_get_contents($apiUrl);

if ($response === FALSE) {
    $error = "No se pudo obtener las tasas de cambio.";
} else {
    $data = json_decode($response, true);
    if ($data['result'] == 'success') {
        $rates = $data['rates'];
    } else {
        $error = "Error al obtener las tasas de cambio de la API.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usd'])) {
    // Validamos que sea un número
    $cantidadUSD = filter_var($_POST['usd'], FILTER_VALIDATE_FLOAT);
    if ($cantidadUSD === false || $cantidadUSD < 0) {
        $error = "Por favor, ingresa una cantidad válida en USD.";
        $cantidadUSD = 1;
    }
}
?>

<div class="container text-center" style="max-width: 700px;">
    <h2 class="mb-4">7. Conversor de Monedas 💰</h2>
    <p>Ingresa una cantidad en Dólares (USD) para convertirla a otras monedas.</p>

    <form method="POST" action="">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i> USD</span>
            <input type="number" step="0.01" name="usd" class="form-control" value="<?php echo $cantidadUSD; ?>">
            <button class="btn btn-success" type="submit">Convertir</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($rates): ?>
        <?php
            $dop = $cantidadUSD * $rates['DOP'];
            $eur = $cantidadUSD * $rates['EUR'];
            $gbp = $cantidadUSD * $rates['GBP'];
        ?>
        <div class="card mt-4">
            <div class="card-header">
                Resultados de la conversión
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center fs-4">
                    <span><i class="fas fa-money-bill-wave"></i> Peso Dominicano (DOP)</span>
                    <span class="badge bg-primary rounded-pill">$<?php echo number_format($dop, 2); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center fs-4">
                    <span><i class="fas fa-euro-sign"></i> Euro (EUR)</span>
                    <span class="badge bg-info rounded-pill">€<?php echo number_format($eur, 2); ?></span>
                </li>
                 <li class="list-group-item d-flex justify-content-between align-items-center fs-4">
                    <span><i class="fas fa-pound-sign"></i> Libra Esterlina (GBP)</span>
                    <span class="badge bg-warning text-dark rounded-pill">£<?php echo number_format($gbp, 2); ?></span>
                </li>
            </ul>
             <div class="card-footer text-muted">
                Tasa de cambio (USD a DOP): 1 USD = <?php echo $rates['DOP']; ?> DOP
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>