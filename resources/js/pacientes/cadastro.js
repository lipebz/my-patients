$(() => {
    initMask()
})

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

const cadastrar = async e => {

    e.preventDefault()

    if ($('#input-foto').val() == '')
        return Swal.fire({
            icon: 'warning',
            title: 'Faça o envio da foto para prosseguir.',
            timer: 1500,
            showConfirmButton: false,
            timerProgressBar: true,
        })

    const form = $('#form-cadastro')[0]

    const data = new FormData(form)

    const url = '/api/pacientes'

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

$('#form-cadastro').submit(cadastrar)

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