<div class="flex flex-col lg:flex-row lg:h-screen">
    <sidebar class="font-display w-full lg:w-1/4 bg-zinc-100 shadow-md text-center h-96 lg:h-full overflow-y-auto">
        <h2 class="font-display text-4xl font-bold py-5 text-zinc-800">Categorias</h2>
        <ul id="categorias">
        </ul>
    </sidebar>

    <main id="main" class="w-full lg:w-3/4 p-2 overflow-auto">
        <h2 id="categoriaTitulo" class="font-display text-4xl font-bold py-5 text-zinc-800 text-center mb-10">Todos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 text-zinc-800 mb-10" id="productos"></div>
        <div id="paginacion" class="flex justify-between w-full md:w-1/2 m-auto font-display">
            <button id="btnAnterior" class="bg-zinc-800 hover:bg-zinc-600 text-white font-bold py-2 px-4 rounded disabled:bg-slate-300">Anterior</button>
            <button id="btnSiguiente" class="bg-zinc-800 hover:bg-zinc-600 text-white font-bold py-2 px-4 rounded disabled:bg-slate-300">Siguiente</button>
        </div>
        <p id="infoPaginacion" class="text-center mb-10 text-zinc-600 font-display">Mostrando de <span id="infoPaginaInicio" class="font-bold">21</span> a  <span id="infoPaginaFinal" class="font-bold">42</span> productos de <span id="infoTotal" class="font-bold">194</span></p>
    </main>
</div>



<script type="module" src="/js/main/categorias.js"></script>