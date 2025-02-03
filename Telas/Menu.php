<?php
    namespace PHP\Modelo\Telas;

    require_once('..\Cliente.php');
    require_once('..\DAO\Conexao.php');
    require_once('..\DAO\Inserir.php');
    

    use PHP\Modelo\Cliente;
    use PHP\Modelo\DAO\Conexao;
    use PHP\Modelo\DAO\Inserir;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../Css/BotaoDark.css">
    

    <!-- Custom styles for this template -->
</head>
<body class="container">
    <!--botao dark-->
    <?php include('../Templetes/BotaoDark.php');?>
    <!--fim botao dark-->

<div class="table-responsive">
<a href="cadastroFuncionario.php"><button>Cadastrar Funcionario</button></a>
<a href="cadastroCliente.php"><button>Cadastrar Cliente</button></a>
<a href="consultarCliente.php"><button>Consultar Cliente</button></a>
<a href="consultarFuncionario.php"><button>Consultar Funcionario</button></a>
<a href="atualizarCliente.php"><button>Atualizar Cliente</button></a>
<a href="atualizarFuncionario.php"><button>Atualizar Funcionario</button></a>
<a href="excluirCliente.php"><button>Excluir Cliente</button></a>
<a href="excluirFuncionario.php"><button>Excluir Funcionario</button></a>

<!--https://www.php.net/manual/en/mysqli-result.fetch-array.php-->
<?php include('test.php');?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <!--javascript do botao-->
 <script src="../js/BotaoDark.js"></script>
 
</body>
</html>