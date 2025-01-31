<?php
    namespace PHP\Modelo\DAO;
    require_once('Conexao.php');
    use PHP\Modelo\DAO\Conexao;

    class excluir{
        function excluirCliente(
            conexao $conexao,
            int $cpf
        ){
            $conn = $conexao->conectar();
            $sql  = "delete from cliente where codigo = '$cpf'";
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);

            if($result){
                echo "Deletado com sucesso!";

            }else{
                echo "Não deletado!";
            }
        }//fim excluirCliente
        function excluirFuncionario(
            conexao $conexao,
            int $cpf
        ){
            $conn = $conexao->conectar();
            $sql  = "delete from Funcionario where codigo = '$cpf'";
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);

            if($result){
                echo "Deletado com sucesso!";

            }else{
                echo "Não deletado!";
            }
        }//fim excluirFuncionario
    }//fim excluir
?>