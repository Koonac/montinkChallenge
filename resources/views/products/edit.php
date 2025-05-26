<h2>Alterando produto</h2>

<form class="row g-2" action="<?= Router::baseUrl('/produtos/' . $product['id'] . '/atualizar') ?>" method="post">
    <div class="col-md-8">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>">
    </div>
    <div class="<?= (!empty($product['variations'])) ? 'col-md-4' : 'col-md-2' ?>">
        <label for="price" class="form-label">Preço R$</label>
        <input type="text" class="form-control mask-money" id="price" name="price" value="<?= Helpers::convertToReal($product['price']) ?>">
    </div>
    <div class="col-md-2 <?= (!empty($product['variations'])) ? 'd-none' : '' ?>">
        <label for="quantity" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $product['quantity'] ?>">
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Descrição</label>
        <textarea type="text" class="form-control" id="description" name="description" rows="3"><?= $product['description'] ?></textarea>
    </div>
    <div class="col-12">
        <fieldset>
            <legend>Variações</legend>
            <div class="w-100">
                <div class="d-flex align-items-end gap-2">
                    <div>
                        <button type="button" class="btn btn-montink" id="product-new-variation"><i class="bi bi-plus-circle"></i></button>
                    </div>
                    <div id="variation-container" class="d-flex flex-column gap-2 w-100">
                        <?php
                        if (!empty($product['variations'])) {
                            foreach ($product['variations'] as $variation) {
                        ?>
                                <div class="d-flex gap-2" id="row-variation-<?= $variation['id'] ?>">
                                    <input type="text" class="form-control" name="variations_edit[<?= $variation['id'] ?>]" value="<?= $variation['name'] ?>" placeholder="Nome da variação">
                                    <input type="text" class="form-control mask-money" name="variations_price[<?= $variation['id'] ?>]" value="<?= Helpers::convertToReal($variation['price']) ?>">
                                    <input type="number" class="form-control" name="variations_stock[<?= $variation['id'] ?>]" value="<?= $variation['quantity'] ?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal<?= $variation['id'] ?>"><i class=" bi bi-trash-fill"></i></button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="confirmationModal<?= $variation['id'] ?>" tabindex="-1" aria-labelledby="confirmationModalLabel<?= $variation['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="confirmationModalLabel<?= $variation['id'] ?>">Confirmação</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-column">
                                                    <p>
                                                        Você tem certeza de que deseja excluir a variação <strong><?= $variation['name'] ?></strong>? Esta ação não pode ser desfeita.
                                                    </p>
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-montink" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteVariation(<?= $variation['id'] ?>)">Deletar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <input type="text" class="form-control" name="variations[]" placeholder="Nome da variação">
                        <?php
                        }
                        ?>
                    </div>
                </div>
        </fieldset>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-montink">Atualizar</button>
    </div>
</form>