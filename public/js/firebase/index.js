import db from './config.js'
import { ref, onValue } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js"

const requestId = document.querySelector('.request-id')

if(requestId) {
    const requests = ref(db, `requests/${requestId.textContent}`)        
    onValue(requests, snapshot => {
        if(snapshot.val()) {
            const state = snapshot.val().state
            changeRequestState(state)
            displayStateMessage(state)

            const reqIsDesactive = state == 0 || state == 4
            if(reqIsDesactive) {
                deleteRequestView()
                addMakeRequestBtn()
            }

            if(state != 1) {
                deleteRemoveRequestBtn()
            }
        }
    })
}

function addMakeRequestBtn(){
    const a = document.createElement('a')
    a.classList.add('btn', 'btn-secondary', 'make-request-link')
    a.href = '/request'
    a.textContent = 'Fazer pedido'

    const container = document.querySelector('.container')
    container.insertAdjacentElement('afterbegin', a)
}

function deleteRemoveRequestBtn() {
    const btn = document.querySelector('.btn-cancel-request')
    if(btn) btn.remove()
}

function deleteRequestView() {
    const requestView = document.querySelector('.request-view')
    requestView.remove()
}

function changeRequestState(state) {
    const requestState = document.querySelector('.request_status')
    requestState.id = state

    const requestStateText = requestState.querySelector('strong')
    requestStateText.textContent = getRequestStateText(state)
    requestStateText.style.color = getTextColorFromState(state)
}

function displayStateMessage(state) {
    const getAlertHTML = message => `
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`

    const insertAlertOnPage = message => {
        const alertArea = document.querySelector('.alert-area')
        alertArea.innerHTML += getAlertHTML(message)
    }

    switch(Number(state)) {
        case 0: // Denied
            insertAlertOnPage('Seu pedido foi cancelado')
            break
        case 1: // Waiting confirmation
            insertAlertOnPage('Esperando confirmação do pedido na barraca. Quando for confirmado aparecerá no status do pedido')
            break
        case 2: // Pending
            insertAlertOnPage('Seu pedido está em preparo. Logo logo ele estará pronto, só esperar')
            break
        case 3: // Finished
            insertAlertOnPage('Seu pedido está pronto!!! Para retirar redija-se até a nossa barraca')
            break
        case 4: // Delivered
            insertAlertOnPage('Seu pedido foi entregue. Bom apetite!')
            break
        default:// Unknown
            insertAlertOnPage('Algum erro inesperado ocorreu com o seu pedido. Tente novamente mais tarde')
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
           return 'Cancelado'
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
