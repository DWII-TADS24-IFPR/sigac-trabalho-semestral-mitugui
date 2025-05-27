document.addEventListener('DOMContentLoaded', function () {
    const alertBox = document.getElementById('alert-pop-up');
    if (alertBox) {
        alertBox.addEventListener('click', function () {
            alertBox.style.display = 'none';
        });
    }
});
