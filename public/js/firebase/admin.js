import db from './config.js'
import { ref, onValue, off } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js" 
import getRequestElement from '../admin/request-dom.js'

const requests = ref(db, `requests`)


async function addConfirmRequestsToList(snapshot) {
    const requestsList = document.querySelector('.requests')
    resetRequestList()

    const confirmRequests = Object.values(snapshot.val()).filter(req => req.state === '1')
    let listHTML = ''
    for(let confirmReq of confirmRequests) {
        const res = await fetch('/api/requests/' + confirmReq.id)
        const request = await res.json()
        listHTML += getRequestElement(request)
    }

    requestsList.innerHTML = listHTML
    
    // Hide placeholder and spinner
    document.querySelector('.spinner-border').setAttribute('hidden', '')    
    if(requestsList.childNodes.length === 0) {
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
})
document.querySelector('#state_3').addEventListener('click', () => {
    off(requests)
})
document.querySelector('#state_4').addEventListener('click', () => {
    off(requests)
})
document.querySelector('#state_0').addEventListener('click', () => {
    off(requests)
})