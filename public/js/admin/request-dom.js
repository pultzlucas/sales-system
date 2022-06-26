export default function getRequestElement(req) {
    return `
    <li id="${req.id}">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td><strong>Número</strong></td>
                    <td>${req.id}</td>
                </tr>
                <tr>
                    <td><strong>Preço total</strong></td>
                    <td><span class="request-total-price">${req.total_price}</span></td>
                </tr>
                <tr>
                    <td><strong>Pedido feito em</strong></td>
                    <td>${formatTimestamp(req.created_at)}</td>
                </tr>
            </table>
            
            <div id="accordion_${req.id}" class="accordion-item request-items">
                <h3 class="accordion-header" id="heading_${req.id}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse_${req.id}" aria-expanded="false"
                        aria-controls="collapse_${req.id}">
                        <strong>Itens do Pedido</strong>
                    </button>
                </h3>
                <div id="collapse_${req.id}" class="accordion-collapse collapse"
                    aria-labelledby="heading_${req.id}" data-bs-parent="#routesAccordion" data-parent="#accordion_${req.id}">
                    <div class="accordion-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Preço</th>
                            </tr>
                            </thead>
                            <tbody>
                            ${req.items.map(getRequestItemElement).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           ${getRequestControlsElement(req.id, req.state)}
        </div>
    </div>
    </li>`
}

function getRequestControlsElement(id, state) {
    console.log(state != 4 && state != 0)
    return state != 4 && state != 0 ? ` 
    <div class="request-controls">            
        <button onclick="increaseState(${id}, this)" class="btn btn-success">
            <span class="title">${getOKButtonTextFromState(state)}</span>
        </button>
        <button onclick="cancel(${id}, this)" class="btn btn-danger">
            <span class="title">${getDismissButtonTextFromState(state)}</span>
        </button>
    </div>`: ''
}

function getOKButtonTextFromState(state) {
    switch(state) {
        case '1':
            return 'Aceitar'
        case '2':
            return 'Pronto'
        case '3':
            return 'Entregue'
        default:
            return 'Status Desconhecido'
    }
}

function getDismissButtonTextFromState(state) {
    switch(state) {
        case '1':
            return 'Negar'
        case '2':
            return 'Cancelar'
        case '3':
            return 'Não entregue'
        default:
            return 'Status Desconhecido'
    }
}

function getRequestItemElement(item) {
    return `
    <tr class="request-item">
    <td>${item.description}</td>
    <td>${floatToCurrency(item.price)}</td>
    </tr>`
}

function formatTimestamp(timestamp) {
    const time = String(timestamp).match(/\d\d:\d\d:\d\d/)[0]
    const date = String(timestamp).match(/\d\d\d\d-\d\d-\d\d/)[0]
    return `${date} ${time}`
}

function floatToCurrency(n) {
    return n.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
}