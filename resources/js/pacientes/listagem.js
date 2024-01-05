$(() => {
    getPacientes()
})

const getPacientes = async () => {

    $('.container-body-results').addClass('hidden')
    $('.container-body-results-loading').removeClass('hidden')


    const url = '/api/pacientes'

    const response = await $.get(url);

    if (!response?.success) {
        return Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: response.message,
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
        })
    }

    renderPacientes(response.data)
    
}

const renderPacientes = data => {

    const container = $('#container-listagem')

    container.empty()

    data.forEach(value => {

        const html = `
            <li class="hover:bg-gray-100 ">
                <a class="py-3 sm:py-4 inline-block w-full" href="${$('#route-detalhes').val()}">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 ms-2">
                            <img class="w-8 h-8 rounded-full" src="https://thispersondoesnotexist.com" alt="Neil image">
                        </div>
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                ${value.nome}
                            </p>
                            <p class="text-gray-500 truncate dark:text-gray-400" style="font-size: 13px">
                            ${value.idade} anos - ${value.endereco.cidade}, ${value.endereco.uf}
                            </p>
                        </div>
                        <div class="inline-flex justify-center items-end flex-col text-sm font-semibold text-gray-900 dark:text-white">
                            <div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">CPF ${value.cpf_formatado}</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">CNS ${value.cns_formatado}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        `

        container.append(html)

    })

    $('.count-pacientes').text(data.length)


    $('.container-body-results').removeClass('hidden')
    $('.container-body-results-loading').addClass('hidden')



}