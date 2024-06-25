
async function consultar() {
    const response = await fetch('/admin/api/dashboard');
    const data = await response.json();
    console.log(data);
}

consultar();