window.onload = function () {
    const inputCPF = document.querySelector(".cpf");

    function formatarCPF () {
        let cpf = inputCPF.value.replace(/\D/g, ""); 
        cpf = cpf.slice(0, 11); 

        if (cpf.length > 3 && cpf.length <= 6) {
            cpf = `${cpf.slice(0, 3)}.${cpf.slice(3)}`;
        } else if (cpf.length > 6 && cpf.length <= 9) {
            cpf = `${cpf.slice(0, 3)}.${cpf.slice(3, 6)}.${cpf.slice(6)}`;
        } else if (cpf.length > 9) {
            cpf = `${cpf.slice(0, 3)}.${cpf.slice(3, 6)}.${cpf.slice(6, 9)}-${cpf.slice(9, 11)}`;
        }

        inputCPF.value = cpf;
    }

    if (inputCPF) {
        inputCPF.addEventListener("input", formatarCPF);
        formatarCPF();
    }
};