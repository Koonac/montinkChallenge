const moneyInputs = document.querySelectorAll('.mask-money');
moneyInputs.forEach(input => {
    IMask(input, {
        mask: 'R$ num',
        blocks: {
        num: {
            mask: Number,
            thousandsSeparator: '.',
            radix: ',',
            mapToRadix: ['.']
        }
        }
    });
});

const cepInputs = document.querySelectorAll('.mask-cep');
cepInputs.forEach(input => {
    IMask(input, {
        mask: '00000-000'
    });
});

const formatToReal = valor => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valor / 100);
};
