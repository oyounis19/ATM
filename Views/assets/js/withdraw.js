let withdrawBTNs = document.getElementsByClassName("withdrawBTN")
let inputAmount = document.getElementById("Amount")


for (let i = 0; i < withdrawBTNs.length; i++) {
    withdrawBTNs[i].addEventListener("click", (e) => {
        inputAmount.value = ""
        inputAmount.value = e.target.value
    })
}

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