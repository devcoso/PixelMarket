<?php 
    if($token_valido){ 
?>
    <h2 class="text-xl text-zinc-700 text-center">Reestablece tu password</h2>
    <div>
        <?php include __DIR__ . '/../templates/alertas.php'; ?>
        <form id="formulario" class="flex flex-col gap-4 mt-4">
            <input type="password" id="password" placeholder="Nueva Contraseña" class="p-2 rounded-md border border-zinc-500 focus:outline-none focus:border-zinc-700">
            <input type="password" id="password2" placeholder="Repite tu Contraseña" class="p-2 rounded-md border border-zinc-500 focus:outline-none focus:border-zinc-700">
            <button type="submit" id="boton" class="bg-zinc-700 text-white p-2 rounded-md hover:bg-zinc-800 focus:outline-none disabled:bg-zinc-300">Guardar password</button>
        </form>
    </div>
    <script src="/js/auth/reestablecer.js"></script>    
    <?php
    } else {
        echo "<div class='bg-red-800 text-white p-3 text-center rounded-md'>";
        echo "Token no válido";
        echo "</div>";
    }
    ?>
<div class="mt-4 flex flex-col md:flex-row md:justify-center items-center gap-2">
            <a href="/login" class="text-zinc-700 hover:underline">¿Ya has reestablecido tu password? Inicia Sesión</a>
</div>

