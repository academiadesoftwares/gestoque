// Importação do seu bootstrap.js (axios, SweetAlert, Chart.js)
import "./bootstrap";

// jQuery - deve vir antes do DataTables
import $ from "jquery";
window.$ = window.jQuery = $;

// Bootstrap JS
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

// DataTables (deve vir **após o jQuery**)
import "datatables.net";
import "datatables.net-bs5";

//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Inicializar DataTables após o carregamento do DOM
document.addEventListener("DOMContentLoaded", function () {
    if ($.fn.DataTable) {
        $(".datatable").DataTable({
            language: {
                info: "Mostrando _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Nenhum registro disponível",
                infoFiltered: "(filtrado de _MAX_ registros totais)",
                lengthMenu: "Mostrar _MENU_ registros por página",
                search: "Pesquisar:",
                zeroRecords: "Nenhum resultado encontrado",
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior",
                },
            },
            responsive: true, // Para melhor exibição em dispositivos móveis
            autoWidth: false, // Evita problemas de largura das colunas
            order: [], // Remove a ordenação automática da primeira coluna´
            columnDefs: [
                { targets: "_all", defaultContent: "-" }, // Evita erro se algum dado estiver faltando
                { targets: "no-sort", orderable: false }, // Classe CSS para desativar a ordenação em colunas específicas
                { targets: "text-start", className: "text-start" }, // Força alinhamento à esquerda onde necessário
            ],
        });
    } else {
        console.error("DataTables não foi carregado corretamente.");
    }
});

/**** Script para abrir/fechar o dropdown ****/
const dropdownButton = document.getElementById("userDropdownButton");
const dropdownContent = document.getElementById("dropdownContent");

dropdownButton.addEventListener("click", function () {
    const isOpen = dropdownContent.classList.contains("hidden");
    if (isOpen) {
        dropdownContent.classList.remove("hidden");
    } else {
        dropdownContent.classList.add("hidden");
    }
});

// Fechar o dropdown se clicar fora dele
window.addEventListener("click", function (event) {
    if (
        !dropdownButton.contains(event.target) &&
        !dropdownContent.contains(event.target)
    ) {
        dropdownContent.classList.add("hidden");
    }
});

/**** Apresentar e ocultar sidebar ****/
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("sidebar-open");
});

document.getElementById("closeSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.remove("sidebar-open");
});

/**** Alterna entre tema claro e escuro ****/
document.addEventListener("DOMContentLoaded", function () {
    // Obter o elemento <html> para manipular a classe dark
    const htmlElement = document.documentElement;

    // Obter o id do botão tema claro e escuro
    const themeToggle = document.getElementById("themeToggle");

    // Obter o id do ícone escuro
    const iconMoon = document.getElementById("iconMoon");

    // Obter o id do ícone claro
    const iconSun = document.getElementById("iconSun");

    // Função para alternar os ícones claro e escuro
    function updateIcons() {
        if (htmlElement.classList.contains("dark")) {
            iconMoon.classList.remove("hidden");
            iconSun.classList.add("hidden");
        } else {
            iconMoon.classList.add("hidden");
            iconSun.classList.remove("hidden");
        }
    }

    // Aplicar o tema salvo no localStorage ou a preferência do sistema
    const isDarkMode =
        localStorage.theme === "dark" || // Se o localStorage.theme for "dark", ativa o modo escuro
        (!("theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches);
    // Se NÃO houver um tema salvo no localStorage, verifica se o sistema está em dark mode

    htmlElement.classList.toggle("dark", isDarkMode);
    updateIcons(); // Atualiza os ícones na inicialização

    // Evento de clique para alternar o tema e os ícones
    themeToggle.addEventListener("click", function () {
        htmlElement.classList.toggle("dark");
        localStorage.theme = htmlElement.classList.contains("dark")
            ? "dark"
            : "light";
        updateIcons(); // Atualiza os ícones após alterar o tema
    });
});

// Função para apresentar o SweetAlert2 para confirmar a exclusão
window.confirmDelete = function (id) {
    Swal.fire({
        title: "Tem certeza?",
        text: "Essa ação não pode ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};

/****** Academia de softwares estilo******/
document.addEventListener("DOMContentLoaded", () => {
    // Todos os botões que controlam dropdowns
    const dropdownToggles = document.querySelectorAll("[data-dropdown-toggle]");

    dropdownToggles.forEach((button) => {
        const targetId = button.getAttribute("data-dropdown-toggle");
        const dropdown = document.getElementById(targetId);
        const icon = button.querySelector("svg");

        button.addEventListener("click", (e) => {
            e.preventDefault();

            // Alternar a visibilidade do dropdown
            dropdown.classList.toggle("hidden");

            // Rotacionar ícone
            icon.classList.toggle("rotate-180");
        });

        // Fechar ao clicar fora
        document.addEventListener("click", (e) => {
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
                icon.classList.remove("rotate-180");
            }
        });
    });
});
