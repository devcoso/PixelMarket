<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Market - <?php echo $titulo; ?></title>
    <link rel="icon" href="/img/IconoPixelMarket.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Tiny5&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js"></script>
</head>
<body>
    <?php 
        include_once __DIR__ .'/../templates/header.php';
        echo $contenido;
        include_once __DIR__ .'/../templates/footer.php'; 
    ?>
</body>
</html>