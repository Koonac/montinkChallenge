<h2>Lista de pedidos</h2>
<div class="accordion accordion-flush" id="accordionOrders">

    <?php
    if (!empty($orders)) {
        foreach ($orders as $order) {
    ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-secondary text-white d-flex align-items-end" type="button" data-bs-toggle="collapse" data-bs-target="#order-<?= $order['id'] ?>" aria-expanded="false" aria-controls="order-<?= $order['id'] ?>">
                        Nº #<?= $order['id'] ?> - <?= $order['clientName'] ?> - <?= $order['clientPhone'] ?>
                    </button>
                </h2>
                <div id="order-<?= $order['id'] ?>" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionOrders">
                    <div class="accordion-body">
                        <p><strong>Status:</strong> <?= Helpers::orderStatusParser($order['status']) ?></p>
                        <p><strong>Nome:</strong> <?= $order['clientName'] ?></p>
                        <p><strong>Telefone:</strong> <?= $order['clientPhone'] ?></p>
                        <p><strong>Total:</strong> R$ <?= Helpers::convertToReal($order['total']) ?></p>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>