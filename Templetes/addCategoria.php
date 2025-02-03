<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Adicionar Nova Categoria</h1>
        
        <!-- Formulário para adicionar categoria -->
        <form action="adicionar_categoria.php" method="POST">
            <div class="mb-3">
                <label for="nomeCategoria" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nomeCategoria" name="nomeCategoria" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>

        <!-- Mensagem de sucesso ou erro -->
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="alert alert-success mt-3">Categoria adicionada com sucesso!</div>';
            } elseif ($_GET['status'] == 'error') {
                echo '<div class="alert alert-danger mt-3">Erro ao adicionar categoria. Tente novamente.</div>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS (opcional, apenas se precisar de funcionalidades JS do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>