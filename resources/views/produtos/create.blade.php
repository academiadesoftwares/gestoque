@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Novo Produto</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="#" class="breadcrumb-link">Produtos</a>
            <span>/</span>
            <span>Produto</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h5 class="content-box-title">cadastrar</h5>

        <div class="content-box-btn">
            @can('index-produto')
            <a href="#" class="btn-info align-icon-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span>Listar</span>
            </a>
            @endcan
        </div>
    </div>

    <x-alert />

    {{-- Abas --}}
    <div class="w-full">
        <div class="flex flex-col md:flex-row gap-4">

            <!-- TABS + CONTEÚDO -->
            <div class="flex-1">
                <!-- Cabeçalho das Tabs -->
                <ul class="flex flex-wrap px-1.5 py-1.5 list-none rounded-md bg-slate-100" role="tablist">
                    <li class="flex-auto text-center">
                        <button class="w-full px-4 py-2 text-sm font-medium text-slate-700 rounded-t-md transition-colors bg-white shadow-sm"
                            data-tab-index="0" role="tab" aria-selected="true">
                            Aba 1
                        </button>
                    </li>
                    <li class="flex-auto text-center">
                        <button class="w-full px-4 py-2 text-sm font-medium text-slate-600 rounded-t-md transition-colors hover:text-slate-700"
                            data-tab-index="1" role="tab" aria-selected="false">
                            Aba 2
                        </button>
                    </li>
                </ul>

                <!-- Conteúdo das Tabs -->
                <div class="relative p-5 bg-white rounded-b-md shadow-sm mt-1 space-y-4" data-tab-content>
                    <!-- Tab 1 -->
                    <div class="tab-panel flex gap-4" data-index="0">
                        <!-- Campos principais (grid 4x1) -->
                        <div class="flex-1 space-y-4">
                            <div class="grid grid-cols-4 gap-4">
                                <div class="mb-4">
                                    <label for="name" class="label-personalized">Designação Produto</label>
                                    <input type="text" placeholder="aba 1 Campo 1" class="form-personalized">
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="label-personalized">Tipo</label>
                                    <input type="text" placeholder="aba 1 Campo 2" class="form-personalized">
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="label-personalized">Marca</label>
                                    <input type="text" placeholder="aba 1 Campo 3" class="form-personalized">
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="label-personalized">Preço</label>
                                    <input type="text" placeholder="aba 1 Campo 4" class="form-personalized">
                                </div>            
                            </div>
                            <!-- Botões -->
                            <div class="flex justify-end mt-4 gap-2">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 next-btn">Próximo</button>
                            </div>
                        </div>

                        <!-- AVATAR / CANTO DIREITO (apenas na primeira aba) -->
                        <div class="w-40 flex flex-col items-center space-y-3">
                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                class="w-36 h-36 rounded-full object-cover shadow-md">
                            <input type="file" class="form-input text-sm text-center">
                            <div class="w-full bg-white shadow rounded p-2 text-center">
                                <a href="#" class="text-blue-600 hover:underline">example.com</a>
                            </div>
                        </div>
                    </div>


                    <!-- Tab 2 -->
                    <div class="tab-panel hidden opacity-0" data-index="1">
                        <div class="grid grid-cols-4 gap-4">
                            <input type="text" placeholder="Aba 2 Outro 1" class="form-input">
                            <input type="text" placeholder="Aba 2 Outro 2" class="form-input">
                            <input type="text" placeholder="Aba 2 Outro 3" class="form-input">
                            <input type="text" placeholder="Aba 2 Outro 4" class="form-input">
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between mt-4">
                            <button class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 prev-btn">Anterior</button>
                            <div class="ml-auto flex gap-2">
                                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Salvar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll('[data-tab-index]');
            const tabPanels = document.querySelectorAll('.tab-panel');

            let currentTab = 0;

            function showTab(index) {
                tabPanels.forEach((panel, i) => {
                    panel.classList.toggle('hidden', i !== index);
                    panel.classList.toggle('opacity-0', i !== index);
                });

                tabs.forEach((tab, i) => {
                    tab.classList.toggle('bg-white', i === index);
                    tab.classList.toggle('shadow-sm', i === index);
                    tab.classList.toggle('text-slate-700', i === index);
                    tab.classList.toggle('text-slate-600', i !== index);
                    tab.setAttribute('aria-selected', i === index ? 'true' : 'false');
                });

                currentTab = index;
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    showTab(parseInt(tab.dataset.tabIndex));
                });
            });

            // Botões Próximo / Anterior
            document.querySelectorAll('.next-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (currentTab < tabPanels.length - 1) showTab(currentTab + 1);
                });
            });

            document.querySelectorAll('.prev-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (currentTab > 0) showTab(currentTab - 1);
                });
            });

            // Inicializa primeira aba
            showTab(0);
        });
    </script>

</div>
@endsection