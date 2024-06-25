<div class="w-full overflow-x-auto md:flex md:flex-col md:items-center">
    <table class="w-full md:w-2/3 lg:md:w-1/2 text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
            <tr>
                <th scope="col" class="px-6 py-3">PIC</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
                    <tr class="bg-white border-b">
                        <td><img src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($usuario->email))); ?>?d=retro&f=y&s=50" class="m-auto" alt="Imagen de perfil de <?= $usuario->email ?>"></td>
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap <?= $usuario->admin == "1" ? 'text-red-600' : 'text-gray-900' ?>"><?= $usuario->nombre . " " . $usuario->apellido ?></td>
                        <td class="px-6 py-4 text-center  <?= $usuario->admin == "1" ? 'text-red-600' : 'text-gray-900' ?>"><?= $usuario->email?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($usuario->saldo, 2)?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
        echo $paginacion;
    ?>
</div>
