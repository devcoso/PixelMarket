
document.getElementById('boton-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();

    doc.text('Hello world!', 10, 10);
});