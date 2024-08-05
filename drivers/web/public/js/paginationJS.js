document.querySelectorAll('.page-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Здесь можно добавить логику обновления контента страницы при переключении страницы
        // Например, загрузка контента по AJAX при переключении страницы
        alert('Переключение на страницу ' + this.innerText);
    });
});