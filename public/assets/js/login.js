const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const signUpButton1 = document.getElementById('signUp2');
const signInButton1 = document.getElementById('signIn2');
const container = document.getElementById('container');


signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

signUpButton1.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton1.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

document.addEventListener('DOMContentLoaded', function() {
    const acao = localStorage.getItem('acao');

    if (acao === 'alterarClasse1') {
        container.classList.add("right-panel-active");
    } else if (acao === 'alterarClasse2') {
        container.classList.remove("right-panel-active");
    }
});