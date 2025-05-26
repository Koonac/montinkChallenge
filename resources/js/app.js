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

const formatToReal = valor => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valor / 100);
};
