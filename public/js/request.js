import db from './firebase/config.js'
import { ref, set } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js" 

const requestItemsListElem = document.querySelector('.request-items')
let totalRequestPrice = 0.00

const requestItemsList = []

const finishRequestBtn = document.querySelector('.btn-finish-request')

document.querySelector('.btn-finish-request').addEventListener('click', e => {
    const isAdmin = document.querySelector('main').classList.contains('admin')
    finishRequest(e, isAdmin)
})

document.querySelectorAll('.product').forEach(item => {
    item.querySelector('button').addEventListener('click', addToRequest)
})

function finishRequest(e, isAdmin)
{
    const btn = e.target
    addSpinnerToBtn(btn)

    const urls = {
        addRequest: isAdmin ? '/api/admin/requests' : '/api/requests',
        addRequestProduct: isAdmin ? '/api/request_products' : '/api/admin/request_products',
        redirect: isAdmin ? '/admin' : '/'
    }

    fetch(urls.addRequest, { method: 'POST' })
        .then(res => res.json())
        .then(({ id: requestId }) => {
            // Linking items to request
            requestItemsList
                .map(({ id }) => id)
                .forEach(itemId => {
                    fetch(`${urls.addRequestProduct}?product_id=${itemId}&request_id=${requestId}`, {method: 'POST'})
                })

            // Save request on real time database
            set(ref(db, 'requests/' + requestId), {
                id: requestId,
                state: isAdmin ? '2' : '1'
            })

            removeSpinnerFromBtn(btn)
            console.log('Pedido criado com sucesso!')

            location.assign(urls.redirect)
        })
        .catch(alert)
}


function addToRequest(e) 
{
    e.stopPropagation()
    const buttonClicked = e.target
    const productId = e.target.parentNode.parentNode.parentNode.id

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

function getProduct(productId) {
    return fetch(`/api/products/${productId}`).then(res => res.json())
}

function floatToCurrency(n) {
    return n.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
}