<div id="extralarge-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Analise as informações e efetive a importação
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="extralarge-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                
                <p class="my-3 text-gray-500 count-validacao"></p>

                <form action="" id="form-validacao">
                    <div class="relative overflow-x-auto border sm:rounded-lg">
                        <table id="table-info-importacao" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4 py-3 text-center sticky left-0 bg-white">
                                        -
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center sticky left-0 bg-white whitespace-nowrap">
                                        Nome completo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Data de Nascimento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CPF
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CNS
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Mãe
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CEP
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Logradouro
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Número
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Complemento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Bairro
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cidade
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        UF
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        
                    </div>
                </form>




            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" id="btn-validar" class="w-100 text-white bg-green-400 hover:bg-green-200 hover:text-green-800 focus:ring-4 focus:outline-none focus:ring-green-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-green-500 me-2">
                    Efetivar importação
                </button>
                <button data-modal-hide="extralarge-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
            </div>
        </div>
    </div>
</div>