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
    <nav class="bg-zinc-700 overflow-auto lg:h-full lg:w-1/4 w-full lg:block py-4  sticky top-0">
        <div class="flex justify-around items-center">
            <a href="/" class="flex justify-center items-center md:gap-2 py-3">
                <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="max-w-12">
                <h1 class="font-display text-3xl lg:text-4xl xl:text-5xl text-zinc-200 text-center">Pixel Market</h1>
            </a>
            <div id="hamburguesa" class="lg:hidden w-1/5 max-w-10">
                <img src="/img/more.png" alt="Menu de más" class="invert cursor-pointer">
            </div>
        </div>
        <a href="/admin" class="lg:mt-20 font-display text-zinc-200 nav-movil lg:block hidden text-lg uppercase lg:text-2xl text-center py-2 border-b-2 border-zinc-400 hover:bg-zinc-800 <?php echo $_SERVER['PATH_INFO'] == "/admin" ? 'bg-zinc-800' : ''; ?>">Dashboard</a>
        <a href="/admin/compras?page=1" class="font-display text-zinc-200 nav-movil lg:block hidden text-lg uppercase lg:text-2xl text-center py-2 border-b-2 border-zinc-400 hover:bg-zinc-800 <?php echo pagina_actual('/admin/compras') ? 'bg-zinc-800' : ''; ?>">Compras</a>
        <a href="/admin/usuarios?page=1" class="font-display text-zinc-200 nav-movil lg:block hidden text-lg uppercase lg:text-2xl text-center py-2 border-b-2 border-zinc-400 hover:bg-zinc-800 <?php echo pagina_actual('/admin/usuarios') ? 'bg-zinc-800' : ''; ?>">Usuarios</a>
        <a href="/admin/productos?page=1" class="font-display text-zinc-200 nav-movil lg:block hidden text-lg uppercase lg:text-2xl text-center py-2 border-b-2 border-zinc-400 hover:bg-zinc-800 <?php echo pagina_actual('/admin/productos') ? 'bg-zinc-800' : ''; ?>">Productos</a>
        <a href="/admin/categorias?page=1" class="font-display text-zinc-200 nav-movil lg:block hidden text-lg uppercase lg:text-2xl text-center py-2 hover:bg-zinc-800 <?php echo pagina_actual('/admin/categorias') ? 'bg-zinc-800' : ''; ?>">Categorías</a>
        <form action="/logout" method="POST" class="w-full lg:block hidden nav-movil"><button type="submit" class="block bg-red-800 text-zinc-200 lg:mt-20 mb-2 w-3/4 m-auto font-bold text-center rounded-md p-4 shadow-lg">Cerrar Sesión</button></form>
    </nav>
    <main class="lg:h-full lg:overflow-y-auto lg:w-3/4">
        <h2 class="font-display text-4xl xl:text-5xl text-zinc-700 text-center py-10"><?php echo $titulo; ?></h2>
        <?php 
            echo $contenido;
        ?>
    </main>
    <script src="/js/admin/navbar.js"></script>
</body>
</html>