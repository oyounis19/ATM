const withdrawButtons = document.querySelectorAll('.withdrawBTN');
const amountInput = document.querySelector('#Amount');

withdrawButtons.forEach(button => {
    button.addEventListener('click', () => {
      amountInput.value = button.getAttribute('value');
    });
  });

inputAmount.addEventListener('keydown', (event) => {
    // Allow: backspace, delete, tab, escape, enter and .
    if (event.key === 'Backspace' || event.key === 'Delete' || event.key === 'Tab' || event.key === 'Escape' || event.key === 'Enter') {
        return;
    }

    // Allow only numeric keys
    if (!/[0-9]/.test(event.key)) {
        event.preventDefault();
    }
});