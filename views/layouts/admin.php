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
</head>
<body class="lg:h-screen flex flex-col lg:flex-row">
    <aside class="bg-zinc-700 lg:h-full lg:w-1/4 p-2">
        <a href="/" class="flex justify-center items-center md:gap-2 py-3">
            <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="max-w-12">
            <h1 class="font-display text-3xl lg:text-4xl xl:text-5xl text-zinc-200 text-center">Pixel Market</h1>
        </a>
    </aside>
    <main class="flex flex-col items-center lg:h-full lg:overflow-y-auto lg:w-3/4">
        <h2 class="font-display text-2xl md:text-3xl lg:text-4xl xl:text-5xl text-zinc-700 text-center py-10"><?php echo $titulo; ?></h2>
        <?php 
            echo $contenido;
        ?>
    </main>
</body>
</html>