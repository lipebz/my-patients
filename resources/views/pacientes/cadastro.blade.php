<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
        @vite('resources/js/datepicker.js')

        <script src="https://unpkg.com/imask"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-start py-14 min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                        

            <div class="w-full max-w-screen-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-10">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Cadastro de Paciente</h5>
                    <div class="flex gap-6">
                        <a href="{{route('pacientes.listagem')}}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Meus Pacientes
                        </a>
                        <a href="{{route('pacientes.importar-csv')}}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Importar .CSV
                        </a>
                    </div>
                </div>
                

                                
                <form id="form-cadastro">


                    <div class="text-center my-9">
                        <label class="inline-block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto de Perfil</label>

                        <div class="container-upload-input flex items-center justify-center rounded-full mx-auto w-44 h-44">
                            <label for="input-foto" class="flex flex-col items-center justify-center rounded-full w-full h-44 border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique </span> ou arraste e solte.</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">PNG ou JPG</p>
                                </div>
                                <input id="input-foto" name="input-foto" type="file" class="hidden" />
                            </label>
                        </div> 
                        <div class="container-upload-preview relative mx-auto w-44 h-44 hidden">
                            <img class=" rounded-full w-44 h-44" id="img-foto" src="" alt="image description">
                            <label for="input-foto" class="overlay absolute w-44 h-44 rounded-full bg-slate-600 cursor-pointer opacity-0 hover:opacity-80 active:opacity-90 select-none text-white
                             flex justify-center items-center inset-y-0">Alterar</label>
                        </div>
                    </div>
                    
                    <p class="my-4 text-lg font-bold leading-none tracking-tight text-gray-900  dark:text-white">Dados Pessoais</p>

                    <div class="grid gap-6 mb-6 md:grid-cols-6">
                        <div class="col-span-3">
                            <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome completo</label>
                            <input type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        <div class="col-span-3">
                            <label for="mae" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da Mãe</label>
                            <input type="text" id="mae" name="mae" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        <div class="col-span-2">
                            <label for="data_nascimento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Nascimento</label>
                            
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                                </div>
                                <input datepicker required type="text" id="data_nascimento" name="data_nascimento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecione a data">
                            </div>
  
                        </div>  
                        <div class="col-span-2">
                            <label for="cpf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123.456.789-00" required>
                        </div>
                        <div class="col-span-2">
                            <label for="cns" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNS</label>
                            <input type="text" id="cns" name="cns" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="000 1111 2222 3333" required>
                        </div>
                        
                    </div>

                    <p class="mb-4 mt-14 text-lg font-bold leading-none tracking-tight text-gray-900  dark:text-white">Endereço Residencial</p>
                    <div class="grid gap-6 mb-6 md:grid-cols-6">
                        <div class="col-span-1">
                            <label for="cep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                            <input type="text" id="cep" name="cep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="00000-000" required>
                        </div>

                        <div class="col-span-3">
                            <label for="logradouro" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logradouro</label>
                            <input type="text" id="logradouro" name="logradouro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        <div class="col-span-1">
                            <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                            <input type="text" id="numero" name="numero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        <div class="col-span-1">
                            <label for="uf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">UF</label>
                            <select id="uf" name="uf" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected></option>
                                <option value="">Selecione</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                              </select>
                        </div>
                        <div class="col-span-2">
                            <label for="complemento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                        </div>
                        <div class="col-span-2">
                            <label for="bairro" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        <div class="col-span-2">
                            <label for="cidade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                        </div>
                        
                    </div>

                    
                    <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cadastrar</button>
                </form>


                
            </div>
        </div>

        @vite(['resources/js/pacientes/cadastro.js'])

    </body>
</html>
