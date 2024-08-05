function downloadFile() {
    const url = 'http://drivers/public/file/contract-sale.pdf'; // указывайте путь к готовому файлу
    const a = document.createElement('a');
    a.href = url;
    a.download = 'contract-sale.pdf'; // название файла для скачивания
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}