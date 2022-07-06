document.querySelector('#confirmationPopup').querySelector('.btn-success').addEventListener('click', deleteRequest)

function deleteRequest(e) {
    addSpinnerToBtn(e.target)

    const requestId = document.querySelector('.request-view').id
    fetch(`/api/requests/${requestId}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(({ message }) => {
            removeSpinnerFromBtn(e.target)
            console.log(message)
            location.reload()
        })
        .catch(console.error)
}