$(() => {
    getImportacoes()
})

const getImportacoes = async () => {

    $('.container-registros').addClass('hidden')
    $('.container-loading').removeClass('hidden')

    const url = '/api/importacoes'

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

    renderImportacoes(response)
    
}

const renderImportacoes = data => {

    const container = $('#table-importacoes tbody')

    container.empty()



    // renderiza resultados
    data.forEach(value => {

        let status = `<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Finalizado</span>`

        if (value.status == 'Em processamento') {
            status = `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">${value.status}</span>`
        } else if (value.status == 'Aguardando validação') {
            status = `<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Aguardando validação</span>`
        }


        let buttons = ''

        if (value.status == 'Aguardando validação')
            buttons += `<button type="button" data-id="${value.id}" class="btn-abrir-modal-validacao text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                <i class="fa-solid fa-file-import"></i>
            </button>`

        buttons +=  `<a href="${value.path}" download="importacao-${value.created_at}.csv" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
            <i class="fa-solid fa-download"></i>
        </a>`


        const html = `
            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    ${value.tempo}
                </td>
                <td class="px-6 py-4">
                    ${value.quantidade ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${status}
                </td>
                <td class="px-6 py-4 text-end">
                    ${buttons}
                </td>
            </tr>
        `

        container.append(html)

    })

    if (data.length == 0) {
        container.html(`
            <tr><td class="p-4 text-center" colspan="4">Nenhum registro encontrado</td></tr>
        `)

    }

    // Loading

    $('.container-registros').removeClass('hidden')
    $('.container-loading').addClass('hidden')



}

// Importação

const importarCSV = async function() {

    const confirm = await Swal.fire({
        icon: 'warning',
        title: "Tem certeza que deseja continuar?",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar",
    })

    if (!confirm.isConfirmed)
        return $(this).val('')
    
    Swal.fire({
        title: "Aguarde...",
        html: "Seu arquivo está sendo processado",
        
        didOpen: () => {
            Swal.showLoading();
        }
    })


    const form = $('#form-importar')[0]

    const data = new FormData(form)

    const url = '/api/importacoes'

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
        title: 'Importado com sucesso!',
        timer: 1500,
        showConfirmButton: false,
        timerProgressBar: true,
    })

    window.location.reload()

}

$('#input-csv').change(importarCSV)

// Validação

var validacoes = []

const getInfoImportacao = async function({ target }) {

    const id = $(target).closest('button').data('id')

    // $('.container-registros').addClass('hidden')
    // $('.container-loading').removeClass('hidden')

    const url = `/api/importacoes/${id}`

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

    validacoes = request.data.data

    renderInfoImportacao(request.data)
    

}

const renderInfoImportacao = (res) => {

    (new Modal($('#extralarge-modal')[0])).show();

    const container = $('#table-info-importacao tbody')

    container.empty()

    validacoes.forEach((value, key) => {
       container.append(`
            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        
                <td class="px-6 py-4 text-center sticky left-0 bg-white">
                    <button type="button" data-index="${key}" class="btn-remover-validacao font-medium text-red-600 dark:text-red-500 hover:underline">Remover</button>
                </td>
                <th scope="row" class="px-6 py-4 text-center sticky left-0 bg-white font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    ${value.nome ?? '-'}
                </th>
                <td class="px-6 py-4">
                    ${value.data_nascimento_formatada ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.cpf_formatado ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.cns_formatado ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.mae ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.cep_formatado ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.logradouro ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.numero ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.complemento ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.bairro ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.cidade ?? '-'}
                </td>
                <td class="px-6 py-4">
                    ${value.uf ?? '-'}
                </td>
            </tr>
       `) 
    })

    $('#btn-validar').attr('data-id', res.id)

    let total = validacoes.length

    $('.count-validacao').text(total + ` registro${total != 1 ? 's' : ''} encontrado${total != 1 ? 's' : ''}`)



}

const removerValidacao = (e) => {

    const index = $(e.target).data('index')

    validacoes.splice(index, 1)

    renderInfoImportacao()


}

$(document).on('click', '.btn-abrir-modal-validacao', getInfoImportacao)
$(document).on('click', '.btn-remover-validacao', removerValidacao)

const validar = async ({ target }) => {

    const id = $(target).data('id')


    const form = $('#form-validacao')[0]

    const data = new FormData(form)

    
    validacoes.forEach((value, key) => {
        data.append(`pacientes[${key}][nome]`, value.nome)
        data.append(`pacientes[${key}][data_nascimento]`, value.data_nascimento)
        data.append(`pacientes[${key}][mae]`, value.mae)
        data.append(`pacientes[${key}][cpf]`, value.cpf)
        data.append(`pacientes[${key}][cns]`, value.cns)
        data.append(`pacientes[${key}][cep]`, value.cep)
        data.append(`pacientes[${key}][logradouro]`, value.logradouro)
        data.append(`pacientes[${key}][numero]`, value.numero)
        data.append(`pacientes[${key}][complemento]`, value.complemento)
        data.append(`pacientes[${key}][bairro]`, value.bairro)
        data.append(`pacientes[${key}][cidade]`, value.cidade)
        data.append(`pacientes[${key}][uf]`, value.uf)
    })



    const url = `/api/importacoes/${id}/efetivar-importacao`

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

$('#btn-validar').click(validar)