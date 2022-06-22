const requestItemsListElem = document.querySelector('.request-items')
let totalRequestPrice = 0.00

const requestItemsList = []

const finishRequestBtn = document.querySelector('.btn-finish-request')

function finishRequest(btn)
{
    addSpinnerToBtn(btn)
    fetch('api/requests', { method: 'POST' })
        .then(res => res.json())
        .then(({ id: requestId, state }) => {
            console.log(state)
            requestItemsList
                .map(({ id }) => id)
                .forEach(itemId => {
                    fetch(`/api/request_products?product_id=${itemId}&request_id=${requestId}`, {method: 'POST'})
                })
            removeSpinnerFromBtn(btn)
            alert('Pedido criado com sucesso!')
            location.assign('/')
        })
        .catch(alert)
}

function addToRequest(productId, buttonClicked) 
{
    addSpinnerToBtn(buttonClicked)
    getProduct(productId)
        .then(product => {
            removeListPlaceholder()

            const requestItem = createRequestItem(product)
            requestItemsListElem.appendChild(requestItem)
            requestItemsList.push(product)
            updateRequestTotalPrice()
            toggleAbleFinishButton()

            removeSpinnerFromBtn(buttonClicked)
        })
}

function removeFromRequest(requestItem, itemId) {
    requestItemsListElem.removeChild(requestItem)
    requestItemsList.splice(itemId, 1)
    updateRequestTotalPrice()
    addListPlaceholder()
    toggleAbleFinishButton()
}

function toggleAbleFinishButton() {
    if (requestItemsList.length === 0) {
        finishRequestBtn.setAttribute('disabled', '')
    } else {
        finishRequestBtn.removeAttribute('disabled')
    }
}

function updateRequestTotalPrice() {
    const totalView = document.querySelector('.total')
    const totalPrice = requestItemsList.reduce((total, { price }) => total + parseFloat(price), 0.00)
    totalRequestPrice = totalPrice
    const totalPriceCurrency = floatToCurrency(totalRequestPrice).replaceAll(/[^0123456789.,]/g, "")
    totalView.textContent = totalPriceCurrency
}

function removeListPlaceholder() {
    if (requestItemsListElem.firstChild.nodeName === 'P') {
        requestItemsListElem.firstChild.setAttribute('hidden', '')
    }
}

function addListPlaceholder() {
    if (requestItemsListElem.childNodes.length === 1) {
        requestItemsListElem.firstChild.removeAttribute('hidden')
    }
}

function createRequestItem({ img_url, price }) {
    const requestItem = document.createElement('div')
    requestItem.classList.add('request-item')

    const img = document.createElement('img')
    img.src = img_url

    const itemPrice = document.createElement('p')
    itemPrice.classList.add('item-price')
    itemPrice.textContent = floatToCurrency(price)

    const button = document.createElement('button')
    button.classList.add('btn', 'btn-danger')
    button.textContent = 'Remover'
    button.addEventListener('click', () => {
        const itemId = Array.from(requestItemsListElem.childNodes).indexOf(requestItem) - 1
        removeFromRequest(requestItem, itemId)
    })
    requestItem.appendChild(img)
    requestItem.appendChild(itemPrice)
    requestItem.appendChild(button)
    return requestItem
}

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

function getProduct(productId) {
    return fetch(`/api/products/${productId}`).then(res => res.json())
}

function floatToCurrency(n) {
    return n.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
}