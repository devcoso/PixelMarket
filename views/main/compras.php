<div class="py-10 text-zinc-600 space-y-5 min-h-screen flex items-center flex-col">
    <h1 class="text-4xl font-bold text-zinc-800 font-display">Tus Compras</h1>
    <?php if($mensaje) {?>
        <p class="text-center p-2 uppercase text-white text-xl font-bold border-l-4 font-display <?php echo $tipo == "success" ? 'bg-lime-600  border-lime-800' : 'bg-red-800  border-red-900' ?>"><?php echo $mensaje ?></p>
    <?php } ?>
    <?php if($compras) {?>
        <div class="space-y-6 w-full lg:w-1/2 mx-6">
            <?php foreach($compras as $compra) {?>
                <div class="bg-zinc-100 shadow-lg w-full p-4 flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 flex  flex-col items-center justify-between">
                        <p class="font-display">COMPRA #<?php echo $compra->id ?></p>
                        <img class="w-1/2 md:w-1/3" src="<?php echo $compra->imagen?>" alt="">
                        <div class="font-display flex justify-between w-full">
                            <p>Fecha: <span class="font-sans"><?php echo $compra->fecha->format('Y-m-d');?></span></p>
                            <p>Hora: <span class="font-sans"><?php echo $compra->fecha->format('H:i:s');?></span></p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 flex items-end justify-between flex-col">
                        <div>
                            <p class="font-display">
                                Total: <span class="font-bold font-sans"><?php echo number_format($compra->pagado, 2)?></span>    
                            </p>
                            <p class="font-display">
                                Artículos: <span class="font-bold font-sans"><?php echo $compra->cantidad?></span>        
                            </p>
                        </div>
                        <a class="bg-zinc-800 mt-4 text-white hover:bg-zinc-600 font-display block text-center rounded-md w-full md:w-1/2" href="/compra?id=<?php echo $compra->id ?>">Más información</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="text-center p-10 uppercase text-zinc-800 space-y-6">
            <p>¡No has comprado aún!</p>
            <p>Añade artículos a tu carrito y compralos <a href="/carrito" class=" font-bold text-zin-900 underline">Aquí</a></p>
            <img src="/img/ShoppingCart.png" alt="carrito" class="w-20 m-auto">
        </div>
    <?php } ?>
</div>