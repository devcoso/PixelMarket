<div class="w-full overflow-x-auto  flex justify-center">
    <table class="w-full md:w-2/3 lg:md:w-1/2 text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Stock</th>
                <th scope="col" class="px-6 py-3">Ventas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $categoria): ?>
                    <tr class="bg-white border-b">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "><?= $categoria->nombre?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($categoria->stock)?></td>
                        <td class="px-6 py-4 text-center"><?= number_format($categoria->ventas)?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
