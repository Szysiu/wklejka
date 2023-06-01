document.addEventListener("DOMContentLoaded", function () {
    const button = document.querySelector('#copy')
    const alert = document.querySelector('#info');

    function hideAlert() {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s';
        setTimeout(function () {
            alert.style.display = 'none';
        }, 500);
    }

    function showAlert() {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s';
        alert.style.display = "block";
        alert.style.opacity = '1';
    }

    button.addEventListener("click", function () {
        if (alert.style.display === 'block') {
            hideAlert();
        } else {
            showAlert();
            setTimeout(function () {
                hideAlert();
            }, 3000);
        }
    })
});