<?php
        namespace PHP\Modelo\Telas;
        require_once('..\DAO\Atualizar.php');
        require_once('..\DAO\Conexao.php');
        use PHP\Modelo\DAO\Atualizar;
        use PHP\Modelo\DAO\Conexao;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="container">
    <form action="" method="POST">
        <label for="">CPF:</label>
        <input type="text" name="tCpf"/><br><br>

        <label>Escolha o campo</label>
        <select name="tCampo">
            <option value="nome">Nome</option>
            <option value="telefone">Telefone</option>
            <option value="endereco">Endereco</option>
            <option value="total">Total de Compras</option>
        </select><br>

        <label>Novo dado:</label>
        <input type="text" name="tNovoDado"/><br>

        <button type="submit">Atualizar
            <?php            
                $conexao = new Conexao();
                if(isset($_POST['tCpf'])){
                    $atualizar = new Atualizar();

                    $cpf = $_POST['tCpf'];
                    $campo = $_POST['tCampo'];
                    $novoDado = $_POST['tNovoDado'];
                }
            ?>
        </button>

    </form>
    <?php
        if(isset($_POST['tCpf'])){
            echo $atualizar -> atualizarCliente($conexao, 
                                                $campo, 
                                                $novoDado, 
                                                $cpf);
        }   
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>