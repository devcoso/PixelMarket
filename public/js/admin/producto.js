const id = document.querySelector('#id-producto').value;
const btn = document.querySelector('#btn-stock');
const stockInput = document.querySelector('#stockInput');
const stockP = document.querySelector('#stockP');

btn.addEventListener('click', () => {
    const stock = stockInput.value;
    const datos = new FormData();
    datos.append('id', id);
    datos.append('stock', stock);
    fetch(`/admin/producto/stock`, {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if(data.ok){
            Swal.fire({
                title: "Actualizado",
                text: "Stock actualizado correctamente",
                icon: "success",
                confirmButtonColor: "#1e40af",
                confirmButtonText: "¡Ok!"
            })
            stockP.textContent = stock;
            if(stock == 0){
                stockP.classList.add('text-red-600');
            }
            else{
                stockP.classList.remove('text-red-600');
            }
        }
        else{
            Swal.fire({
                title: "Error",
                text: data.mensaje,
                icon: "error",
                confirmButtonColor: "#1e40af",
                confirmButtonText: "¡Ok!"
            })
        }
    });
})