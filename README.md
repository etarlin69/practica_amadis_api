Portal de Integración de APIs en PHP
Este es un portal web dinámico desarrollado en PHP que demuestra la integración y el consumo de 10 APIs externas diferentes. Cada API se presenta en una página dedicada con un diseño temático y funcional, construido con PHP y Bootstrap 5.

🚀 Características
El portal incluye la implementación de las siguientes 10 APIs:

👦👧 Predicción de Género: Estima el género de un nombre usando Genderize.io.

🎂 Predicción de Edad: Estima la edad promedio de un nombre usando Agify.io.

🎓 Universidades por País: Lista universidades de un país específico usando hipolabs.

🌦️ Clima Actual: Muestra el clima en tiempo real de cualquier ciudad usando OpenWeatherMap.

⚡ Buscador de Pokémon: Obtiene datos, imagen y sonido de un Pokémon usando PokeAPI.

📰 Noticias de WordPress: Extrae las últimas 3 noticias de sitios WordPress con la API REST.

💰 Conversor de Monedas: Convierte de USD a otras monedas usando ExchangeRate-API.

🖼️ Generador de Imágenes: Busca y muestra una imagen basada en una palabra clave usando Unsplash.

🌍 Datos de un País: Muestra información detallada de un país, como su bandera y capital, usando RestCountries.

🤣 Generador de Chistes: Muestra un chiste de programación aleatorio usando Official Joke API.

🛠️ Tecnologías Utilizadas
Backend: PHP

Frontend: HTML5, CSS3

Framework CSS: Bootstrap 5.3

Iconos: Font Awesome 6.5

Servidor Local: XAMPP / WAMP (o cualquier servidor compatible con Apache y PHP)

⚙️ Requisitos Previos
Para ejecutar este proyecto en tu máquina local, necesitarás:

Un entorno de desarrollo local como XAMPP, WAMP, MAMP, o similar, que soporte PHP 8 o superior.

📦 Instalación y Configuración
Sigue estos pasos para poner en marcha el proyecto:

Descarga el archivo ZIP y descomprímelo.

Mover a la Carpeta del Servidor
Mueve la carpeta del proyecto (portal_apis) a tu directorio de servidor web (generalmente htdocs en XAMPP o www en WAMP).

Iniciar el Servidor Local
Inicia los módulos de Apache desde el panel de control de tu entorno de servidor local.

Configurar la URL Base
Abre el archivo config.php que se encuentra en la raíz del proyecto. Asegúrate de que la constante BASE_URL coincida con la ruta de tu proyecto. Por defecto, es:

PHP

define('BASE_URL', 'http://localhost/portal_apis/');
Si renombraste la carpeta, actualiza esta línea.

Añadir las Claves de API (¡Paso Crucial!)
Algunas APIs requieren una clave (key) para funcionar. Necesitarás obtenerlas de sus respectivos sitios web y añadirlas en los archivos correspondientes:

Clima (OpenWeatherMap):

Obtén tu clave en OpenWeatherMap.

Abre el archivo api_pages/4_clima.php.

Reemplaza el texto {TU_API_KEY} con tu clave real.

Imágenes (Unsplash):

Obtén tu "Access Key" en Unsplash Developers.

Abre el archivo api_pages/8_imagenes.php.

Reemplaza el texto {TU_ACCESS_KEY} con tu clave real.

¡Listo para Usar!
Abre tu navegador web y navega a la BASE_URL que configuraste (por ejemplo: http://localhost/portal_apis/).

📖 Uso
Una vez que el portal esté funcionando:

La Página de Inicio te dará la bienvenida con tu foto e información.

Usa el menú de navegación superior para ir a la sección "Acerca de" o al menú desplegable "APIs".

Selecciona cualquiera de las 10 funcionalidades del menú desplegable para probarla.

En las páginas que lo requieran, completa los formularios y presiona el botón de acción para ver los resultados obtenidos de la API en tiempo real.

📁 Estructura del Proyecto
/portal_apis
├── index.php             // Página principal
├── acerca_de.php         // Página "Acerca de"
├── config.php            // Archivo de configuración con la BASE_URL
├── README.md             // Este archivo
├── css/
│   └── style.css         // Estilos personalizados
├── images/
│   ├── foto_perfil.jpg   // Tu foto
│   └── ...               // Otras imágenes
├── includes/
│   ├── header.php        // Cabecera y menú de navegación
│   └── footer.php        // Pie de página y scripts JS
└── api_pages/
    ├── 1_genero.php
    ├── 2_edad.php
    └── ... (las 10 páginas de las APIs)
👤 Autor
Estarlin De La Cruz Acevedo
