import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const btnDeletes = document.querySelectorAll('.ms-btn');
console.log(btnDeletes);


const btnForm = document.getElementById('button-submit');

const errorCheckbox = document.querySelector('.error-field');


// Sezione per la cancellazione di un prodotto
console.log(btnDeletes);
btnDeletes.forEach((btn) => 
    btn.addEventListener('click', (event) => {
        event.preventDefault();
        const productName = btn.getAttribute('data-product-name');
        document.getElementById('deleteModalText').textContent = `Sei sicuro di voler eliminare il prodotto ${productName}?`;
        const modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );
        modal.show();
        document.getElementById('delete-modal-btn').addEventListener('click', () => {
            btn.parentElement.submit();
        })
    })
);

if(btnForm) {

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
} 
    
