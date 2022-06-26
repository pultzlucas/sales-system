function confirmRequest(requestElement) {
    fetch(`/api/requests/${requestElement.id}?state=2`, { method: 'PUT' })
        .then(res => res.json())
        .then(() => requestElement.remove())
}

function denyRequest(requestElement) {
    fetch(`/api/requests/${requestElement.id}?state=0`, { method: 'PUT' })
        .then(res => res.json())
        .then(() => requestElement.remove())
}