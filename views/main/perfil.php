<?php 
    if(is_auth()) { ?>
        <div class="py-10 text-zinc-600 space-y-5 min-h-screen flex items-center flex-col">
            <h1 class="text-4xl font-bold text-zinc-800 font-display">Perfil</h1>
            <p class="text-2xl font-bold text-zinc-800 "><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></p>
            <p class="text-2xl font-bold text-zinc-700 "><?php echo $_SESSION['email'] ?></p>
            <img src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['email']))); ?>?d=retro&f=y&s=256" alt="">
            <p class="text-xl font-bold">Saldo: <span class="text-zinc-800 ">$<?php echo  number_format($_SESSION['saldo'], 2, '.', ','); ?></span></p>
            <a href="/compras" class="bg-zinc-800 block text-zinc-200 w-3/4 md:w-1/3 m-auto font-bold text-center rounded-md p-4 shadow-lg">Mis compras</a>
            <form action="/logout" method="POST" class="block w-full"><button type="submit" class="bg-red-800 block text-zinc-200  w-3/4 md:w-1/3 m-auto font-bold text-center rounded-md p-4 shadow-lg">Cerrar Sesión</button></form>
        </div>
    <?php } else { ?>
        <div class="py-10 text-zinc-800 space-y-5 min-h-screen flex justify-center items-center flex-col">
            <a href="/" class="flex flex-col items-center gap-2">
                <img src="/img/LogoPixelMarket.png" alt="Logo Pixel Market" class="max-w-16">
                <h1 class="hidden md:block font-display md:text-5xl lg:text-6xl xl:text-7xl text-zinc-800 text-center">Pixel Market</h1>
            </a>
            <h1 class="text-center text-4xl font-bold">Inicia Sesión o Crea una cuenta</h1>
            <p class="text-lg text-center">Debes iniciar sesión o crea una cuenta para poder ver tu perfil</p>
            <a href="/login" class="bg-zinc-800 block text-zinc-200 w-3/4 md:w-1/3 m-auto font-bold text-center rounded-md p-4 shadow-lg">Iniciar Sesión</a>
            <a href="/registro" class="bg-zinc-800 block text-zinc-200  w-3/4 md:w-1/3 m-auto font-bold text-center rounded-md p-4 shadow-lg">Crear Cuenta</a>
        </div>
    <?php }  ?>