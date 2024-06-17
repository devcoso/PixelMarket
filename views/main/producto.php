<div class="min-h-screen flex justify-center items-center flex-col">
    <h1 class="font-display text-4xl lg:text-6xl text-center text-zinc-800 pt-10"><?php echo $producto['title'] ?></h1>
    <h3 class="font-display text-2xl lg:text-3xl text-center text-zinc-500"><?php echo $producto['category'] ?></h3>
    <div class="flex flex-col lg:flex-row w-2/3 m-auto items-center">
        <img src="<?php echo $producto['images'][0] ?>" alt="Imagen <?php echo $producto['title'] ?>" class="w-1/2">

        <div class="flex items-center flex-col text-center lg:w-1/2 text-lg text-zinc-800 space-y-8 mb-3">
            <div class="flex justify-between w-full">
                <p>Marca: <span class="font-bold"><?php echo $producto['brand'] ?></span></p>
                <div class="flex items-center gap-2">
                    <p><?php echo $producto['rating'] ?></p>
                    <img src="/img/star.png" class="w-8" alt="">
                </div>
            </div>
            <p class="text-justify"><?php echo $producto['description'] ?></p>
            <div class="w-full lg:w-1/2">
                <p class=" font-bold">Dimensiones</p>
                <div class="flex justify-between w-full">
                    <p>Alto: <?php echo $producto['dimensions']['height'] ?></p>
                    <p>Ancho: <?php echo $producto['dimensions']['width'] ?></p>
                    <p>Largo: <?php echo $producto['dimensions']['depth'] ?></p>
                </div>
            </div>
            <p class="font-bold text-4xl font-display">$<?php echo number_format($producto['price'], 2, '.', ',');?></p>
            <div class="flex justify-between w-full">
                <p>Stock: <span class="font-bold"><?php echo $producto['stock'] ?></span></p>
                <p><?php echo $producto['availabilityStatus'] ?></p>
            </div>
            <?php if(is_auth()){ ?>
                <form action="/carrito?id=<?php echo $producto['id'] ?>" method="POST">
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
        <?php foreach($producto['reviews'] as $review){ ?>
            <div class="bg-zinc-100 rounded-md shadow-lg w-full p-3">
                <div class="flex items-center justify-end gap-2">
                    <p><?php echo $review['rating'] ?></p>
                    <img src="/img/star.png" class="w-8" alt="">
                </div>
                <p class="text-xl font-bold text-zinc-800"><?php echo $review['reviewerName'] ?></p>
                <p class="font-semibold text-zinc-600"><?php echo $review['reviewerEmail'] ?></p>
                <p class="text-center text-zinc-900 my-5"><?php echo $review['comment']?></p>
            </div>
        <?php } ?>
    </div>
</div>