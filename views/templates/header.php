<nav class="sticky top-0 z-50 p-5 bg-zinc-700 shadow-lg flex justify-around items-center h-24 lg:h-auto">
    <a href="/" class="flex items-center w-1/2 md:gap-2 lg:w-1/4">
        <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="max-w-16">
        <h1 class="hidden md:block font-display md:text-3xl lg:text-4xl xl:text-5xl text-zinc-200 text-center">Pixel Market</h1>
    </a>
    <div class="w-2/3 items-center justify-between hidden lg:flex gap-2">
        <div class="w-1/2">
            <div class=" mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <img src="/img/search.png" alt="Buscar" class="w-4 h-4">
                    </div>
                    <input type="search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-zinc-500 focus:border-zinc-500 " placeholder="Buscar productos" />
                    <ul id="search-menu" class="w-full absolute top-full bg-zinc-100 shadow-lg"></ul>
                </div>
            </div>
        </div>
        <div class="font-display text-sm xl:text-xl text-zinc-200 uppercase w-1/2 justify-end gap-6 items-center flex">
            <a href="/destacados" class="hover:opacity-70 <?php echo pagina_actual('/destacados') ? 'opacity-50 text-zinc-300' : ''; ?>">Destacados</a>
            <a href="/categorias" class="hover:opacity-70 <?php echo pagina_actual('/categorias') ? 'opacity-50 text-zinc-300' : ''; ?>">Categorias</a>
            <?php if(is_admin()){?>
                <a href="/admin" class="hover:opacity-70 ">Admin</a>
            <?php } else { ?>
                <a href="/carrito" class="block w-1/5 min-w-8 max-w-10 cursor-pointer hover:opacity-70 <?php echo pagina_actual('/carrito') ? 'opacity-50 text-zinc-300' : ''; ?>">
                    <img src="/img/ShoppingCart.png" alt="Carrito de compras pixelado">
                </a>
                <a href="/perfil" class="block w-1/5 min-w-8 max-w-10 cursor-pointer hover:opacity-70 <?php echo pagina_actual('/perfil') ? 'opacity-50 text-zinc-300' : ''; ?>">
                    <img src="/img/IniciodeSesion.png" alt="Perfil">
                </a>
            <?php } ?>
        </div>
    </div>
    <div id="hamburguesa" class="lg:hidden w-1/5 max-w-10">
        <img src="/img/more.png" alt="Menu de más" class="invert cursor-pointer">
    </div>
    <div id="menu" class="absolute top z-100 w-full top-24 font-display hidden text-xl text-zinc-200 uppercase flex-col items-center lg:hidden">
        <a href="/destacados" class="bg-zinc-700 py-3 hover:opacity-70 w-full text-center <?php echo pagina_actual('/destacados') ? 'opacity-90' : ''; ?>">Destacados</a>
        <a href="/categorias" class="bg-zinc-700 py-3 hover:opacity-70 w-full text-center <?php echo pagina_actual('/categorias') ? 'opacity-90' : ''; ?>">Categorias</a>
        
        <?php if(is_admin()){?>
                <a href="/admin" class="bg-zinc-700 py-3 hover:opacity-70 w-full text-center">Admin</a>
        <?php } else { ?>
                <a href="/carrito" class="bg-zinc-700 py-3 hover:opacity-70 w-full flex justify-center items-center <?php echo pagina_actual('/carrito') ? 'opacity-90' : ''; ?>">
                    <img src="/img/ShoppingCart.png" alt="Carrito de compras pixelado" class="w-1/5 max-w-10 cursor-pointer">
                    <p>Carrito</p>
                </a>
                <a href="/perfil" class="bg-zinc-700 py-3 hover:opacity-70 w-full flex justify-center items-center <?php echo pagina_actual('/perfil') ? 'opacity-90' : ''; ?>">
                    <img src="/img/IniciodeSesion.png" alt="Perfil" class="w-1/5 max-w-8 cursor-pointer">
                    <p>Perfil</p>
                </a>
        <?php } ?>
        <div class="w-full bg-zinc-700 py-5 px-8 font-sans mx-auto"> 
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <img src="/img/search.png" alt="Buscar" class="w-4 h-4">
                </div>
                <input type="search" id="search-mobile" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-zinc-500 focus:border-zinc-500 " placeholder="Buscar productos" />
                <ul id="search-menu-mobile" class="w-full absolute top-full bg-zinc-100 shadow-lg"></ul>
            </div>
        </div>
    </div>
</nav>
