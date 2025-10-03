export async function removeFormatCnpj(cnpj) { 
    return parseInt(cnpj.replace(/\D/g, ''));
}

export async function formatCnpj(cnpj) {
    return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
}