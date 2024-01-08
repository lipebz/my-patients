const getCep = async (cep = '_') => {

    $('#cep').prop('disabled', true)
    
    contadorLoading(1500)

    const url = `/api/cep/${cep}`

    const request = await $.get(url);

    if (!request?.success) {
        $('#cep').val('')
        return Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: request.message,
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
        })
    }

    renderCep(request.data)

}

const renderCep = data => {

    $('#logradouro').val(data?.logradouro ?? '')
    $('#bairro').val(data?.bairro ?? '')
    $('#cidade').val(data?.localidade ?? '')
    $('#uf').val(data?.uf ?? '')

    $('#cep').prop('disabled', false)

    $('#complemento').val('')
    $('#numero').val('').focus()



}

const contadorLoading = (timer) => {
    let timerInterval;
    Swal.fire({
        title: "Carregando",
        html: "Buscando endereço com base no CEP informado.",
        timer,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    })
}

$('#cep').on('keyup', function(e) {
    
    e.preventDefault()

    if (this.value.length == 9) {
        return getCep(this.value)
        
    }
 
})

