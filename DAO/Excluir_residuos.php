<?php
session_start(); // Inicia a sessão (se necessário)

require_once('Conexao.php'); // Inclui a classe de conexão
require_once('Excluir.php'); // Inclui a classe de exclusão

use PHP\Modelo\DAO\Conexao;
use PHP\Modelo\DAO\Excluir;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigos'])) {
        $codigos = explode(',', $_POST['codigos']); // Converte a string de códigos em um array

        $conexao = new Conexao();
        $excluir = new Excluir();

        foreach ($codigos as $codigo) {
            $codigo = (int)$codigo; // Converte o código para int
            $result = $excluir->excluirResiduos($conexao, $codigo);
            if (!$result) {
                echo "Erro ao excluir o resíduo com código: $codigo";
                exit();
            }
        }

        echo "Resíduos excluídos com sucesso!";
        header('Location: ../Telas/Menu.php'); // Redireciona para a página principal
        exit();
    } else {
        echo "Nenhum resíduo selecionado.";
    }
}
?>