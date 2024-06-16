<?php 
    if($alerta){ 
        echo "<img src=\"/img/accepted.png\" alt=\"Logo inicio sesión Pixel Market\" class=\"w-1/5 max-w-14 m-auto mb-2\">";
        echo "<div class='bg-lime-600 text-white p-3 text-center rounded-md'>";
        echo "Cuenta confirmada exitosamente";
        echo "</div>";
    } else {
        echo "<div class='bg-red-800 text-white p-3 text-center rounded-md'>";
        echo "Token no válido";
        echo "</div>";
    }
?>
<div class="mt-4 flex flex-col md:flex-row md:justify-center items-center gap-2">
        <a href="/login" class="text-zinc-700 hover:underline">¿Ya confirmaste tu cuenta? Inicia Sesión</a>
</div>