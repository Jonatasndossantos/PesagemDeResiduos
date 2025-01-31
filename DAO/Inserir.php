<?php
    namespace PHP\Modelo\DAO;

    require_once('Conexao.php');

    use PHP\Modelo\DAO\Conexao;

    class Inserir{
        function cadastrarCliente(Conexao $conexao,
                                  string $cpf,
                                  string $nome,
                                  string $endereco,
                                  string $telefone,
                                  float $totalDeCompras
        ){try{
                $conn = $conexao->conectar();//Abrir banco de dados
                $sql  = "insert into cliente(codigo,nome,telefone,endereco,total)
                         values('$cpf','$nome','$telefone','$endereco','$totalDeCompras')";
                $result = mysqli_query($conn, $sql);
                mysqli_close($conn);
                if($result){
                    return "<br><br>Inserido com Sucesso!";
                }
                return "<br><br>Não Inserido!";
            }catch(Except $erro){
                return "<br><br> Algo deu errado".$erro;
            }
        }//fim metodo cadastrarCliente



        function cadastrarFuncionario(Conexao $conexao,
                                       string $cpf,
                                       string $nome,
                                       string $endereco,
                                       string $telefone,
                                       float  $salario
        ){
            try{
                $conn = $conexao->conectar();//Abrir banco de dados
                $sql  = "insert into Funcionario(codigo,nome,telefone,endereco,salario)
                         values('$cpf','$nome','$telefone','$endereco','$salario')";
                $result = mysqli_query($conn, $sql);
                mysqli_close($conn);
                if($result){
                    return "<br><br>Inserido com Sucesso!";
                }
                return "<br><br>Não Inserido!";
            }catch(Except $erro){
                return "<br><br> Algo deu errado".$erro;
            }


        }//fim metodo cadastrarfuncionario
    
    
    }//Fim class


?>