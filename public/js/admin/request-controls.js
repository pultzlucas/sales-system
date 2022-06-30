const requestsList = document.querySelector('.requests')

function increaseState(requestId, btn) {
    addSpinnerToBtn(btn)
    fetch(`/api/requests/${requestId}`)
        .then(res => res.json())
        .then(({ state, id }) => {
            fetch(`/api/requests/${id}?state=${Number(state) + 1}`, { method: 'PUT' })
                .then(res => res.json())
                .then(req => {
                    if(state !== '1') {
                        removeRequestFromList(req)
                    }
                    removeSpinnerFromBtn(btn)
                })
        })
}

function cancel(requestId, btn) {
    addSpinnerToBtn(btn)
    fetch(`/api/requests/${requestId}?state=0`, { method: 'PUT' })
        .then(res => res.json())
        .then(req => {
            removeRequestFromList(req)
            removeSpinnerFromBtn(btn)
        })
}

function removeRequestFromList(request) {
    Array.from(requestsList.children).forEach(req => {
        if (req.id == request.id) req.remove()
    })
    if (requestsList.childElementCount === 0) {
        document.querySelector('.request-list-placeholder').removeAttribute('hidden')
    }
}