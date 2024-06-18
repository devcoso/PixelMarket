<div class="py-10 text-zinc-600 space-y-5 min-h-screen flex items-center flex-col">
    <h1 class="text-4xl font-bold text-zinc-800 font-display">Tus Compras</h1>
    <?php if($mensaje) {?>
        <p class="text-center p-2 uppercase text-white text-xl font-bold border-l-4 font-display <?php echo $tipo == "success" ? 'bg-lime-600  border-lime-800' : 'bg-red-800  border-red-900' ?>"><?php echo $mensaje ?></p>
    <?php } ?>
    
</div>