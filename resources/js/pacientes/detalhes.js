$(() => {
    getInfo()
})

const getInfo = async () => {

    $('#container-loading-informacoes').removeClass('hidden')
    $('#container-informacoes').addClass('hidden')

    const id = $('#id').val()

    const url = `/api/pacientes/${id}`

    const request = await $.get(url);

    if (!request?.success) {
        return Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: request.message,
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
        })
    }

    const response = request.data

    renderInfo(response)
    
}

const renderInfo = data => {

    console.log(data);

    $('#nome').text(data.nome)
    $('#idade').text(data.idade)
    $('#data_nascimento').text(`(${data.data_nascimento_formatada})`)
    $('#cpf').text(data.cpf_formatado)
    $('#cns').text(data.cns_formatado)
    $('#mae').text(data.mae)
    $('#endereco').text(data.endereco_formatado)

    $('#foto').attr('src', data.foto_url)

    $('#container-loading-informacoes').addClass('hidden')
    $('#container-informacoes').removeClass('hidden')

}