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
<body>
    <div class="bg-zinc-700 min-h-screen flex flex-col md:flex-row justify-center items-center gap-2 md:gap-10">
        <a href="/" class="block w-1/2 md:w-1/5">
            <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market">
        </a>
        <div class="w-full md:w-2/3 lg:w-1/2 xl:w-2/5 bg-zinc-200 p-10 shadow-lg rounded-md">
            <h1 class="font-display text-center text-4xl md:text-5xl lg:text-6xl text-zinc-800 hover:text-zinc-700"><a href="/">PIXEL MARKET</a></h1>
            <div class="mt-10">
                <?php 
                    echo $contenido;
                ?>
            </div>
        </div>
    </div>
</body>
</html>