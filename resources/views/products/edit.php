<div class="container-fluid">
    <?php
    if (isset($data) && !$data['status']) {
        print_r($data['message']);
        print_r($data['error']);
    }
    ?>

    <?php
    print_r($product);
    ?>
    <h1>Alterando produto</h1>

    <form class="row g-3" action="<?= Router::baseUrl('/produtos/' . $product['id'].'/atualizar') ?>" method="post">
        <div class="col-md-6">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>">
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Preço R$</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= $product['price'] ?>">
        </div>
        <div class="col-md-6">
            <label for="quantity" class="form-label">Estoque</label>
            <input type="text" class="form-control" id="quantity" name="quantity" value="<?= $product['quantity'] ?>">
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Descrição</label>
            <textarea type="text" class="form-control" id="description" name="description" rows="3"><?= $product['description'] ?></textarea>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>Variações</legend>
                <div class="w-100 ">
                    <div class="d-flex align-items-start gap-2">
                        <div>
                            <button type="button" class="btn btn-secondary" id="product-new-variation"><i class="bi bi-plus-circle"></i></button>
                        </div>
                        <div id="variation-container" class="d-flex flex-column gap-2">
                            <?php
                            if (!empty($product['variations'])) {
                                foreach ($product['variations'] as $variation) {
                            ?>
                                    <div class="d-flex">

                                        <input type="text" class="form-control col-md-11" name="variations_edit[<?= $variation['id'] ?>]" value="<?= $variation['name'] ?>" placeholder="Nome da variação">
                                        <input type="text" class="form-control col-md-1" name="stock_variations[<?= $variation['id'] ?>]" value="<?= $variation['quantity'] ?>">
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
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>