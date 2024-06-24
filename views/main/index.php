<main>
    <div class="bg-cover bg-center bg-[url('/img/PixelWorld.jpg')] text-center">
        <div class="bg-black bg-opacity-65 min-h-96 flex flex-col justify-center items-center gap-3 py-10 text-zinc-200 font-display p-2">
            <h1 class=" text-5xl md:text-7xl lg:text-9xl text-center">!Bienvenido a Pixel Market¡</h1>
            <p class="text-lg">!Los mejores pixeles de internet¡</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 items-center p-3 gap-8 mt-10">
       <?php foreach($productos as $producto) {?> 
        <div class="bg-zinc-100 shadow-lg flex flex-col items-center font-display p-3">
            <img src="<?= $producto->imagen ?>" alt="<?= $producto->nombre ?>" class=" max-w-48 max-h-48">
            <h2 class="text-4xl"><?= $producto->titulo ?></h2>
            <p class="text-2xl font-bold">$<?= $producto->precio ?></p>
            <a class="border-2 bg-zinc-900 text-zinc-200 px-3 py-1 text-2xl hover:opacity-80 " href="/producto?id=<?= $producto->id ?>">Ver Producto</a>
        </div>
        <?php } ?>
    </div>
    <a href="/categorias" class="font-display block text-right text-xl font-bold hover:text-zinc-600 mb-10 px-4">Ver más productos...</a>
    <div class="bg-cover bg-center bg-[url('/img/Rebajas.png')] text-center">
        <div class="bg-black bg-opacity-75 min-h-64 flex flex-col justify-center items-center gap-3 py-10 text-zinc-200 font-display p-2">
            <h2 class="text-5xl md:text-7xl text-center">Los Mejores Precios</h2>
            <p class="text-lg">!Los mejores precios que puedes encontrar entre todos los pixeles de internet¡</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 items-center p-3 gap-8 my-10">
       <?php foreach($productos_precio as $producto) {?> 
        <div class="bg-zinc-100 shadow-lg flex flex-col items-center font-display p-3">
            <img src="<?= $producto->imagen ?>" alt="<?= $producto->nombre ?>" class=" max-w-48 max-h-48">
            <h2 class="text-4xl"><?= $producto->titulo ?></h2>
            <p class="text-2xl font-bold">$<?= $producto->precio ?></p>
            <a class="border-2 bg-zinc-900 text-zinc-200 px-3 py-1 text-2xl hover:opacity-80 " href="/producto?id=<?= $producto->id ?>">Ver Producto</a>
        </div>
        <?php } ?>
    </div>
    <div class="bg-cover bg-center bg-[url('/img/MasVendidos.png')] text-center">
        <div class="bg-black bg-opacity-75 min-h-96 flex flex-col justify-center items-center gap-3 py-10 text-zinc-200 font-display p-2">
            <h2 class="text-5xl md:text-6xl text-center">Destacados</h2>
            <p class="text-lg">!Los pixeles más destacados de toda la tienda¡</p>
            <a class=" border-2 px-3 py-1 text-2xl hover:opacity-70 border-zinc-200" href="/destacados">Aquí</a>
        </div>
    </div>
    <div class="flex flex-col items-center my-10 lg:my-20">
        <h2 class="font-display text-6xl text-center">Sobre Nosotros</h2>
        <div class="flex flex-col md:flex-row items-center p-3">
            <div class="text-lg text-justify w-full md:w-2/3 space-y-4 text-zinc-700 mx-5">
                <p><span class="font-display">Pixel Market</span> nació de la pasión por el arte digital y los videojuegos retro. Somos un equipo de creativos y entusiastas del diseño que cree en el poder de los píxeles para contar historias y evocar emociones. Nuestra misión es llevar la magia del pixel art a la vida cotidiana de nuestros clientes, ofreciendo productos que no solo sean funcionales, sino que también inspiren alegría y creatividad.</p>
                <p>Creemos que cada píxel cuenta, y es por eso que ponemos un esmero especial en cada diseño. Trabajamos con artistas y diseñadores talentosos que comparten nuestra visión, asegurándonos de que cada artículo en nuestra tienda refleje calidad y originalidad. Además, nos comprometemos a ofrecer un servicio al cliente excepcional, brindando una experiencia de compra fácil y agradable, desde la navegación en nuestro sitio web hasta la entrega de tus productos.</p>
                <p>Explora nuestro sitio y descubre prendas de vestir con diseños únicos, accesorios que destacan por su originalidad, gadgets tecnológicos que combinan funcionalidad con estilo retro, y artículos de decoración que transformarán cualquier espacio en una obra de arte pixelada. En Pixel Market, creemos que cada compra debe ser una experiencia divertida y memorable, y nos esforzamos por ofrecer productos que no solo cumplan con tus expectativas, sino que también te sorprendan y deleiten.</p>
                <p>Únete a la comunidad de Pixel Market y lleva la magia del pixel art a tu vida cotidiana. ¡Cada píxel cuenta!</p>
            </div>
            <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="w-1/3 max-w-96 m-auto">
        </div>      
    </div>
    <div class="bg-cover bg-center bg-[url('/img/Otros.png')] text-center">
        <div class="bg-black bg-opacity-75 min-h-96 flex flex-col justify-center items-center gap-3 py-10 text-zinc-200 font-display p-2">
            <h2 class="text-6xl text-center">Categorias</h2>
            <p class="text-lg">¿Buscas alguna categoria específica?</p>
            <a class=" border-2 px-3 py-1 text-2xl hover:opacity-70 border-zinc-200" href="/categorias">Aquí</a>
        </div>
    </div>
    <div class="flex flex-col items-center my-10 lg:my-20">
        <h2 class="font-display text-6xl text-center">Comentarios destacados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-10 w-full gap-4 p-4">
            <?php foreach($comentarios as $comentario){ ?>
                <div class="bg-zinc-100 rounded-md shadow-lg w-full p-3">
                    <div class="flex items-center justify-end gap-2">
                        <p><?php echo $comentario->valoracion ?></p>
                        <img src="/img/star.png" class="w-8" alt="Estrella pixeleada">
                    </div>
                    <p class="text-xl font-bold text-zinc-800"><?php echo $comentario->nombre ?></p>
                    <p class="font-semibold text-zinc-600"><?php echo $comentario->email ?></p>
                    <p class="text-center text-zinc-900 my-5"><?php echo $comentario->comentario?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>