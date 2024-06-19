async function getCategorias() {
    try {
        const response = await fetch('/api/categorias');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

async function getProductos(extra = '') {
    try {
        const response = await fetch('/api/productos' + extra);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}
export { getCategorias, getProductos };