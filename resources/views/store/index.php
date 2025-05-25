<?php
print_r($_SESSION);
?>

<h1>Venda dos produtos</h1>

<?php
if (!empty($products)) {
    foreach ($products as $product) {
        print_r($product);

?>
        <input type="hidden" id="json-product-<?= $product['id'] ?>" value='<?= json_encode($product) ?>'>
        <button class="btn btn-success" onclick="addCart(<?= $product['id'] ?>)"><i class="bi bi-bag-fill"></i></button>
<?php
        print '<br>';
    }
}
?>