<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css','resources/js/app.js'])


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-start py-14 min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="w-full max-w-screen-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-8">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Importações CSV de Pacientes</h5>
                    <div class="flex gap-6">
                        <a href="{{route('pacientes.listagem')}}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Meus Pacientes
                        </a>
                    </div>

                </div>


                <div class="flex justify-between mt-4 mb-3">
                    <button type="button" data-modal-target="medium-modal" data-modal-toggle="medium-modal" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        Nova importação
                    </button>
                    <p class="my-3 text-gray-400 text-sm"></p>
                </div>

                <div class="relative overflow-x-auto border sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                
                                <th scope="col" class="px-6 py-3">
                                    Data e Hora
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pacientes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    3 minutos atrás
                                </td>
                                <td class="px-6 py-4">
                                    120
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Em processamento</span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <button type="button" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    12/02/2001 10:12:03
                                </td>
                                <td class="px-6 py-4">
                                    120
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Aguardando validação</span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <button type="button" data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-file-import"></i>
                                    </button>

                                    <button type="button" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    12/02/2001 10:12:03
                                </td>
                                <td class="px-6 py-4">
                                    120
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Finalizado</span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <button type="button" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    12/02/2001 10:12:03
                                </td>
                                <td class="px-6 py-4">
                                    120
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Finalizado</span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <button type="button" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    12/02/2001 10:12:03
                                </td>
                                <td class="px-6 py-4">
                                    120
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Finalizado</span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <button type="button" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('pacientes.modals.importar-arquivo-csv')
        @include('pacientes.modals.validar-arquivo-csv')


        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    </body>
</html>
