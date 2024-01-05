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
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Importar pacientes do arquivo CSV</h5>
                    <div class="flex gap-6">
                        <a href="{{route('pacientes.listagem')}}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Meus Pacientes
                        </a>
                    </div>

                </div>
                
                
                <p class="my-3">1º Modelo CSV</p>
                <button type="button" class="mb-6 text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                    <i class="fa-solid fa-download pe-3"></i> Baixar arquivo 
                </button>

                <p class="my-3">2º Anexar arquivo CSV</p>
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Atenção!</span>
                    <p class="">Certifique-se de ter preenchido corretamente o arquivo csv de modelo.</p>
                </div>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique ou</span> arraste e solte seu arquivo aqui</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Apenas no formato CSV</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div> 

                <br>
                <br>
                <hr>
                <br>
                <br>

                <p class="mb-3">3º Analise e retifique as informações</p>
                
                <div class="grid gap-6 mb-6 md:grid-cols-6">
                    <div class="flex justify-center">
                        <button type="button" class="w-100 text-gray-900 bg-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-span-4">
                        <input type="text" id="disabled-input" aria-label="disabled input" class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="modelo-pacientes-2024-01-05.csv" disabled>
                    </div>
                    <div class="">
                        <button type="button" class="w-100 text-green-900 bg-green-400 hover:bg-green-200 focus:ring-4 focus:outline-none focus:ring-green-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-green-500 me-2">
                            Prosseguir
                        </button>
                    </div>
                </div>

                <p class="my-3 text-gray-500"><strong class="text-black">1</strong> registro encontrado.</p>


                <div class="relative overflow-x-auto border sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 py-3 text-center sticky left-0 bg-white">
                                    -
                                </th>
                                <th scope="col" class="px-6 py-3 text-center sticky left-0 bg-white">
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
                        <tbody>
                            <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                
                                <td class="px-6 py-4 text-center sticky left-0 bg-white">
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remover</a>
                                </td>
                                <th scope="row" class="px-6 py-4 text-center sticky left-0 bg-white font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Filipe Vitorio Soares Bezerra
                                </th>
                                <td class="px-6 py-4">
                                    12/02/2001
                                </td>
                                <td class="px-6 py-4">
                                    393.521.388.30
                                </td>
                                <td class="px-6 py-4">
                                    808151515-5545
                                </td>
                                <td class="px-6 py-4">
                                    Marcia Regina Soares de Souza Bezerra
                                </td>
                                <td class="px-6 py-4">
                                    08577-200
                                </td>
                                <td class="px-6 py-4">
                                    Rua Mirassol
                                </td>
                                <td class="px-6 py-4">
                                    165
                                </td>
                                <td class="px-6 py-4">
                                  -  
                                </td>
                                <td class="px-6 py-4">
                                    Vila Gepina
                                </td>
                                <td class="px-6 py-4">
                                    Itaquaquecetuba
                                </td>
                                <td class="px-6 py-4">
                                    SP
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                
            </div>
        </div>
    </body>
</html>
