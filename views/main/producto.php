<div class="min-h-screen flex justify-center items-center flex-col p-3">
    <h1 class="font-display text-4xl lg:text-6xl text-center text-zinc-800 pt-10"><?php echo $producto->titulo ?></h1>
    <h3 class="font-display text-2xl lg:text-3xl text-center text-zinc-500"><?php echo $producto->categoria ?></h3>
    <div class="flex flex-col lg:flex-row lg:w-2/3 m-auto items-center">
        <img src="<?php echo $producto->imagen ?>" alt="Imagen <?php echo $producto->titulo ?>" class="lg:w-1/2">
        <!-- <img src="<?php //echo $producto['thumbnail'] ?>" alt="Imagen <?php //echo $producto['title'] ?>" class="lg:w-1/2"> -->

        <div class="flex items-center flex-col text-center lg:w-1/2 text-lg text-zinc-800 space-y-8 mb-3">
            <div class="flex justify-between w-full">
                <p>Marca: <span class="font-bold"><?php echo $producto->marca ?></span></p>
                <div class="flex items-center gap-2">
                    <p><?php echo $producto->valoracion ?></p>
                    <img src="/img/star.png" class="w-8" alt="">
                </div>
            </div>
            <p class="text-justify"><?php echo $producto->descripcion ?></p>
            <div class="w-full lg:w-1/2">
                <p class=" font-bold">Dimensiones</p>
                <div class="flex justify-between w-full">
                    <p>Alto: <?php echo $producto->dimension_alto ?></p>
                    <p>Ancho: <?php echo $producto->dimension_ancho?></p>
                    <p>Largo: <?php echo $producto->dimension_largo?></p>
                </div>
            </div>
            <p class="font-bold text-4xl font-display">$<?php echo number_format($producto->precio, 2, '.', ',');?></p>
            <?php if(is_auth()){ ?>
                <form action="/carrito?id=<?php echo $producto->id ?>" method="POST">
                    <button type="submit" class="bg-zinc-800 text-white font-bold py-4 font-display px-8 rounded flex gap-4">
                        <img src="/img/ShoppingCart.png" class="w-8" alt="Carrito Pixeleado">
                        Agregar al carrito
                    </button>
                </form>
            <?php } else {?>
                <div class="text-center">
                    <p class="text-zinc-800">Inicia sesión para agregar al carrito</p>
                    <a href="/login" class="bg-zinc-800 text-white font-bold py-4 font-display px-8 block">Inicia Sesión</a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-10 w-full gap-4 p-4">
        <?php foreach($producto->comentarios as $comentario){ ?>
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