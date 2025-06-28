<?php
include '../includes/header.php';
require_once '../config.php';
$pais = '';
$universidades = null;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['pais'])) {
    $pais = htmlspecialchars($_POST['pais']);
    $apiUrl = "http://universities.hipolabs.com/search?country=" . urlencode($pais);
    $response = @file_get_contents($apiUrl);

    if ($response === FALSE) {
        $error = "No se pudo conectar con la API.";
    } else {
        $universidades = json_decode($response, true);
        if (empty($universidades)) {
            $error = "No se encontraron universidades para el país '{$pais}'. Asegúrate de escribir el nombre en inglés.";
            $universidades = null;
        }
    }
}
?>

<div class="container">
    <h2 class="mb-4 text-center">3. Universidades por País 🎓</h2>
    <p class="text-center">Ingresa el nombre de un país (en inglés) para ver su lista de universidades.</p>
    
    <form method="POST" action="" class="mb-4" style="max-width: 600px; margin: auto;">
        <div class="input-group">
            <input type="text" name="pais" class="form-control" placeholder="Ej: Dominican Republic" value="<?php echo $pais; ?>" required>
            <button class="btn btn-info" type="submit">Buscar</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($universidades): ?>
        <h3 class="mt-4">Universidades en <?php echo $pais; ?></h3>
        <ul class="list-group">
            <?php foreach ($universidades as $uni): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?php echo htmlspecialchars($uni['name']); ?></strong>
                        <br>
                        <small class="text-muted"><?php echo htmlspecialchars($uni['domains'][0]); ?></small>
                    </div>
                    <a href="<?php echo htmlspecialchars($uni['web_pages'][0]); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                        Visitar Web <i class="fas fa-external-link-alt"></i>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>