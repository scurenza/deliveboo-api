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
const vatInput = document.getElementById('VAT');
const requiredInput = document.querySelectorAll('.ms_form');
const passwordRegister = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');




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

btnForm.addEventListener('click', (event)=> {


    event.preventDefault();
    const vatValue = vatInput.value;
    const checkedBox = document.querySelectorAll('input[type="checkbox"]:checked');
    const checkArray = [...checkedBox];
    const arrayReq = [...requiredInput];
    const valuePassword = passwordRegister.value;
    const valuePasswordConfrim = passwordConfirm.value;
    
    // input password
    if(!valuePassword && !valuePasswordConfrim){
        passwordRegister.classList.add('is-invalid');
        passwordConfirm.classList.add('is-invalid');
        const divPassword = document.querySelector(`.${passwordRegister.getAttribute('data-error')}`);
        divPassword.innerHTML = `<p class="text-danger">La password deve essere compilata</p>`;
        document.querySelector(`.${passwordConfirm.getAttribute('data-error')}`).innerHTML = `<p class="text-danger">La conferma password deve essere compilata</p>`;
    
    } else if((valuePassword.length > 0 && valuePasswordConfrim.length > 0) && (valuePassword !== valuePasswordConfrim) ){
        passwordRegister.classList.add('is-invalid');
        passwordConfirm.classList.add('is-invalid');
        document.querySelector(`.${passwordRegister.getAttribute('data-error')}`).innerHTML = '';
        document.querySelector(`.${passwordConfirm.getAttribute('data-error')}`).innerHTML = '';
        document.querySelector('.pass-match').innerHTML = `<p class="text-danger">Le password devono essere uguali</p>`;

    } 
    else if(valuePassword.length === 0){
        passwordRegister.classList.add('is-invalid');
        document.querySelector(`.${passwordRegister.getAttribute('data-error')}`).innerHTML = `<p class="text-danger">Le password deve essere compilata</p>`;
        if(valuePasswordConfrim){
            passwordConfirm.classList.remove('is-invalid');
            document.querySelector(`.${passwordConfirm.getAttribute('data-error')}`).innerHTML = '';
        }
    } else if( valuePasswordConfrim.length === 0){
        passwordConfirm.classList.add('is-invalid');
        document.querySelector(`.${passwordConfirm.getAttribute('data-error')}`).innerHTML = `<p class="text-danger">Le conferma password deve essere compilata</p>`;
        if(valuePassword){
            passwordRegister.classList.remove('is-invalid');
            document.querySelector(`.${passwordRegister.getAttribute('data-error')}`).innerHTML = '';
        }

    }else if((valuePassword.length > 0 && valuePasswordConfrim.length > 0) && (valuePassword === valuePasswordConfrim )) {

        passwordRegister.classList.remove('is-invalid');
        passwordConfirm.classList.remove('is-invalid');
        document.querySelector(`.${passwordRegister.getAttribute('data-error')}`).innerHTML = '';
        document.querySelector(`.${passwordConfirm.getAttribute('data-error')}`).innerHTML = '';
        document.querySelector('.pass-match').innerHTML = '';
        
        const boolCheck = checkArray.length > 0
        const boolInput = arrayReq.every(el=> el.value.length > 0)
    
        if(boolCheck && boolInput){
            document.getElementById('register-form').submit();
        }
        console.log({boolCheck, boolInput});

    }


// input name username email address vat
    
    arrayReq.forEach(el => {
        if(el.value.length === 0){
            el.classList.add('is-invalid');
            // el.insertAdjacentHTML('afterend', `<p class="invalid-feedback"> Questo campo deve essere compilato </p>`)
            const nameDiv = el.getAttribute('data-error');
            document.querySelector(`.${nameDiv}Error`).innerHTML = `<p class="text-danger">Il campo ${el.getAttribute('data-name')} deve essere compilato</p>`;
            
        } else{
            el.classList.remove('is-invalid');
            document.querySelector(`.${el.getAttribute('data-error')}Error`).innerHTML = '';
        }
    })


// input VAT
    if(vatInput.value.length === 0){
        vatInput.classList.add('is-invalid');
        console.log('invalid');
        document.querySelector('.vatError').classList.add('invalid-feedback');
        document.querySelector('.vatError').innerHTML = `<p class="text-danger">Devi inserire p.Iva</p>`;
    }

// input CHECKBOX
    if (checkArray.length > 0) {
        errorCheckbox.innerHTML = "";
    } else {
        errorCheckbox.innerHTML = `<span class="text-danger">Inserisci almeno una tipologia</span>`;
        errorCheckbox.scrollIntoView();
    }
    
});


