<div class="py-10 text-zinc-600 space-y-5 min-h-screen flex items-center flex-col" id="pdf">
    <div class="flex w-full p-3">
        <a href="/compras" class="rounded-md shadow-md font-display bg-zinc-800 text-white bloc px-5 py-2">&laquo;Volver</a>
    </div>
    <h1 class="text-4xl font-display text-zinc-800">Compra #<?php echo $compra->id ?></h1>
    <p class="font-display text-lg text-center py-1">Fecha: <span class="font-sans"><?php echo $compra->fecha->format('Y-m-d');?></span></p>
    <p class="font-display text-lg text-center py-1">Hora: <span class="font-sans"><?php echo $compra->fecha->format('H:i:s');?></span></p>
    <div class="space-y-6 w-full lg:w-1/2 mx-6">
        <?php foreach($productos as $item) {?>
            <div class="flex bg-zinc-100 shadow-lg flex-col md:flex-row items-center justify-between w-full p-4">
                <div class="w-full md:w-1/2 text-center flex font-display gap-2">
                    <a href="/producto?id=<?php echo $item->producto->id?>" class="block w-full md:w-1/2 max-w-32 hover:opacity-70">
                        <img src="<?php echo $item->producto->thumbnail ?>" alt="Imagen <?php echo $item->producto->titulo ?>" class="w-full">
                    </a>
                    <div class="text-left">   
                        <h4 class="text-lg font-bold"><?php echo $item->producto->titulo ?></h4>
                        <p class="text-sm"><?php echo $item->producto->categoria ?></p>
                    </div>
                </div>
                <div class="w-full md:w-1/2  text-center md:text-left font-display flex items-end flex-col">
                    <p class="text-sm">Precio:$<span class="total font-sans" class="font-bold"><?php echo  number_format($item->producto->precio, 2, '.', ',') ?></span></p>
                    <p class="text-sm border-b-2">Cantidad:<span class="total font-sans" class="font-bold"><?php echo $item->cantidad ?></span></p>
                    <p class="text-sm">Total:$<span class="total font-sans" id="total-" class="font-bold"><?php echo  number_format($item->pagado, 2, '.', ',') ?></span></p>
                </div>
            </div>
        <?php } ?>
        <div class="text-xl font-display text-center">
            <p>Cantidad de artículos:<span class="total font-sans" class="font-bold font-sans"><?php echo  $compra->cantidad ?></span></p>
            <p>Total pagado:$<span class="total font-sans" class="font-bold font-sans"><?php echo  number_format($compra->pagado, 2, '.', ',') ?></span></p>
            <a target="_blank" href="/compra/Comprobante?id=<?php echo $compra->id?>" class="w-full md:w-1/2 block m-auto bg-zinc-800 text-white py-2 mt-3 rounded-md shadow-md">Comprobante de compra</a>
        </div>
    </div>
</div>