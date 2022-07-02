document.querySelector('#confirmationPopup').querySelector('.btn-success').addEventListener('click', deleteRequest)

function deleteRequest() {
    const requestId = document.querySelector('.request-view').id
    fetch(`/api/requests/${requestId}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(({ message }) => console.log(message))
        .catch(alert)
    location.reload()
}