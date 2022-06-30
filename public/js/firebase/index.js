import db from './config.js'
import { ref, onValue } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js"

const requestId = document.querySelector('.request-id')
if(requestId) {
    const requests = ref(db, `requests/${requestId.textContent}`)        
    onValue(requests, snapshot => {
        if(snapshot.val()) {
            const state = snapshot.val().state
            removeCancelRequestBtn(state)
            changeRequestState(state)
            displayStateMessage(state)
        }
    })
}

function removeCancelRequestBtn(state) {
    const btn = document.querySelector('.btn-cancel-request')
    btn.removeAttribute('hidden')
    if(state === '4') {
        btn.setAttribute('hidden', '')
    }
}

function changeRequestState(state) {
    const requestState = document.querySelector('.request_status')
    requestState.id = state

    const requestStateText = requestState.querySelector('strong')
    requestStateText.textContent = getRequestStateText(state)
    requestStateText.style.color = getTextColorFromState(state)
}

function displayStateMessage(state) {
    switch(Number(state)) {
        case 0: // Denied
            alert('Seu pedido foi cancelado')
            break
        case 1: // Waiting confirmation
            alert('Esperando confirmação do pedido na barraca. Quando for confirmado aparecerá no status do pedido')
            break
        case 2: // Pending
            alert('Seu pedido está em preparo. Logo logo ele estará pronto, só esperar')
            break
        case 3: // Finished
            alert('Seu pedido está pronto!!! Para retirar redija-se até a nossa barraca')
            break
        case 4: // Delivered
            alert('Seu pedido foi entregue. Bom apetite!')
            break
        default:// Unknown
            alert('Algum erro inesperado ocorreu com o seu pedido. Tente novamente mais tarde')
    }
}

function getTextColorFromState(state) {
    switch (Number(state)) {
        case 0: // Denied
            return '#e63946'
        case 1: // Waiting confirmation
            return '#fb8500'
        case 2: // Pending
            return '#ffd60a'
        case 3: // Finished
            return '#a7c957'
        case 4: // Delivered
            return '#0081a7'
        default:// Unknown
            return '#aaaaaa'
    }
}

function getRequestStateText(state) {
    switch (Number(state)) {
        case 0:
           return 'Negado'
        case 1:
           return 'Esperando confirmação'
        case 2:
           return 'Em preparo'
        case 3:
           return 'Pronto'
        case 4:
           return 'Entregue'
        default:
           return 'Desconhecido'
    }
}
