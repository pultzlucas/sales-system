if(prompt('Senha do Admin') !== 'Sergio123') {
    history.back()
}

document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', ({ target }) => {
        document.querySelectorAll('.nav-link').forEach(link => {
            if(link.classList.contains('active')) {
                link.classList.remove('active')
            }
        })
        target.classList.add('active')
    })
})