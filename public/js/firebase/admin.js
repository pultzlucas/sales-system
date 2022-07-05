import db from './config.js'
import { ref, onValue, off } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js" 
import getRequestElement from '../admin/request-dom.js'

const requests = ref(db, `requests`)

async function addConfirmRequestsToList(snapshot) {
    addRequestsByState(snapshot, '1')
}
async function addPendingRequestsToList(snapshot) {
    addRequestsByState(snapshot, '2')
}
async function addFinishedRequestsToList(snapshot) {
    addRequestsByState(snapshot, '3')
}
async function addDeliveredRequestsToList(snapshot) {
    addRequestsByState(snapshot, '4')
}
async function addDeniedRequestsToList(snapshot) {
    addRequestsByState(snapshot, '0')
}

async function addRequestsByState(snapshot, state) {
    if(snapshot) {
        const requestsList = document.querySelector('.requests')
        resetRequestList()
        const requests = Object.values(snapshot.val()).filter(req => req.state === state)
        let listHTML = ''
        for(let req of requests) {
            listHTML += await getRequestHTML(req.id)
        }
        setRequestList(listHTML)
    }
}

async function getRequestHTML(reqId) {
    const res = await fetch('/api/requests/' + reqId)
    const request = await res.json()
    return getRequestElement(request)
}

function setRequestList(listHTML) {
    requestsList.innerHTML = listHTML
    
    // Hide placeholder and spinner
    document.querySelector('.spinner-border').setAttribute('hidden', '')    
    if(listHTML === '') {
        document.querySelector('.request-list-placeholder').removeAttribute('hidden')
    }
}

function resetRequestList() {
    requestsList.innerHTML = ''
    document.querySelector('.spinner-border').removeAttribute('hidden')
    document.querySelector('.request-list-placeholder').setAttribute('hidden', '')
}


onValue(requests, addConfirmRequestsToList)

document.querySelector('#state_1').addEventListener('click', () => {
    off(requests)
    onValue(requests, addConfirmRequestsToList)
})

document.querySelector('#state_2').addEventListener('click', () => {
    off(requests)
    onValue(requests, addPendingRequestsToList)
})

document.querySelector('#state_3').addEventListener('click', () => {
    off(requests)
    onValue(requests, addFinishedRequestsToList)
})

document.querySelector('#state_4').addEventListener('click', () => {
    off(requests)
    onValue(requests, addDeliveredRequestsToList)
})

document.querySelector('#state_0').addEventListener('click', () => {
    off(requests)
    onValue(requests, addDeniedRequestsToList)
})