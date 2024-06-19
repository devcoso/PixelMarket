<div class="py-10 text-zinc-600 space-y-5 min-h-screen flex items-center flex-col">
    <h1 class="text-4xl font-bold text-zinc-800 font-display">Carrito</h1>
    <?php if($mensaje) {?>
        <p class="text-center p-2 uppercase text-white text-xl font-bold border-l-4 font-display <?php echo $tipo == "success" ? 'bg-lime-600  border-lime-800' : 'bg-red-800  border-red-900' ?>"><?php echo $mensaje ?></p>
    <?php } ?>
    <?php if($carrito) { $total = 0;?>
        <div class="space-y-3 w-full lg:w-1/2 mx-6">
            <?php foreach($carrito as $item) {?>
                <?php $total += $item->producto->precio * $item->cantidad ?>
                <div class="flex bg-zinc-100 shadow-lg flex-col md:flex-row items-center justify-between w-full p-4">
                    <div class="flex items-center flex-col md:flex-row gap-3 md:w-1/2">
                        <a href="/producto?id=<?php echo $item->producto->id?>" class="block w-full md:w-1/2 max-w-32 hover:opacity-70">
                            <img src="<?php echo $item->producto->thumbnail ?>" alt="Imagen <?php echo $item->producto->titulo ?>" class="w-full">
                        </a>
                        <div class="w-1/2 text-center md:text-left font-display">
                            <h4 class="text-lg font-bold"><?php echo $item->producto->titulo ?></h4>
                            <p class="text-sm"><?php echo $item->producto->categoria ?></p>
                            <p class="text-sm font-sans" id="precio-<?php echo $item->id?>"><?php echo number_format($item->producto->precio, 2, '.', ',') ?></p>
                            <p class="text-sm">Total:$<span class="total font-sans" id="total-<?php echo $item->id?>" class="font-bold"><?php echo  number_format($item->producto->precio * $item->cantidad, 2, '.', ',') ?></span></p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:flex-row items-center justify-end gap-2">
                        <div class="font-bold text-xl">
                            <button data-id="<?php echo $item->id?>" class="px-3 text-white bg-red-800 menos">-</button>
                            <span id="cantidad-<?php echo $item->id?>"><?php echo $item->cantidad ?></span>
                            <button data-id="<?php echo $item->id?>" class="px-2 text-white bg-lime-600 mas">+</button>
                        </div>
                        <form action="/carrito/eliminar" class=" w-1/2 md:w-auto" method="POST">
                            <input type="hidden" name="id" value="<?php echo $item->id ?>">
                            <button type="submit" class="bg-red-800 text-white p-2 rounded-lg w-full">Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <p class="text-center text-sm">Los precios incluyen IVA</p>
            <p class="text-3xl text-right font-display text-zinc-600">Total:$<span id="total" class="font-bold  font-sans text-zinc-800"><?php echo  number_format($total, 2, '.', ',') ?></span></p>
            <p class="text-3xl text-right font-display text-blue-600">Saldo:$<span id="saldo" class="font-bold  font-sans text-blue-800"><?php echo  number_format($saldo, 2, '.', ',') ?></span></p>
            <p class="text-3xl text-right font-display text-red-600">Restante:$<span id="restante" class="font-bold  font-sans text-red-800"><?php echo  $saldo - $total < 0 ? 'Saldo Insuficiente' : number_format($saldo - $total, 2, '.', ',') ?></span></p>
            <form id="form-comprar" action="/carrito/comprar" method="POST">
                <button <?php echo  $saldo - $total < 0 ? 'disabled' : ''  ?> id="boton-comprar" type="submit" class=" disabled:cursor-not-allowed disabled:opacity-70 w-full bg-blue-800 text-white font-bold font-display p-3 rounded-md shadow-lg flex justify-center items-center gap-2">
                    Comprar
                    <img src="/img/IconoPixelMarket.png" alt="Icono">
                </button>
            </form>
        </div>
    <?php } else { ?>
        <div class="text-center p-10 uppercase text-zinc-800 space-y-6">
            <p>No hay productos en el carrito</p>
            <p>Añade artículos a tu carrito <a href="/categorias" class=" font-bold text-zin-900 underline">Aquí</a></p>
            <img src="/img/ShoppingCart.png" alt="carrito" class="w-20 m-auto">
        </div>
    <?php } ?>
</div>
<script src="/js/main/carrito.js"></script>