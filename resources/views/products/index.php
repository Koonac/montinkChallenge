<h1>PRODUTOS PAGE</h1>

<p><a href="<?= Router::baseUrl('/produtos/criar') ?>">Criar</a></p>
<?php
if (isset($data) && !$data['status']) {
    print_r($data['message']);
}
?>

<?php
if (!empty($products)) {
    foreach ($products as $product) {
        print_r($product);

?>
        <a class="btn btn-warning" href="<?= Router::baseUrl('/produtos/' . $product['id']) ?>">Editar</a>
        <button type="button" class="btn btn-danger" onclick="deleteProduct(<?= $product['id'] ?>)"><i class="bi bi-trash-fill"></i></button>
<?php
        print '<br>';
    }
}
?>