<?php
include '../includes/header.php';
require_once '../config.php';

// --- CONFIGURACIÓN ---
$apiKey = "d8cc22b06d24dbc5b19fbc044e5ba189";
$ciudadDefault = "Santo Domingo";
// --------------------

$clima = null;
$error = '';
$ciudadBusqueda = $ciudadDefault;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ciudad'])) {
    $ciudadBusqueda = htmlspecialchars($_POST['ciudad']);
}

// Construimos la URL de la API
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudadBusqueda) . "&appid={$apiKey}&units=metric&lang=es";

$response = @file_get_contents($apiUrl);

if ($response === FALSE) {
    $error = "No se pudo obtener el clima. Verifica el nombre de la ciudad o tu API Key.";
} else {
    $clima = json_decode($response, true);
    // OpenWeather devuelve un 'cod' 200 si todo está bien.
    if ($clima['cod'] != 200) {
        $error = "Ciudad no encontrada: " . htmlspecialchars($ciudadBusqueda);
        $clima = null;
    }
}


$weather_class = 'default';
if ($clima) {
    $mainWeather = $clima['weather'][0]['main'];
    if ($mainWeather == 'Clear') $weather_class = 'sunny';
    if ($mainWeather == 'Clouds') $weather_class = 'clouds';
    if ($mainWeather == 'Rain' || $mainWeather == 'Drizzle' || $mainWeather == 'Thunderstorm') $weather_class = 'rain';
}
?>

<div class="container">
    <h2 class="mb-4 text-center">4. Clima Actual 🌦️</h2>
    <p class="text-center">Busca el clima de cualquier ciudad del mundo. Por defecto, se muestra el de Santo Domingo.</p>

    <form method="POST" action="" class="mb-4" style="max-width: 600px; margin: auto;">
        <div class="input-group">
            <input type="text" name="ciudad" class="form-control" placeholder="Ej: London">
            <button class="btn btn-primary" type="submit">Buscar Clima</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-3">🚨 <?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($clima): ?>
        <div class="card weather-card <?php echo $weather_class; ?>" style="max-width: 500px; margin: auto;">
            <div class="card-body text-center">
                <h3 class="card-title">Clima en <?php echo htmlspecialchars($clima['name']); ?>, <?php echo htmlspecialchars($clima['sys']['country']); ?></h3>
                <img src="http://openweathermap.org/img/wn/<?php echo $clima['weather'][0]['icon']; ?>@4x.png" alt="Icono del clima">
                <p class="display-4 fw-bold"><?php echo round($clima['main']['temp']); ?>°C</p>
                <p class="lead fs-4 text-capitalize"><?php echo htmlspecialchars($clima['weather'][0]['description']); ?></p>
                <div class="row mt-4">
                    <div class="col">
                        <p><i class="fas fa-wind"></i> Viento</p>
                        <p><?php echo $clima['wind']['speed']; ?> m/s</p>
                    </div>
                    <div class="col">
                        <p><i class="fas fa-tint"></i> Humedad</p>
                        <p><?php echo $clima['main']['humidity']; ?>%</p>
                    </div>
                    <div class="col">
                        <p><i class="fas fa-temperature-high"></i> Sensación</p>
                        <p><?php echo round($clima['main']['feels_like']); ?>°C</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>