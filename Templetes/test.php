<?php
namespace PHP\Modelo\Telas;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('..\DAO\Consultar.php');
require_once('..\DAO\Conexao.php');
require_once('..\DAO\Inserir.php');

use PHP\Modelo\DAO\Consultar;
use PHP\Modelo\DAO\Conexao;
use PHP\Modelo\DAO\Inserir;

// Gerencia o checkbox "selecionar todos"
if (isset($_POST['select_all_checkbox'])) {
    $_SESSION['select_all'] = true;
} else {
    $_SESSION['select_all'] = false;
}

// Gerencia as ações de edição
if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $editando = true;
    $codigo_edit = $_GET['codigo'] ?? '';
    $dt_edit = $_GET['dt'] ?? '';
    $categoria_edit = $_GET['categoria'] ?? '';
    $peso_edit = $_GET['peso'] ?? '';
}

// Processa as ações
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'edit':
            // O modal será exibido automaticamente pelos parâmetros GET
            break;
        case 'delete':
            // Redireciona para o processamento de exclusão
            if (isset($_POST['codigos'])) {
                header('Location: ../DAO/excluir_residuos.php');
                exit;
            }
            break;
    }
}
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../Css/Table.css">
    <script src="../js/CheckBox.js"></script>
    
    
    
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar <b>funcionários</b></h2>
                    </div>
                    <div class="col-sm-6">
                    <a href="adicionar_residuo.php" class="btn btn-success">
                        <i class="material-icons"></i> <span>Adicionar novo funcionário</span>
                    </a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-bs-toggle="modal"><i class="material-icons"></i> <span>Excluir</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <form method="POST" action="">
                                <input type="hidden" name="select_all" value="1">
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll" name="select_all_checkbox" 
                                           <?php echo (isset($_SESSION['select_all']) && $_SESSION['select_all']) ? 'checked' : ''; ?> 
                                           onchange="this.form.submit()">
                                    <label for="selectAll"></label>
                                </span>
                            </form>
                        </th>
                        <th><h3>Data</h3></th>
                        <th><h3>Categoria</h3></th>
                        <th><h3>Peso</h3></th>
                        <th><h3>Ações</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cria uma instância da classe Conexao
                    $conexao = new Conexao();
                
                    // Obtém a conexão mysqli
                    $conn = $conexao->conectar();
                
                    // Verifica se a conexão foi bem-sucedida
                    if ($conn) {
                        // Executa a consulta
                        $sql = "SELECT * FROM residuos";
                        $result = mysqli_query($conn, $sql);
                    
                        // Verifica se a consulta foi bem-sucedida
                        if ($result) {
                            $row = mysqli_num_rows($result);
                            if ($row > 0) {
                                while ($res = mysqli_fetch_assoc($result)) {
                    ?>
                                    <tr>
                                        <td>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" name="codigos[]" value="<?php echo $res['codigo']; ?>"
                                                       <?php echo (isset($_SESSION['select_all']) && $_SESSION['select_all']) ? 'checked' : ''; ?>>
                                            </span>
                                        </td>
                                        <td><?php echo $res['dt']; ?>hrs</td>
                                        <td><?php echo $res['categoria']; ?></td>
                                        <td><?php echo $res['peso']; ?>kg</td>
                                        <td>
                                            <a href="editar_residuo.php?codigo=<?php echo $res['codigo']; ?>&dt=<?php echo $res['dt']; ?>&categoria=<?php echo $res['categoria']; ?>&peso=<?php echo $res['peso']; ?>" 
                                                class="edit">
                                                <i class="material-icons" data-toggle="tooltip" title="Edit">✏️</i>
                                            </a>
                                            <a href="#deleteEmployeeModal" 
                                               class="delete" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#deleteEmployeeModal">
                                                <i class="material-icons" data-toggle="tooltip" title="Delete">🗑️</i>
                                            </a>
                                        </td>
                                    </tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Erro na consulta: " . mysqli_error($conn) . "</td></tr>";
                        }
                    
                        // Fecha a conexão (opcional)
                        mysqli_close($conn);
                    } else {
                        echo "<tr><td colspan='5'>Não foi possível conectar ao banco de dados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>        
</div>

<!-- Modal de Exclusão -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="../DAO/excluir_residuos.php" id="deleteForm">
                <div class="modal-header">						
                    <h4 class="modal-title">Excluir Resíduo(s)</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <p>Tem certeza que deseja excluir estes registros?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
                </div>
                <input type="hidden" name="codigos" id="selectedCodigos" value="">
            </form>
        </div>
    </div>
</div>

<script>
function submitDelete() {
    // Coleta todos os checkboxes marcados
    const checkboxes = document.querySelectorAll('input[name="codigos[]"]:checked');
    const codigos = Array.from(checkboxes).map(cb => cb.value);
    
    if (codigos.length === 0) {
        alert('Por favor, selecione pelo menos um registro para excluir.');
        return;
    }
    
    // Atualiza o input hidden com os códigos
    document.getElementById('selectedCodigos').value = codigos.join(',');
    
    // Envia o formulário
    document.getElementById('deleteForm').submit();
}

function preencherModal(codigo, dt, categoria, peso) {
    document.querySelector('#editEmployeeModal input[name="codigo"]').value = codigo;
    document.querySelector('#editEmployeeModal input[name="dt"]').value = dt;
    document.querySelector('#editEmployeeModal select[name="categoria"]').value = categoria;
    document.querySelector('#editEmployeeModal input[name="peso"]').value = peso;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="../js/BotaoDark.js"></script>

