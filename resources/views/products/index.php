<div class="d-flex justify-content-between align-items-center">
    <h2>Lista de produtos</h2>
    <a class="btn btn-montink" href="<?= Router::baseUrl('/produtos/criar') ?>">Criar produto</a>
</div>
<div class="table-responsive">
    <table class="table table-hover table-dark align-middle text-white-50">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" width="150px">Preço</th>
                <th scope="col" width="150px">Estoque</th>
                <th scope="col" width="150px">Variações</th>
                <th scope="col" width="1%">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
            ?>
                    <tr id="row-product-<?= $product['id'] ?>">
                        <td><?= $product['name'] ?></td>
                        <td>R$ <?= Helpers::convertToReal($product['price']) ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['quantityVariations'] ?></td>
                        <td class="d-flex gap-1">
                            <a class="btn btn-sm btn-outline-warning" href="<?= Router::baseUrl('/produtos/' . $product['id']) ?>"><i class="bi bi-pencil-fill"></i></a>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal<?= $product['id'] ?>"><i class="bi bi-trash-fill"></i></button>
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
                                                Você tem certeza de que deseja excluir o produto <strong><?= $product['name'] ?></strong>? Esta ação não pode ser desfeita.
                                            </p>
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="button" class="btn btn-montink" data-bs-dismiss="modal">Fechar</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteProduct(<?= $product['id'] ?>)">Deletar</button>
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