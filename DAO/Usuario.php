<?php
namespace PHP\Modelo\DAO;

class Usuario {
    private $conexao;

    public function __construct() {
        $conexaoObj = new Conexao();
        $this->conexao = $conexaoObj->getConexao();
    }

    public function login($usuario, $senha) {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt->bindValue(2, md5($senha));
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $dados = $stmt->fetch(\PDO::FETCH_ASSOC);
                $_SESSION['usuario_id'] = $dados['id'];
                $_SESSION['usuario'] = $dados['usuario'];
                return true;
            }
            return false;
        } catch(\PDOException $e) {
            echo "Erro no login: " . $e->getMessage();
            return false;
        }
    }
} 