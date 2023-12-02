const btnInterruptor = document.getElementById('btn-interruptor');
const valorAnual = document.querySelectorAll(".anual");
const valorMensal = document.querySelectorAll(".mensal");

btnInterruptor.addEventListener('change', function(){
    if(this.checked) {
        valorMensal.forEach(element => {
            element.classList.remove('esconder');
        });
        valorAnual.forEach(element => {
            element.classList.add('esconder');
        });
    } else {
        valorMensal.forEach(element => {
            element.classList.add('esconder');
        });
        valorAnual.forEach(element => {
            element.classList.remove('esconder');
        });
    }
});