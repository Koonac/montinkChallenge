<h1>PEDIDOS PAGE</h1>

<?php
if (!empty($orders)) {
    foreach ($orders as $order) {
        print_r($order);
        print '<br>';
    }
}
?>