document.addEventListener('DOMContentLoaded', function () {
    function addInputVariation(containerId) {
        const container = document.getElementById(containerId);
    
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.name = 'variations[]';
        input.placeholder = 'Nome da variação';

        container.appendChild(input);
    }

    // ANALISANDO CLIQUE NO BOTÃO
    document.getElementById('product-new-variation').addEventListener('click', () => {
        addInputVariation('variation-container')
    });
});
