$(() => {
    getPacientes()
})

const getPacientes = async (page = 1) => {

    $('.container-body-results').addClass('hidden')
    $('#nav-pagination').addClass('hidden')
    $('.container-body-results-loading').removeClass('hidden')

    const search = $('#input-search-pacientes').val().split(' ').join('+')
  
    const url = '/api/pacientes'

    const data = {
        page,
        search
    }

    const request = await $.get(url, data);

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

    renderPacientes(response)
    
}

const renderPacientes = res => {

    const container = $('#container-listagem')

    container.empty()

    const { data } = res

    // renderiza resultados
    data.forEach(value => {

        const html = `
            <li class="hover:bg-gray-100 ">
                <a class="py-3 sm:py-4 inline-block w-full" href="${$('#route-detalhes').val()}">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 ms-2">
                            <img class="w-8 h-8 rounded-full" src="${value.foto_url ?? 'https://thispersondoesnotexist.com'}" alt="Neil image">
                        </div>
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                ${value.nome}
                            </p>
                            <p class="text-gray-500 truncate dark:text-gray-400" style="font-size: 13px">
                            ${value.idade} anos - ${value.endereco?.cidade}, ${value.endereco?.uf}
                            </p>
                        </div>
                        <div class="inline-flex justify-center items-end flex-col text-sm font-semibold text-gray-900 dark:text-white">
                            <div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">CPF ${value.cpf_formatado}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        `

        container.append(html)

    })

    // Contador
    $('.count-pacientes').text(res.total + ` registro${res.total != 1 ? 's' : ''} encontrado${res.total != 1 ? 's' : ''}`)

    // Paginacao
    renderPaginacao(res)
    


    // Loading

    $('.container-body-results').removeClass('hidden')
    $('#nav-pagination').removeClass('hidden')
    $('.container-body-results-loading').addClass('hidden')



}

const renderPaginacao = res => {

    const container = $('#nav-pagination ul')

    // Prev
    container.html(`
        <li>
            <a href="Javascript:;" data-page="${res.current_page - 1}" class="btn-page flex items-center ${res.current_page == 1 ? 'opacity-70 pointer-events-none' : ''} justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">Previous</span>
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
            </a>
        </li>
    `)

    // Pages
    res.links.forEach(elm => {
        if (isNaN(elm.label))
            return
        
            
            // z-10 
        const classActive = `text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white`

        const classComum = `text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white` 

        const classButton = elm.active ? classActive : classComum

        container.append(`
            <li>
                <a href="Javascript:;" data-page="${elm.label}" class="btn-page flex items-center justify-center px-3 h-8 leading-tight ${classButton}">${elm.label}</a>
            </li>
        `)

    })

    // Next
    container.append(`
    <li>
        <a href="Javascript:;" data-page="${res.current_page + 1}" class="btn-page flex ${res.current_page == res.last_page ? 'opacity-70 pointer-events-none' : ''} items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Next</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
        </a>
    </li>
    `)
    
}

$(document).on('click', '.btn-page', function() {
    
    const page = $(this).data('page')

    getPacientes(page)
})

$('#input-search-pacientes').on('keyup', delay(e => {
    
    getPacientes()

}, 200))

$('#input-search-pacientes').on('keyup', e => {
    
    if (e.which == 13)
        getPacientes()

})

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}