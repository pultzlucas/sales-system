function limitCpfInput(e) {
    const input = e.target
    if (input.value.length > 11) {
        input.value = input.value.slice(0, input.maxLength)
    }
}

document.querySelector('#cpf_input').addEventListener('input', limitCpfInput)