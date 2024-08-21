<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: Index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desire Studio</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="wrapper">
        <!-- Modal de confirmación -->
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>¿Estás seguro de que deseas cerrar sesión?</h2>
                <div class="modal-buttons">
                    <button onclick="confirmLogout()">Sí</button>
                    <button onclick="closeModal()">No</button>
                </div>
            </div>
        </div>

        <header class="header">
            <h1>Desire Studio</h1>
            <img src="logo/logoDS.jpg" alt="Logo" class="logo">
        </header>

        <nav class="nav">
            <ul>
                <li><button role="tab" onclick="location.href='#service'">Servicios</button></li>
                <li><button role="tab" onclick="location.href='#hours'">Horarios</button></li>
                <li><button role="tab" onclick="location.href='https://wa.me/5491139218277'">Contacto</button></li>
                <li><button role="tab" onclick="openModal()">Cerrar sesión</button></li>
            </ul>
        </nav>

        <div class="header-border"></div>

        <main class="main-content">

    <section id="about" class="about">
        <h2>ACERCA DE</h2>
        <div class="about-content">
            <p>En Desire Studio, combinamos técnicas clásicas y modernas para ofrecerte cortes de cabello y afeitados impecables. Desde 2022, nuestra misión es brindarte un servicio personalizado en un ambiente acogedor. Ven y vive la experiencia de una barbería que entiende tus necesidades y estilo.</p>
            <a class="btn" href="seleccionar_servicio.php">RESERVA TU TURNO</a>
        </div>
    </section>

    <section class="image-gallery">
        <div class="gallery-images">
            <img src="img/corte1.jpg" alt="Corte de cabello 1" class="gallery-image">
            <img src="img/corte2.jpg" alt="Corte de cabello 2" class="gallery-image">
            <img src="img/corte3.jpg" alt="Corte de cabello 3" class="gallery-image">
            <img src="img/corte4.jpg" alt="Corte de cabello 4" class="gallery-image">
            <!-- Agrega más imágenes aquí -->
        </div>
        <div class="gallery-buttons">
            <button class="gallery-button prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="gallery-button next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </section>

    <section id="service" class="service">
        <h2>Servicios</h2>
        <ul>
            <li><span>Corte de Pelo</span> $5.000 | 30/40 minutos</li>
            <li><span>Corte de Barba</span> $3.000 | 20/30 minutos</li>
            <li><span>Corte de Pelo y Barba</span> $6.500 | 1 hora</li>
            <li><span>Global</span> $20.000 | 1 hora 30 minutos</li>
            <li><span>Global y Corte</span> $23.500 | 2 horas</li>
            <li><span>Mechas</span> $14.500 | 1 hora</li>
            <li><span>Mechas y Corte</span> $18.000 | 1 hora 30 minutos</li>
        </ul>
    </section>

    <section id="hours" class="hours">
        <h2>Horario de apertura</h2>
        <ul>
            <li><span>lunes</span> Cerrado</li>
            <li><span>martes</span> 10:00 - 13:20 | 15:00 - 20:20</li>
            <li><span>miércoles</span> 10:00 - 13:20 | 15:00 - 20:20</li>
            <li><span>jueves</span> 10:00 - 13:20 | 15:00 - 20:20</li>
            <li><span>viernes</span> 10:00 - 13:20 | 15:00 - 20:20</li>
            <li><span>sábados</span> 10:00 - 13:20 | 15:00 - 20:20</li>
            <li><span>domingo</span> Cerrado</li>
        </ul>
    </section>
</div>
</main>


        <div class="top-footer"></div>
        <footer class="footer">
            <div class="footer-content">
                <div class="social-text">
                    <span>SÍGUENOS EN NUESTRAS REDES</span>
                </div>
                <div class="social-icons">
                    <a href="https://www.instagram.com/julistylectz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer">
                        <img src="img/instagram.png" alt="Instagram">
                    </a>
                    <a href="https://www.tiktok.com/@julistylectz?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer">
                        <img src="img/tiktok.png" alt="Tiktok">
                    </a>
                    <a href="https://wa.me/5491139218277" target="_blank" rel="noopener noreferrer">
                        <img src="img/whatsapp.png" alt="Whatsapp">
                    </a>
                </div>
      
        </footer>

    </div>

    <script>
        function openModal() {
            document.getElementById("logoutModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("logoutModal").style.display = "none";
        }

        function confirmLogout() {
            window.location.href = 'logout.php';
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById("logoutModal")) {
                closeModal();
            }
        }
    </script>
<script>
let currentIndex = 0;
const images = document.querySelectorAll('.gallery-image');

function moveSlide(direction) {
    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = images.length - 1;
    } else if (currentIndex >= images.length) {
        currentIndex = 0;
    }

    const offset = -currentIndex * 100;
    document.querySelector('.gallery-images').style.transform = `translateX(${offset}%)`;
}
</script>
</body>
</html>
