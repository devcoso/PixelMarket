async function getCategorias() {
    try {
        const response = await fetch('https://dummyjson.com/products/categories');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

async function getProductos(slug) {
    try {
        const response = await fetch('https://dummyjson.com/products' + slug);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}
export { getCategorias, getProductos };