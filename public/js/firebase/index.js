import db from './config.js'
import { ref, onValue } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js"

const requestId = document.querySelector('.request-id')
if(requestId) {
    const requests = ref(db, `requests/${requestId.textContent}`)        
    onValue(requests, snapshot => {
        changeRequestState(snapshot.val().state)
    })
}

function changeRequestState(state) {
    const requestState = document.querySelector('.request_status')
    requestState.id = state

    const requestStateText = requestState.querySelector('strong')
    requestStateText.textContent = getRequestStateText(state)
    requestStateText.style.color = getTextColorFromState(state)
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
