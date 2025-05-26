<form action="<?= Router::baseUrl('/pedidos/comprar') ?>" method="post">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Carrinho</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-dark align-middle text-white-50" id="table-products-cart">
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col" width="150px">R$ Unitário</th>
                    <th scope="col" width="150px" class="text-center">Quantidade</th>
                    <th scope="col" width="150px">R$ Total</th>
                    <th scope="col" width="1%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($productsCart)) {
                    foreach ($productsCart as $product) {
                ?>
                        <tr id="row-product-cart-<?= $product['id'] ?>">
                            <td><?= empty($product['fullName']) ? $product['name'] : $product['fullName'] ?></td>
                            <td>R$ <?= Helpers::convertToReal($product['price']) ?></td>
                            <td class="text-center"><?= $product['quantityCart'] ?></td>
                            <td>R$ <?= Helpers::convertToReal($product['quantityCart'] * $product['price']) ?></td>
                            <td class="d-flex gap-1">
                                <button type="button" class="btn btn-sm btn-outline-danger padding-2" onclick="decrementQuantityCart(<?= $product['id'] ?>)">-</button>
                                <button type="button" class="btn btn-sm btn-outline-success padding-2" onclick="incrementQuantityCart(<?= $product['id'] ?>)">+</button>
                                <button type="button" class="btn  btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal<?= $product['id'] ?>"><i class="bi bi-trash-fill"></i></button>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmationModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="confirmationModalLabel<?= $product['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="confirmationModalLabel<?= $product['id'] ?>">Confirmação</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex flex-column">
                                                <p>
                                                    Tem certeza de que deseja remover o produto <strong><?= empty($product['fullName']) ? $product['name'] : $product['fullName'] ?></strong> do carrinho?
                                                </p>
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-montink" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="removeCart(<?= $product['id'] ?>)">Deletar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="row g-1">
        <div class="col-md-4">
            <input type="text" name="clientName" class="form-control" placeholder="Nome" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="clientPhone" class="form-control" placeholder="Telefone" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="clientCep" class="form-control" placeholder="Cep" required>
        </div>
    </div>
    <div class="d-flex flex-column pt-2 justify-content-end align-items-end">
        <div class="fs-4">
            <strong>Subtotal:</strong>
            R$ <?= Helpers::convertToReal($totalCart['subTotal']) ?>
        </div>
        <div class="fs-4">
            <strong>Frete:</strong>
            R$ <?= Helpers::convertToReal($totalCart['shippingFee']) ?>
        </div>
        <div class="fs-4">
            <strong>Total:</strong>
            R$ <?= Helpers::convertToReal($totalCart['total']) ?>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-warning" onclick="clearCart()">Limpar carrinho</button>
        <button class="btn btn-montink" <?= (empty($productsCart)) ? 'disabled' : ''; ?>>Finalizar compra</button>
    </div>

</form>