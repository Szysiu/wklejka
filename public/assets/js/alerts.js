const alert = document.querySelector('#danger')

setTimeout(function () {
    if (alert) {
        alert.style.opacity = '0'
        alert.style.transition = 'opacity 0.5s'
        setTimeout(function () {
            alert.style.display = 'none'
        }, 500)
    }
}, 3000)


