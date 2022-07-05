import db from './config.js'
import { ref, onValue, off, onChildRemoved } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js"
import getRequestElement from '../admin/request-dom.js'
import * as req from '../admin/requests-api.js'

const requestsList = document.querySelector('.requests')

onChildRemoved(ref(db, `requests`), snapshot => {
    const {id} = snapshot.val()
    const requestToRemove = requestsList.querySelector(`[data-id="${id}"]`)
    requestsList.removeChild(requestToRemove)
})

async function addRequestsByState(snapshot, state) {
    if (snapshot) {
        const requests = Object.values(snapshot.val()).filter(req => req.state === state)

        const ids = requests
            .map(({ id }) => String(id))
            .filter(id => !Array.from(requestsList.children).map(req => req.id).includes(id))

        let listHTML = ''
        for (let id of ids) {
            listHTML += await getRequestHTML(id)
        }
        setRequestList(listHTML)
        checkIfExistsRequestsOnList()
    }
}

async function getRequestHTML(reqId) {
    const res = await fetch('/api/requests/' + reqId)
    const request = await res.json()
    return getRequestElement(request)
}

function setRequestList(listHTML) {
    requestsList.innerHTML += listHTML

    // Hide spinner
    document.querySelector('.spinner-border').setAttribute('hidden', '')
}

function resetRequestList() {
    requestsList.innerHTML = ''
    document.querySelector('.request-list-placeholder').setAttribute('hidden', '')
}

function setRequestsOfDB(reqs) {
    reqs
    .map(getRequestElement)
        .forEach(reqEl => requestsList.innerHTML += reqEl)
}

function checkIfExistsRequestsOnList() {
    if (requestsList.childElementCount === 0) {
        document.querySelector('.request-list-placeholder').removeAttribute('hidden')
    } else {
        document.querySelector('.request-list-placeholder').setAttribute('hidden', '')
    }
}


function initList(getRequestCb, onValueCb) {
    const requests = ref(db, `requests`)
    resetRequestList()
    off(requests, 'value')
    
    document.querySelector('.spinner-border').removeAttribute('hidden')
    getRequestCb().then(reqs => {
        setRequestsOfDB(reqs)
        onValue(requests, onValueCb)
        document.querySelector('.spinner-border').setAttribute('hidden', '')
    })
}

initList(req.getConfirmRequests, snapshot => {
    addRequestsByState(snapshot, '1')
})

document.querySelector('#state_1').addEventListener('click', () => {
    initList(req.getConfirmRequests, snapshot => {
        addRequestsByState(snapshot, '1')
    })
})
document.querySelector('#state_2').addEventListener('click', () => {
    initList(req.getPendingRequests, snapshot => {
        addRequestsByState(snapshot, '2')
    })
})
document.querySelector('#state_3').addEventListener('click', () => {
    initList(req.getFinishedRequests, snapshot => {
        addRequestsByState(snapshot, '3')
    })
})
document.querySelector('#state_4').addEventListener('click', () => {
    initList(req.getDeliveredRequests, snapshot => {
        addRequestsByState(snapshot, '4')
    })
})
document.querySelector('#state_0').addEventListener('click', () => {
    initList(req.getDeniedRequests, snapshot => {
        addRequestsByState(snapshot, '0')
    })
})