<!DOCTYPE html>
<html>

<head>
    <title>Página não encontrada</title>
</head>

<body>
    <h1>404 - Página não encontrada</h1>
    <?php if (isset($msgError) && !empty($msgError)): ?>
        <p><?= $msgError ?></p>
    <?php else: ?>
        <p>A rota acessada não existe.</p>
    <?php endif; ?>
</body>

</html>