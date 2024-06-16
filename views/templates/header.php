<nav class="sticky p-5 bg-zinc-700 shadow-lg flex justify-around items-center">
    <a href="/" class="flex items-center w-1/2 md:gap-2 lg:w-1/4">
        <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="max-w-16">
        <h1 class="hidden md:block font-display md:text-3xl lg:text-4xl xl:text-5xl text-zinc-200 text-center">Pixel Market</h1>
    </a>
    <div class="w-3/4 items-center justify-between hidden lg:flex">
        <div class="w-1/2">
            <form class="max-w-md mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-zinc-500 focus:border-zinc-500 " placeholder="Buscar productos" required />
                    <button type="submit" class="font-display text-white absolute end-2.5 bottom-2.5 bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
                </div>
            </form>
        </div>
        <div class="font-display text-xl text-zinc-200 uppercase w-1/2 justify-end gap-6 items-center flex">
            <a href="/destacados" class="hover:opacity-70 <?php echo pagina_actual('/destacados') ? 'opacity-50' : ''; ?>">Destacados</a>
            <a href="/categorias" class="hover:opacity-70 <?php echo pagina_actual('/categorias') ? 'opacity-50' : ''; ?>">Categorias</a>
            <a href="/carrito" class="block w-1/5 max-w-10 cursor-pointer hover:opacity-70 <?php echo pagina_actual('/carrito') ? 'opacity-50' : ''; ?>">
                <img src="/img/ShoppingCart.png" alt="Carrito de compras pixelado">
            </a>
            <a href="/perfil" class="block w-1/5 max-w-10 cursor-pointer hover:opacity-70 <?php echo pagina_actual('/perfil') ? 'opacity-50' : ''; ?>">
                <img src="/img/IniciodeSesion.png" alt="Perfil">
            </a>
        </div>
    </div>
    <div id="hamburguesa" class="lg:hidden w-1/5 max-w-10">
        <img src="/img/more.png" alt="Menu de más" class="invert cursor-pointer">
    </div>
</nav>
<nav id="menu" class="font-display hidden text-xl text-zinc-200 uppercase flex-col items-center lg:hidden">
    <a href="/destacados" class="bg-zinc-700 py-3 hover:opacity-70 w-full text-center <?php echo pagina_actual('/destacados') ? 'opacity-50' : ''; ?>">Destacados</a>
    <a href="/categorias" class="bg-zinc-700 py-3 hover:opacity-70 w-full text-center <?php echo pagina_actual('/categorias') ? 'opacity-50' : ''; ?>">Categorias</a>
    <a href="/carrito" class="bg-zinc-700 py-3 hover:opacity-70 w-full flex justify-center items-center <?php echo pagina_actual('/carrito') ? 'opacity-50' : ''; ?>">
        <img src="/img/ShoppingCart.png" alt="Carrito de compras pixelado" class="w-1/5 max-w-10 cursor-pointer">
        <p>Carrito</p>
    </a>
    <a href="/perfil" class="bg-zinc-700 py-3 hover:opacity-70 w-full flex justify-center items-center <?php echo pagina_actual('/perfil') ? 'opacity-50' : ''; ?>">
        <img src="/img/IniciodeSesion.png" alt="Perfil" class="w-1/5 max-w-8 cursor-pointer">
        <p>Perfil</p>
    </a>
</nav>