<h2 class="text-xl text-zinc-700 text-center">Olvidaste tu contraseña</h2>
<p class="text-zinc-600 text-center">Escribe tu correo para enviar las instrucciones para recuperar tu contraseña.</p>
<div>
    <?php include __DIR__ . '/../templates/alertas.php'; ?>
    <form id="formulario" class="flex flex-col gap-4 mt-4">
        <input type="email" id="email" placeholder="Correo Electrónico" class="p-2 rounded-md border border-zinc-500 focus:outline-none focus:border-zinc-700">
        <button type="submit" id="boton" class="bg-zinc-700 text-white p-2 rounded-md hover:bg-zinc-800 focus:outline-none disabled:bg-zinc-300">Enviar Correo</button>
    </form>
    <div class="mt-4 flex flex-col md:flex-row md:justify-between items-center gap-2">
        <a href="/registro" class="text-zinc-700 hover:underline">¿No tienes cuenta? Regístrate</a>
        <a href="/login" class="text-zinc-700 hover:underline">¿Ya tienes cuenta? Inicia Sesión</a>
    </div>
</div>
<script src="/js/auth/olvide.js"></script>