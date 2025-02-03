<?php
    namespace PHP\Modelo\Telas;
    require_once('..\DAO\Consultar.php');
    require_once('..\DAO\Conexao.php');
    require_once('..\DAO\Inserir.php');

    use PHP\Modelo\DAO\Consultar;
    use PHP\Modelo\DAO\Conexao;
    use PHP\Modelo\DAO\Inserir;

    include('../DAO/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Table.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="../js/CheckBox.js"></script>
    <link rel="stylesheet" href="../Css/BotaoDark.css">
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name="options[]"]');
    
            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
    
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function () {
                    if (!checkbox.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(checkboxes).every((cb) => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                });
            });
        });
    </script>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar <b>funcionários</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal"><i class="material-icons"></i> <span>Adicionar novo funcionário</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-bs-toggle="modal"><i class="material-icons"></i> <span>Excluir</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Peso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exemplo de linha -->
                    <?php
                        $sql  = "select * from residuos";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_num_rows($result);
                        if($row>0){
                            while($res = mysqli_fetch_array($result)){?>
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td><?php echo $res['data']; ?>data</td>
                        <td><?php echo $res['categoria']; ?>categoria</td>
                        <td><?php echo $res['peso']; ?>peso</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-bs-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-bs-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                    <?PHP   }
                        }
                    ?>
                    <!-- Adicione mais linhas conforme necessário -->
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>5</b> de <b>25</b> entradas</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#" class="page-link ">Anterior</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Próximo</a></li>
                </ul>
            </div>
        </div>
    </div>        
</div>

<!-- Edit Modal Adicionar HTML -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">						
                    <h4 class="modal-title">Adicionar Residuos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>Data</label>
                        <input name="data" type="datetime-local" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" class="form-select" aria-label="Default select example">
                            <option selected>Selecione</option>
                            <option value="1">não reciclável</option>
                            <option value="2">reciclável</option>
                            <option value="3">óleo</option>
                            <option value="4">tampinhas plásticas</option>
                            <option value="5">lacres de alumínio</option>
                            <option value="6">tecidos</option>
                            <option value="7">meias</option>
                            <option value="8">material de escrita</option>
                            <option value="9">esponjas</option>
                            <option value="10">eletrônicos</option>
                            <option value="11">pilhas e baterias</option>
                            <option value="12">infectante</option>
                            <option value="13">químicos</option>
                            <option value="14">lâmpada fluorescente</option>
                            <option value="15">tonners de impressora</option>
                            <option value="16">esmaltes</option>
                            <option value="17">cosméticos</option>
                            <option value="18">cartela de medicamento</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label>Peso</label>
                        <input name="peso" type="number" class="form-control" required="">
                    </div>					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Salvar
                        <?php
                            $conexao = new Conexao();//Conectar no Banco
                            $message = "";

                            if(isset($_POST['data'])&&
                            isset($_POST['categoria'])&&
                            isset($_POST['peso'])){
                              $data      = $_POST ['data'];
                              $categoria = $_POST ['categoria'] ;
                              $peso      = $_POST ['peso'];
                            
                            //Instanciar
                            $inserir = new Inserir();
                            $result = $inserir->cadastrarResiduos($conexao, $data, $categoria, $peso);

                                // Verifica o resultado da inserção
                                if ($result) {
                                    $message = "Resíduo adicionado com sucesso!";
                                } else {
                                    $message = "Erro ao adicionar resíduo. Tente novamente.";
                                }
                            }
                        ?>

                            <script>
                                // Exibe o modal com a mensagem após a tentativa de adicionar
                                document.addEventListener('DOMContentLoaded', function () {
                                    var message = "<?php echo $message; ?>";
                                    if (message) {
                                        document.getElementById('messageContent').innerText = message;
                                        var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                                        messageModal.show();
                                    }
                                });
                            </script>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal de Mensagem -->
<div id="messageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Resultado da Operação</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal Editar HTML -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Residuo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">					
                <div class="form-group">
                    <label>Data</label>
                    <input type="datetime-local" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <input type="text" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Peso</label>
                    <input type="text" class="form-control" required="">
                </div>					
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal Deletar HTML -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Excluir funcionário</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <p>Tem certeza de que deseja excluir esses registros?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-danger" value="Excluir">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="../js/BotaoDark.js"></script>
</body>
</html>