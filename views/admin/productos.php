<div class="w-full overflow-x-auto md:flex md:flex-col md:items-center">
    <table class="w-full md:w-2/3 lg:md:w-1/2 text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Producto</th>
                <th scope="col" class="px-6 py-3">Stock</th>
                <th scope="col" class="px-6 py-3">Ventas</th>
                <th scope="col" class="px-6 py-3">Ingresos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 text-center"><?= $producto->id?></td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <a class="hover:text-zinc-500 block" href="/producto?id=<?= $producto->id ?>">
                                <?= $producto->titulo ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-center"><?= number_format($producto->stock)?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($producto->ventas)?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($producto->ventas * $producto->precio,2)?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
        echo $paginacion;
    ?>
</div>
