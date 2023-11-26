function atualizarInputHidden() {
    var selectElement = document.getElementById('selectCliente');
    var hiddenInput = document.getElementById('idClienteInput');

    // Obter o valor da opção selecionada e atribuir ao input hidden
    hiddenInput.value = selectElement.value;
}

/* document.addEventListener('DOMContentLoaded', function () {
    // Elementos do DOM
    const checkboxes = document.querySelectorAll('.form-check-input.add');
    
    checkboxes.forEach(function (checkbox) {
        const quantidadeInput = checkbox.parentElement.nextElementSibling.querySelector('.form-control.quantidade');
        const descontoInput = quantidadeInput.parentElement.nextElementSibling.querySelector('.form-control.desconto');

        // Habilitar/desabilitar inputs com base no estado do checkbox
        checkbox.addEventListener('change', function () {
            quantidadeInput.disabled = !checkbox.checked;
            descontoInput.disabled = !checkbox.checked;
        });

        // Adicionar máscara ao campo de desconto
        descontoInput.addEventListener('input', function () {
            let valor = descontoInput.value.replace(/[^\d]/g, '');
            
            if (valor.length > 0) {
                valor = parseFloat(valor);
                valor = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }

            descontoInput.value = valor;
        });
    });
}); */
document.addEventListener('DOMContentLoaded', function () {


    const form = document.querySelector('form');

        // Adicione um ouvinte de evento para o envio do formulário
        form.addEventListener('submit', function (event) {
            // Verifique se pelo menos um checkbox está marcado
            const checkboxes = document.querySelectorAll('.add');
            let peloMenosUmSelecionado = false;

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    peloMenosUmSelecionado = true;
                }
            });

            // Se nenhum checkbox estiver marcado, impeça o envio do formulário
            if (!peloMenosUmSelecionado) {
                alert('Selecione pelo menos um produto antes de finalizar a compra.');
                event.preventDefault(); // Impede o envio do formulário
            }
        });


    // Função para adicionar máscara de moeda
    function formatarMoeda(valor) {
        if (valor.length > 0) {
            valor = parseFloat(valor);
            valor = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }
        return valor;
    }

    // Função para tratar os eventos
    function configurarEventos(checkbox, quantidadeInput, descontoInput) {
        // Habilitar/desabilitar inputs com base no estado do checkbox
        checkbox.addEventListener('change', function () {
            quantidadeInput.disabled = !checkbox.checked;
            descontoInput.disabled = !checkbox.checked;
        });

        // Adicionar máscara ao campo de desconto
        /* descontoInput.addEventListener('input', function () {
            let valor = descontoInput.value.replace(/[^\d]/g, '');
            descontoInput.value = formatarMoeda(valor);
        }); */
    }

    // Selecionar todos os conjuntos de campos
    const checkboxes = document.querySelectorAll('.add');
    
    // Iterar sobre cada conjunto e configurar os eventos
    checkboxes.forEach(function (checkbox) {
        const quantidadeInput = checkbox.parentElement.nextElementSibling.querySelector('.form-control.quantidade');
        const descontoInput = quantidadeInput.parentElement.nextElementSibling.querySelector('.form-control.desconto');

        configurarEventos(checkbox, quantidadeInput, descontoInput);
    });
});