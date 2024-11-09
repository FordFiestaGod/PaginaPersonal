<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Proyectos - Adrián Elcano</title>

    <style>
        /* Estilos personalizados */
        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .hero {
            background-image: url('https://source.unsplash.com/1600x900/?tech,projects');
            background-size: cover;
            background-position: center;
            color: #ffcc00;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #ffcc00;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .card {
            cursor: pointer;
        }

        .content-section {
            padding: 60px 0;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navegación -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi Página Personal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="proyectos.php">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.html">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sección Hero -->
<section class="hero">
    <div class="container">
        <h1>Proyectos</h1>
        <p>Aquí encontrarás algunos de los proyectos en los que he trabajado.</p>
    </div>
</section>

<!-- Conexión a la Base de Datos y Consulta -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PaginaPersonal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM proyectos";
$result = $conn->query($sql);
?>

<!-- Contenido Principal -->
<div class="container content-section">
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card" data-toggle="modal" data-target="#modalProyecto<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="<?php echo $row['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                        <p class="card-text"><?php echo $row['descripcion']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modales de Proyectos -->
<?php 
$result->data_seek(0); // Resetea el puntero para el segundo bucle
while($row = $result->fetch_assoc()): 
    $funciones = explode(',', $row['funciones']);
?>
<div class="modal fade" id="modalProyecto<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $row['nombre']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $row['descripcion']; ?></p>
                <p>Funciones destacadas:</p>
                <ul>
                    <?php foreach($funciones as $funcion): ?>
                        <li><?php echo $funcion; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>

<?php $conn->close(); ?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <span>© 2024 Adrián Elcano Barbero | CIP Cuatrovientos</span>
    </div>
</footer>

<!-- Bootstrap JS y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
