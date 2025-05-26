<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= (isset($title)) ? "ERP Montink - $title" : 'ERP Montink' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Bootstrap Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Importa todos os CSS automaticamente -->
    <?php
    foreach (glob(__DIR__ . '/../css/*.css') as $css) {
        $href = Router::baseUrl('/resources/css/' . basename($css));

        echo "<link rel='stylesheet' href='$href'>\n";
    }
    ?>

</head>

<body class="bg-dark text-white">

    <nav class="navbar navbar-expand-lg bg-montink">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Router::baseUrl('/') ?>">
                <img src="https://sou.montink.com/wp-content/uploads/2024/04/logo.png" width="150" height="35" alt="Logo montink">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= (Router::getPath() == '/') ? 'active' : '' ?>" aria-current="page" href="<?= Router::baseUrl('/') ?>">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(Router::getPath(), 'produtos') ? 'active' : '' ?>" href="<?= Router::baseUrl('/produtos') ?>">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(Router::getPath(), 'loja') ? 'active' : '' ?>" href="<?= Router::baseUrl('/loja') ?>">Loja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(Router::getPath(), 'pedidos') ? 'active' : '' ?>" href="<?= Router::baseUrl('/pedidos') ?>">Pedidos</a>
                    </li>
                    <li class="nav-item border-top">
                        <a class="nav-link d-block d-lg-none <?= str_contains(Router::getPath(), 'carrinho') ? 'active' : '' ?>" href="<?= Router::baseUrl('/carrinho') ?>">Carrinho</a>
                    </li>
                </ul>
            </div>
            <a class="btn btn-dark d-none d-lg-block text-white-50" href="<?= Router::baseUrl('/carrinho') ?>"><i class="bi bi-cart-fill"></i></a>
        </div>
    </nav>

    <!-- Renderiza o conteúdo da view específica -->
    <div class="container-fluid p-3 pt-4">
        <?php if ($flash = Notification::getFlash()): ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <!-- IMASK -->
    <script src="https://unpkg.com/imask"></script>

    <!-- Importa todos os JS automaticamente -->
    <?php
    foreach (glob(__DIR__ . '/../js/*.js') as $js) {
        $src = Router::baseUrl('/resources/js/' . basename($js));

        echo "<script src='$src'></script>\n";
    }
    ?>
</body>

</html>