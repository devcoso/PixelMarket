<img src="/img/IniciodeSesion.png" alt="Logo inicio sesión Pixel Market" class="w-1/5 max-w-14 m-auto">
<h2 class="text-xl text-zinc-700 text-center">Iniciar Sesión</h2>
<div>
    <?php include __DIR__ . '/../templates/alertas.php'; ?>
    <form id="formulario" class="flex flex-col gap-4 mt-4">
        <input type="email" id="email" placeholder="Correo Electrónico" class="p-2 rounded-md border border-zinc-500 focus:outline-none focus:border-zinc-700">
        <input type="password" id="password" placeholder="Contraseña" class="p-2 rounded-md border border-zinc-500 focus:outline-none focus:border-zinc-700">
        <button type="submit" id="boton" class="bg-zinc-700 text-white p-2 rounded-md hover:bg-zinc-800 focus:outline-none disabled:bg-zinc-300">Iniciar Sesión</button>
    </form>
    <div class="mt-4 flex flex-col md:flex-row md:justify-between items-center gap-2">
        <a href="/registro" class="text-zinc-700 hover:underline">¿No tienes cuenta? Regístrate</a>
        <a href="/olvide" class="text-zinc-700 hover:underline">¿Olvidaste tu contraseña?</a>
    </div>
</div>
<script src="/js/auth/login.js"></script>