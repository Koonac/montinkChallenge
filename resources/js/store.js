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
    var product = JSON.parse(dadosJson.value);
    var quantityCart = document.getElementById('quantity-cart-' + productId);
    var textQuantityAvailable = document.getElementById('quantity-available-' + productId);

    const body = {
        product: product,
        quantityCart: quantityCart.value
    }

    const quantityAvailable = Math.max(0, product.quantity - quantityCart.value)

    fetchCart('/adicionar', 'POST', body)
        .then(data => {
            if (data.status) {
                alert('Produto adicionado ao carrinho!');
                textQuantityAvailable.innerHTML = 'Disponível: ' + quantityAvailable;
                quantityCart.value = 1;
            } else {
                alert(data.message);
                console.error('Erro na API:', JSON.stringify(data));
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
                document.getElementById('row-product-cart-' + productId).remove()
                alert('Produto removido!');
            } else {
                alert(data.message);
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
                alert(data.message);
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
                alert(data.error);
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
                const tbody = document.querySelector('#table-products-cart tbody');
                while (tbody.rows.length > 0) {
                    tbody.deleteRow(0);
                }
                alert('Todos os produtos do carrinho foram removidos.');
            } else {
                alert(data.message);
                console.error('Erro na API:', JSON.stringify(data));
            }
        })
        .catch(erro => {
            console.error('Erro na API:', JSON.stringify(erro));
            alert('Falha de comunicação com o servidor.');
        });
}