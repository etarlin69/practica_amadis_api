<?php
include '../includes/header.php';
require_once '../config.php';
$noticias = null;
$error = '';
$fuenteSeleccionada = '';

// Fuentes de ejemplo con API REST habilitada
$fuentes = [
    "Wired (en)" => "https://www.wired.com/wp-json/wp/v2/posts?per_page=3",
    "TechCrunch (en)" => "https://techcrunch.com/wp-json/wp/v2/posts?per_page=3",
    "Ayuntamiento de Madrid (es)" => "https://diario.madrid.es/wp-json/wp/v2/posts?per_page=3",
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['fuente'])) {
    $apiUrl = $_POST['fuente'];
    $fuenteSeleccionada = array_search($apiUrl, $fuentes); // Obtener el nombre de la fuente

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\r\n"
        ]
    ];
    $context = stream_context_create($opts);

    $response = @file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        $error = "No se pudo conectar con el sitio de noticias. Puede que su API no esté disponible temporalmente.";
    } else {
        $noticias = json_decode($response, true);
        if (empty($noticias)) {
             $error = "No se encontraron noticias o la respuesta no fue válida.";
        }
    }
}
?>

<div class="container">
    <h2 class="mb-4 text-center">6. Últimas Noticias desde WordPress 📰</h2>
    <p class="text-center">Selecciona una fuente para ver sus últimas 3 noticias.</p>
    
    <form method="POST" action="" class="mb-4" style="max-width: 600px; margin: auto;">
        <div class="input-group">
            <select name="fuente" class="form-select">
                <option value="">-- Elige una fuente --</option>
                <?php foreach ($fuentes as $nombre => $url): ?>
                    <option value="<?php echo $url; ?>" <?php if($fuenteSeleccionada == $nombre) echo 'selected'; ?>>
                        <?php echo $nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-dark" type="submit">Cargar Noticias</button>
        </div>
    </form>
    
    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($noticias): ?>
        <h3 class="mt-4">Últimas noticias de: <?php echo htmlspecialchars($fuenteSeleccionada); ?></h3>
        <div class="row">
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($noticia['title']['rendered']); ?></h5>
                            <div class="card-text">
                                <?php echo strip_tags($noticia['excerpt']['rendered']); // Limpiamos HTML del resumen ?>
                            </div>
                            <a href="<?php echo $noticia['link']; ?>" target="_blank" class="btn btn-secondary mt-auto">Leer más...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>