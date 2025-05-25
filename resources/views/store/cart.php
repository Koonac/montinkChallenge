<h1>Carrinho</h1>

<?php
print_r($totalCart);

if (!empty($productsCart)) {
    foreach ($productsCart as $product) {
?>
        <div class="d-flex gap-2">
            <?= print_r($product); ?>
            <input type="number" id="quantity-cart-<?= $product['id'] ?>" class="form-control" value="<?= $product['quantityCart'] ?>" onchange="updateQuantityCart(<?= $product['id'] ?>)">
            <button type="button" class="btn btn-danger padding-2" onclick="decrementQuantityCart(<?= $product['id'] ?>)">-</button>
            <button type="button" class="btn btn-success padding-2" onclick="incrementQuantityCart(<?= $product['id'] ?>)">+</button>
            <button type="button" class="btn btn-danger" onclick="removeCart(<?= $product['id'] ?>)"><i class="bi bi-trash-fill"></i></button>
        </div>
<?php
        print '<br>';
    }
}
?>
<button type="button" class="btn btn-warning" onclick="clearCart()">Limpar carrinho</button>
<form action="<?= Router::baseUrl('/pedidos/comprar') ?>" method="post">
    <input type="text" name="clientName" class="form-control" placeholder="Nome">
    <input type="text" name="clientPhone" class="form-control" placeholder="Telefone">
    <button class="btn btn-success">Comprar</button>
</form>