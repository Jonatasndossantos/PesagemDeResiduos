<?php
    namespace PHP\Modelo\DAO;

    require_once('Conexao.php');

    use PHP\Modelo\DAO\Conexao;

    class Inserir{
        function cadastrarResiduos(Conexao $conexao,
                                       string $data,
                                       string $categoria,
                                       float  $peso
        ){
            try{
                $conn = $conexao->conectar();//Abrir banco de dados
                $sql  = "insert into Residuos(codigo,data,categoria,peso)
                         values('','$data','$categoria','$peso')";
                $result = mysqli_query($conn, $sql);
                mysqli_close($conn);
                if($result){
                    return "<br><br>Inserido com Sucesso!";
                }
                return "<br><br>Não Inserido!";
            }catch(Except $erro){
                return "<br><br> Algo deu errado".$erro;
            }


        }//fim metodo cadastrarResiduos


        function cadastrarUsuario(Conexao $conexao,
                                       string $cpf,
                                       string $nome,
                                       string $endereco,
                                       string $telefone,
                                       float  $salario
        ){
            try{
                $conn = $conexao->conectar();//Abrir banco de dados
                $sql  = "insert into Usuario(codigo,nome,telefone,endereco,salario)
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


        }//fim metodo cadastrarUsuario
    
    
    }//Fim class


?>