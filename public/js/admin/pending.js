function finishRequest(requestElement) {
    fetch(`/api/requests/${requestElement.id}?state=3`, { method: 'PUT' })
        .then(res => res.json())
        .then(() => requestElement.remove())
}

function cancelRequest(requestElement) {
    fetch(`/api/requests/${requestElement.id}?state=0`, { method: 'PUT' })
        .then(res => res.json())
        .then(() => requestElement.remove())
}