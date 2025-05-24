function addCart(productId){
    var dadosJson = document.getElementById('json-product-' + productId).value;

    fetch('http://localhost/montinkChallenge/carrinho/adicionar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: dadosJson
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.status) {
            alert('Produto adicionado!');
            // opcional: atualizar contador do carrinho
        } else {
            alert('Erro: ' + (data.erro || 'Desconhecido'));
        }
    });
}