const text = document.querySelector('#content_').textContent
const button = document.querySelector('#copy')

button.addEventListener('click',function () {
    const textarea = document.createElement('textarea')

    textarea.value = text
    document.body.append(textarea)
    textarea.select()
    document.execCommand('copy')
    document.body.removeChild(textarea)

})
