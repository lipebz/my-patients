$(async () => {
    await getInfo()
    initMask()
})


const getInfo = async () => {

    $('#container-loading-informacoes').removeClass('hidden')
    $('#form-edicao').addClass('hidden')

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

    $('#nome').val(data.nome)
    $('#idade').val(data.idade)
    $('#data_nascimento').val(`(${data.data_nascimento_formatada})`)
    $('#cpf').val(data.cpf_formatado)
    $('#cns').val(data.cns_formatado)
    $('#mae').val(data.mae)

    $('#cep').val(data.endereco.cep)
    $('#logradouro').val(data.endereco.logradouro)
    $('#numero').val(data.endereco.numero)
    $('#bairro').val(data.endereco.bairro)
    $('#cidade').val(data.endereco.cidade)
    $('#uf').val(data.endereco.uf)

    $('#img-foto').attr('src', data.foto_url)

    $('#container-loading-informacoes').addClass('hidden')
    $('#form-edicao').removeClass('hidden')

}

const initMask = () => {

    IMask($('#data_nascimento')[0], {
        mask: '00/00/0000'
    });

    IMask($('#cep')[0], {
        mask: '00000-000'
    });

    IMask($('#cpf')[0], {
        mask: '000.000.000-00'
    });

    IMask($('#cns')[0], {
        mask: '000 0000 0000 0000'
    });

}

const editar = async e => {

    e.preventDefault()

    const form = $('#form-edicao')[0]

    const data = new FormData(form)
    
    const id = $('#id').val()

    const url = `/api/pacientes/${id}`

    const request = await $.ajax({
        url,
        data,
        type : 'POST',
        processData: false,
        contentType: false,
    });

    if (!request?.success) {
        return Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: request.message,
        })
    }

    await Swal.fire({
        icon: 'success',
        title: 'Cadastrado com sucesso!',
        timer: 1500,
        showConfirmButton: false,
        timerProgressBar: true,
    })

    window.location.href = '/pacientes'


}

$('#form-edicao').submit(editar)

$('#input-foto').change(function(event) {

    const src = URL.createObjectURL(event.target.files[0])

    $('#img-foto').attr('src', src)

    $('.container-upload-input').addClass('hidden')
    $('.container-upload-preview').removeClass('hidden')

})


const getCep = async (cep = '_') => {

    $('#cep').prop('disabled', true)
    
    contadorLoading(1500)

    const url = `/api/cep/${cep}`

    const request = await $.get(url);

    $('#cep').prop('disabled', false)

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

    if (this.value.length >= 9) {
        return getCep(this.value)
        
    }
 
})

$('#cns').blur(async function () {

    const url = `/api/validar/cns/${this.value}`

    const request = await $.get(url);

    const { isValid } = request

    if (!isValid) {
        $('#cns').val('')
        $('#invalid-cns').removeClass('hidden')
    }
    else {
        $('#invalid-cns').addClass('hidden')
    }
    

})


const excluir = async e => {

    e.preventDefault()

    const confirm = await Swal.fire({
        icon: 'warning',
        title: "Tem certeza que deseja excluir esse cadastro?",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar",
    })

    if (!confirm.isConfirmed)
        return $(this).val('')

    const form = $('#form-exclusao')[0]

    const data = new FormData(form)
    
    const id = $('#id').val()

    const url = `/api/pacientes/${id}`

    const request = await $.ajax({
        url,
        data,
        type : 'POST',
        processData: false,
        contentType: false,
    });

    if (!request?.success) {
        return Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: request.message,
        })
    }

    await Swal.fire({
        icon: 'success',
        title: 'Excluído com sucesso!',
        timer: 1500,
        showConfirmButton: false,
        timerProgressBar: true,
    })

    window.location.href = '/pacientes'


}

$('#btn-exclusao').click(excluir)