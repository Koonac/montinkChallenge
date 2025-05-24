<div class="container-fluid">
    <?php
    if (isset($data) && !$data['status']) {
        print_r($data['message']);
        print_r($data['error']);
    }
    ?>
    <h1>Criando produto</h1>

    <form class="row g-3" action="<?= Router::baseUrl('/produtos') ?>" method="post">
        <div class="col-md-6">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Preço R$</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Descrição</label>
            <textarea type="text" class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>Variações</legend>
                <div class="w-100 ">
                    <div class="d-flex align-items-start gap-2">
                        <div>
                            <button type="button" class="btn btn-secondary" id="product-new-variation"><i class="bi bi-plus-circle"></i></button>
                        </div>
                        <div id="variation-container" class="d-flex flex-column w-100 gap-2">
                            <input type="text" class="form-control" name="variations[]" placeholder="Nome da variação">
                        </div>
                    </div>
            </fieldset>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>