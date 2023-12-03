function atualizarInputHidden() {
    var selectElement = document.getElementById('selectCliente');
    var hiddenInput = document.getElementById('idClienteInput');

    // Obter o valor da opção selecionada e atribuir ao input hidden
    hiddenInput.value = selectElement.value;
}

document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        const checkboxes = document.querySelectorAll('.add');
        let peloMenosUmSelecionado = false;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                peloMenosUmSelecionado = true;
            }
        });
        if (!peloMenosUmSelecionado) {
            alert('Selecione pelo menos um produto antes de finalizar a compra.');
            event.preventDefault();
        }
    });


    const checkboxes = document.querySelectorAll('.add');
    
    checkboxes.forEach(function (checkbox) {
        checkbox.click();
        checkbox.click();
        const quantidadeInput = checkbox.parentElement.nextElementSibling.querySelector('.form-control.quantidade');
        const descontoInput = quantidadeInput.parentElement.nextElementSibling.querySelector('.form-control.desconto');
    });

    function configurarEventos(checkbox, quantidadeInput, descontoInput) {
        quantidadeInput.disabled = !checkbox.checked;
        descontoInput.disabled = !checkbox.checked;

        checkbox.addEventListener('change', function () {
            quantidadeInput.disabled = !checkbox.checked;
            descontoInput.disabled = !checkbox.checked;
        });
    }
    configurarEventos(checkboxes, quantidadeInput, descontoInput);
});