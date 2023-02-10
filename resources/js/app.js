import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const btnForm = document.getElementById('button-submit');

const errorCheckbox = document.querySelector('.error-field');

btnForm.addEventListener('click', (event)=> {
    event.preventDefault();

    const checkedBox = document.querySelectorAll('input[type="checkbox"]:checked');
    const checkArray = [...checkedBox];
    if (checkArray.length > 0) {
        errorCheckbox.innerHTML = "";
        document.getElementById('register-form').submit();
    } else {
        errorCheckbox.innerHTML = `<span class="text-danger">Devi inserire tutti i campi obbligatori</span>`;
        errorCheckbox.scrollIntoView();
    }
});

