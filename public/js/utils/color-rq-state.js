const requestStatus = Array.from(document.querySelectorAll('.request_status'))

if(requestStatus.length > 0) {
    requestStatus.forEach(reqStatus => {
        reqStatus.style.color = getTextColorFromState(reqStatus.id)
    })
}

function getTextColorFromState(state) {
    switch (Number(state)) {
        case 0: // Denied
            return '#e63946'
        case 1: // Waiting confirmation
            return '#fb8500'
        case 2: // Pending
            return '#ffd60a'
        case 3: // Finished
            return '#a7c957'
        case 4: // Delivered
            return '#0081a7'
        default:// Unknown
            return '#aaaaaa'
    }
}