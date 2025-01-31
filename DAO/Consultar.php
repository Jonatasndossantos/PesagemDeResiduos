<?php
    namespace PHP\Modelo\DAO;
    require_once('Conexao.php');
    use PHP\Modelo\DAO\Conexao;


    class Consultar{
        function consultarClienteIndividual(
            Conexao $conexao,
            int $cpf
        ){
            try{
                $conn = $conexao->conectar();
                $sql  = "select * from cliente where codigo = '$cpf'";
                $result = mysqli_query($conn, $sql);

                while($dados = mysqli_fetch_Array($result)){
                    if($dados['codigo'] == $cpf){
                        echo "<br>CPF: ".$dados['codigo'].
                             "<br>Nome: ".$dados['nome'].
                             "<br>Telefone: ".$dados['telefone'].
                             "<br>Endereco: ".$dados['endereco'].
                             "<br>Total: ".$dados['total'];
                        return;//Finalizar o while
                    }
                    return "código digitado invalido!";
                }
            }catch(Except $erro){
                echo $erro;
            }
        }//fim do consultarClienteIndividual

        function consultarFuncionarioIndividual(
            Conexao $conexao,
            int $cpf
        ){
            try{
                $conn = $conexao->conectar();
                $sql  = "select * from Funcionario where codigo = '$cpf'";
                $result = mysqli_query($conn, $sql);

                while($dados = mysqli_fetch_Array($result)){
                    if($dados['codigo'] == $cpf){
                        echo "<br>CPF: ".$dados['codigo'].
                             "<br>Nome: ".$dados['nome'].
                             "<br>Telefone: ".$dados['telefone'].
                             "<br>Endereco: ".$dados['endereco'].
                             "<br>Salario: ".$dados['salario'];
                        return;//Finalizar o while
                    }
                    return "código digitado invalido!";
                }
            }catch(Except $erro){
                echo $erro;
            }
        }//fim do consultarFuncionarioIndividual
    }//fim da classe


?>