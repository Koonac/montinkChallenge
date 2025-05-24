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
        print '<br>';
?>

<?php
    }
}
?>