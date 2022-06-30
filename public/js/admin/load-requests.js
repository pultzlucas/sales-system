import * as req from './requests-api.js'
import getRequestElement from './request-dom.js'

const requestsList = document.querySelector('.requests')

// TABS

// Pending
document.querySelector('#state_2').addEventListener('click', () => {
    resetRequestList()
    req.getPendingRequests().then(addRequestsToList)
})

// Finished
document.querySelector('#state_3').addEventListener('click', () => {
    resetRequestList()
    req.getFinishedRequests().then(addRequestsToList)
})

// Delivered
document.querySelector('#state_4').addEventListener('click', () => {
    resetRequestList()
    req.getDeliveredRequests().then(addRequestsToList)
})

// Denied
document.querySelector('#state_0').addEventListener('click', () => {
    resetRequestList()
    req.getDeniedRequests().then(addRequestsToList)
})

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

function addRequestsToList(reqs) {
    // console.log(reqs)
    requestsList.innerHTML = reqs.map(getRequestElement).join('')
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