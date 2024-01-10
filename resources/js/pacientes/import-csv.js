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
                    ${value.quantidade}
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


const abrirModalValidacao = function() {

    console.log($(this).data('id'));

    (new Modal($('#extralarge-modal')[0])).show();
}

$(document).on('click', '.btn-abrir-modal-validacao', abrirModalValidacao)
