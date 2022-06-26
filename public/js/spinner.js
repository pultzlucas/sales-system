function addSpinnerToBtn(btn) {
    const spinner = document.createElement('span')
    spinner.classList.add('spinner-border', 'spinner-border-sm')

    btn.appendChild(spinner)
    const buttonTitle = btn.querySelector('.title')
    buttonTitle.setAttribute('hidden', '')

    return spinner
}

function removeSpinnerFromBtn(btn)
{
    btn.querySelector('.spinner-border').remove()
    btn.querySelector('.title').removeAttribute('hidden')
}