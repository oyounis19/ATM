const depositForm = document.querySelector('#depositForm');
const amount = document.querySelector('#Amount');
const verifyingCashDiv = document.querySelector('.verifyingCash');

depositForm.addEventListener('submit', (e) => {//Waits 5 seconds before submitting form to show "veryfing cash"
    e.preventDefault();
    verifyingCashDiv.style.display = 'block';
    document.querySelector('.loading').style.display = 'inline-block';
    setTimeout(() => {
        verifyingCashDiv.style.display = 'none';
        document.querySelector('.loading').style.display = 'none';

        //SWEET ALERTS//
        depositForm.submit();
    }, 5000); // 5 seconds
});


amount.addEventListener('keydown', (event) => {
    // Allow: backspace, delete, tab, escape, enter and .
    if (event.key === 'Backspace' || event.key === 'Delete' || event.key === 'Tab' || event.key === 'Escape' || event.key === 'Enter') {
        return;
    }

    // Allow only numeric keys
    if (!/[0-9]/.test(event.key)) {
        event.preventDefault();
    }
});