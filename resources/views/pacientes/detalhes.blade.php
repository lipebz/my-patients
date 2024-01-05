<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
        @vite('resources/js/datepicker.js')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script> --}}

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script> --}}

        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-start py-14 min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                        

            <div class="w-full max-w-screen-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-10">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Informações do Paciente <span class=" font-normal text-gray-400">#{{$id}}</span></h5>
                    <a href="{{route('pacientes.listagem')}}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        Meus Pacientes
                    </a>
                </div>
                

                                
                <div class="content">

                    
                    <div class="grid gap-6 mb-6 md:grid-cols-6">
                        <div class="col-span-2">
                            <img class=" rounded-full w-52 h-w-52" src="https://thispersondoesnotexist.com" alt="image description">
                        </div>
                        <div class="col-span-4">
                            <div class="grid gap-6 md:grid-cols-6">
                                <div class="col-span-6">

                                    <p class="text-3xl font-bold leading-none flex justify-between items-center tracking-tight text-gray-900  dark:text-white">Filipe Vitorio Soares Bezerra
                                        <a href="{{route('pacientes.edicao', $id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-pen"></i></a>


                                    </p>
                                    <small><span class="text-xl whitespace-nowrap">23 anos <span class="text-gray-500">(12/02/2001)</span></span></small>
                                    
                                </div>
                                
                                <div class="col-span-6">

                                    <label for="first_name" class="block text-sm font-bold text-gray-900 dark:text-white">Documentos</label>
                                    <p><strong>CPF</strong>: 393.521.388-30 &nbsp;&nbsp; <strong>CNS</strong>: 18084081326-4555</p>
                                </div>
                                <div class="col-span-6">

                                    <label for="first_name" class="block text-sm font-bold text-gray-900 dark:text-white">Mãe</label>
                                    <p>Marcia Regina Soares de Souza Bezerra</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    
    
                    <p class="mb-2 text-lg font-bold leading-none tracking-tight text-gray-900  dark:text-white">Endereço Residencial</p>
                    <p>Rua Mirassol, 165 - Vila Gepina, Itaquaquecetuba SP</p>


                </div>


                    


                
            </div>
        </div>
    </body>
</html>
