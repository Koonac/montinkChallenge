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

    // Evento click para preenchimento de uma nova variação
    document.getElementById('product-new-variation').addEventListener('click', () => {
        addInputVariation('variation-container')
    });
});

function deleteProduct(productId){
    fetch('http://localhost/montinkChallenge/produtos/' + productId, {
        method: 'DELETE',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Recurso deletado com sucesso:', data);
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}

function deleteVariation(variationId){
    fetch('http://localhost/montinkChallenge/variacao/' + variationId, {
        method: 'DELETE',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log(data);

        // REMOVENDO DIV
        document.getElementById('div-variation-' + variationId).remove();
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}
