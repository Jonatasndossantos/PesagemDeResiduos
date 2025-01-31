<?php
        namespace PHP\Modelo\Telas;
        require_once('..\DAO\Excluir.php');
        require_once('..\DAO\Conexao.php');
        use PHP\Modelo\DAO\Excluir;
        use PHP\Modelo\DAO\Conexao;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="container">
    <form method="POST">
        <label>Informe um CPF</label>
        <input type="text" name="tCpf"/>
        <button type="submit">Excluir
            <?php
            if(isset($_POST['tCpf'])){
                $conexao   = new Conexao();
                $cpf       = $_POST['tCpf'];
                $excluir = new Excluir();
            }          
            ?>
        </button>
        
    </form>

    <?php
        if(isset($_POST['tCpf'])){
            echo $excluir->excluirCliente($conexao, $cpf);
        }else{
            echo "Preencha o campo CPF";
        }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>