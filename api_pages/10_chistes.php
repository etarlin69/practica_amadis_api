<?php
include '../includes/header.php';
require_once '../config.php';
$chiste = null;
$error = '';

$apiUrl = "https://official-joke-api.appspot.com/random_joke";
$response = @file_get_contents($apiUrl);

if ($response === FALSE) {
    $error = "¡Vaya! Parece que los chistes se tomaron un descanso. Intenta de nuevo más tarde.";
} else {
    $chiste = json_decode($response, true);
}
?>
<style>
    /* Estilo simple para hacer el chiste más grande */
    .joke-card {
        background-color: #f0f8ff;
        border: 2px dashed #007bff;
    }
</style>

<div class="container text-center" style="max-width: 700px;">
    <h2 class="mb-4">10. Generador de Chistes Aleatorios 🤣</h2>
    <p>¿Listo para reír? Refresca la página para obtener un nuevo chiste.</p>
    
    <?php if ($error): ?>
        <div class="alert alert-warning mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($chiste): ?>
        <div class="card joke-card mt-4">
            <div class="card-body p-5">
                <p class="card-text fs-4 mb-4">
                    <?php echo htmlspecialchars($chiste['setup']); ?>
                </p>
                <button id="showPunchlineBtn" class="btn btn-lg btn-primary" onclick="revealPunchline()">Ver remate</button>
                <p id="punchline" class="card-text fs-3 fw-bold mt-4" style="display:none; color: #dc3545;">
                    <?php echo htmlspecialchars($chiste['punchline']); ?>
                </p>
            </div>
        </div>
        
        <script>
            function revealPunchline() {
                document.getElementById('punchline').style.display = 'block';
                document.getElementById('showPunchlineBtn').style.display = 'none';
            }
        </script>
    <?php endif; ?>

    <a href="10_chistes.php" class="btn btn-secondary mt-4"><i class="fas fa-sync-alt"></i> Cargar otro chiste</a>
</div>

<?php include '../includes/footer.php'; ?>