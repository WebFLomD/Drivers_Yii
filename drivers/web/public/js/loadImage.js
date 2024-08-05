function showImage(event) {
    const fileInput = event.target;
    const file = fileInput.files[0];
    const img = document.getElementById('selected-image');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}