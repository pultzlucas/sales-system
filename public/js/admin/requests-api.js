export function getConfirmRequests() {
    return getRequestsByState(1)
}

export function getPendingRequests() {
    return getRequestsByState(2)
}

export function getFinishedRequests() {
    return getRequestsByState(3)
}

export function getDeliveredRequests() {
    return getRequestsByState(4)
}

export function getDeniedRequests() {
    return getRequestsByState(0)
}

async function getRequestsByState(state) {
    const res = await fetch(`/api/requests/state/${state}`)
    const requests = await res.json()
    return requests
}