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
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td>R$ <?= Helpers::convertToReal($product['price']) ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['quantityVariations'] ?></td>
                        <td class="d-flex gap-1">
                            <a class="btn btn-sm btn-outline-warning" href="<?= Router::baseUrl('/produtos/' . $product['id']) ?>"><i class="bi bi-pencil-fill"></i></a>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProduct(<?= $product['id'] ?>)"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>