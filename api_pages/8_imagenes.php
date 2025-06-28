<?php
include '../includes/header.php';
require_once '../config.php';
$imageData = null;
$error = '';
$keyword = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['keyword'])) {
    $keyword = htmlspecialchars($_POST['keyword']);
    $accessKey = "R6OL6zvH3yFfONGCxR8RETv5FOlu9BM2h43KX9cIMPk"; 
    $apiUrl = "https://api.unsplash.com/search/photos?query=" . urlencode($keyword) . "&per_page=1&client_id=" . $accessKey;
    
    $response = @file_get_contents($apiUrl);
    
    if ($response === FALSE) {
        $error = "Error al conectar con la API de Unsplash. Revisa tu Access Key.";
    } else {
        $data = json_decode($response, true);
        if (!empty($data['results'])) {
            $imageData = $data['results'][0];
        } else {
            $error = "No se encontraron imágenes para la palabra clave: '" . $keyword . "'.";
        }
    }
}
?>

<div class="container text-center" style="max-width: 800px;">
    <h2 class="mb-4">8. Generador de Imágenes 🖼️</h2>
    <p>Escribe una palabra clave (en inglés) y la IA de Unsplash buscará una imagen.</p>
    
    <form method="POST" action="">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Ej: Dominican Republic beach" value="<?php echo $keyword; ?>" required>
            <button class="btn btn-info" type="submit">Generar Imagen</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($imageData): ?>
        <div class="card mt-4 shadow-sm">
            <img src="<?php echo $imageData['urls']['regular']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($imageData['alt_description']); ?>">
            <div class="card-footer text-muted">
                Foto por <a href="<?php echo $imageData['user']['links']['html']; ?>" target="_blank"><?php echo $imageData['user']['name']; ?></a> en <a href="https://unsplash.com" target="_blank">Unsplash</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>