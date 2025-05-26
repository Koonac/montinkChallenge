<h1>Venda dos produtos</h1>

<div class="row row-cols-1 row-cols-md-5 row-cols-xxl-6 g-4">
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
    ?>
            <div class="col">
                <div class="card text-bg-dark border-info h-100" style="width: 14rem;">
                    <img src="https://admin.montink.com/aplicativo/data/settings/lumise-media-logo-login-backup-1.png" class="card-img-top p-2" height="150" alt="Montink-Logo">
                    <div class="card-body bg-transparent">
                        <h6 class="card-title"><?= empty($product['fullName']) ? $product['name'] : $product['fullName'] ?></h6>
                        <p class="card-text text-white-50"><?= $product['description'] ?></p>
                    </div>
                    <div class="card-body d-flex align-items-end bg-transparent">
                        <p class="card-text"><small class="text-secondary">Disponivel: <?= $product['quantity'] ?></small></p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex align-items-center gap-2">
                            <input type="hidden" id="json-product-<?= $product['id'] ?>" value='<?= json_encode($product) ?>'>
                            <p class="text-white-50">Qtd:</p>
                            <input type="number" class="form-control form-control-sm" id="quantity-cart-<?= $product['id'] ?>" value="1">
                            <button class="btn btn-success btn-sm d-flex gap-1" onclick="addCart(<?= $product['id'] ?>)" <?= $product['quantity'] <= 0 ? 'disabled' : '' ?>><i class="bi bi-bag-fill"></i> Comprar </button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>