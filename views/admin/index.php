<div class="w-full md:w-3/4 lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-3 m-auto">
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Productos</p>
        <p class="text-6xl font-bold text-zinc-700" id="productos-p">0</p>
    </div>
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Total de Stock</p>
        <p class="text-6xl font-bold text-zinc-700" id="stock-p">0</p>
    </div>  
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Usuarios</p>
        <p class="text-6xl font-bold text-zinc-700" id="usuarios-p">0</p>
    </div>
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Ingresos</p>
        <p class="text-6xl font-bold text-zinc-700" id="ingresos-p">0</p>
    </div>
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Compras</p>
        <p class="text-6xl font-bold text-zinc-700" id="compras-p">0</p>
    </div>
    <div class="py-8 space-y-8 shadow-lg bg-zinc-100 text-center text-3xl text-zinc-800">
        <p class="font-display">Artículos vendidos</p>
        <p class="text-6xl font-bold text-zinc-700" id="articulos-p">0</p>
    </div>
</div>
<div class="w-full md:w-3/4 lg:w-2/3 my-10 m-auto">
    <h3 class="text-3xl font-display text-center text-zinc-700">Productos más vendidos</h3>
    <canvas id="top_10_productos"></canvas>
</div>
<div class="w-full md:w-3/4 lg:w-2/3 my-10 m-auto">
    <h3 class="text-3xl font-display text-center text-zinc-700">Categorias más vendidas</h3>
    <canvas id="top_5_categorias"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/admin/dashboard.js"></script>