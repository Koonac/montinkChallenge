async function fetchCart(path, method = 'GET', dados = null) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json'
        }
    };

    if (dados) options.body = JSON.stringify(dados);

    return fetch('http://localhost/montinkChallenge/carrinho' + path, options)
        .then(response => {
            if (!response.ok) {
                console.error(response);
                throw new Error('Erro na requisição: ' + response.status);
            }
            return response.json();
        });
}

function addCart(productId){
    var dadosJson = document.getElementById('json-product-' + productId);
    var quantityCart = document.getElementById('quantity-cart-' + productId);

    const body = {
        product: JSON.parse(dadosJson.value),
        quantityCart: quantityCart.value
    }

    fetchCart('/adicionar', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto adicionado ao carrinho!');
                quantityCart.value = 1;
            } else {
                alert('Ocorreu um erro inesperado');
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}

function removeCart(productId){
    const body = {
        productId: productId
    }

    fetchCart('/remover', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto removido!');
            } else {
                alert('Ocorreu um erro inesperado');
                console.error('Erro na API:', JSON.stringify(data));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', JSON.stringify(erro.message));
            alert('Falha de comunicação com o servidor.');
        });
}

function decrementQuantityCart(productId){
    const body = {
        productId: productId,
    }

    fetchCart('/decrementa', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Quantidade decrementada com sucesso');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Ocorreu um erro inesperado');
                console.error('Erro na API:', JSON.stringify(data));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', JSON.stringify(erro));
            alert('Falha de comunicação com o servidor.');
        });
}

function incrementQuantityCart(productId){

    const body = {
        productId: productId,
    }

    fetchCart('/incrementa', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Quantidade incrementada com sucesso');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Ocorreu um erro inesperado');
                console.error('Erro na API:', JSON.stringify(data));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', JSON.stringify(erro));
            alert('Falha de comunicação com o servidor.');
        });
}

function clearCart(){

    fetchCart('/limpar', 'POST')
        .then(data => {
            if (data.status) {
                alert('Todos os produtos do carrinho foram removidos.');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Ocorreu um erro inesperado');
                console.error('Erro na API:', JSON.stringify(data));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', JSON.stringify(erro));
            alert('Falha de comunicação com o servidor.');
        });
}