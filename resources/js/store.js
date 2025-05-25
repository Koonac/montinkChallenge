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
                throw new Error('Erro na requisição: ' + response.status);
            }
            return response.json();
        });
}

function addCart(productId){
    var dadosJson = document.getElementById('json-product-' + productId).value;

    fetchCart('/adicionar', 'POST', JSON.parse(dadosJson))
        .then(data => {
            if (data.status) {
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
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
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}

function updateQuantityCart(productId){
    var quantityCart = document.getElementById('quantity-cart-' + productId).value

    const body = {
        productId: productId,
        quantityCart: quantityCart
    }

    fetchCart('/atualizar_quantidade', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}

function decrementQuantityCart(productId){
    var quantityCart = document.getElementById('quantity-cart-' + productId).value

    const body = {
        productId: productId,
        quantityCart: Number(quantityCart) - 1 
    }

    fetchCart('/atualizar_quantidade', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}

function incrementQuantityCart(productId){
    var quantityCart = document.getElementById('quantity-cart-' + productId).value

    const body = {
        productId: productId,
        quantityCart: Number(quantityCart) + 1 
    }

    fetchCart('/atualizar_quantidade', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}

function clearCart(){

    fetchCart('/limpar', 'POST')
        .then(data => {
            if (data.status) {
                alert('Produto adicionado!');
                // opcional: atualizar contador do carrinho
            } else {
                alert('Erro: ' + (data.erro || 'Desconhecido'));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', erro);
            alert('Falha de comunicação com o servidor.');
        });
}