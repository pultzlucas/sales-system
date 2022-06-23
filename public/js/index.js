function deleteRequest(btn) {
    const requestId = btn.parentNode.id
    console.log(requestId)
    fetch(`/api/requests/${requestId}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(({ message }) => alert(message))
        .catch(alert)
    location.reload()
}