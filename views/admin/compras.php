<div class="w-full overflow-x-auto md:flex md:flex-col md:items-center">
    <table class="w-full md:w-2/3 lg:md:w-1/2 text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Total</th>
                <th scope="col" class="px-6 py-3">Usuario</th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($compras as $compra): ?>
                <tr class="bg-white border-b">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">#<?= $compra->id ?></td>
                        <td class="px-6 py-4 text-center"><?= $compra->fecha->format('Y-m-d')?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($compra->total, 2)?></td>
                        <td class="px-6 py-4 text-center"><?= $compra->usuario->email ?></td>
                        <td class="px-6 py-4 text-center">
                            <a href="/admin/compra?id=<?= $compra->id ?>" class=" bg-zinc-800 text-zinc-200 px-2 py-1 font-display block hover:bg-zinc-600">Ver</a>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
        echo $paginacion;
    ?>
</div>
