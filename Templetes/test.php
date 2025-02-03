<?php
    namespace PHP\Modelo\Telas;
    require_once('..\DAO\Consultar.php');
    require_once('..\DAO\Conexao.php');
    require_once('..\DAO\Inserir.php');

    use PHP\Modelo\DAO\Consultar;
    use PHP\Modelo\DAO\Conexao;
    use PHP\Modelo\DAO\Inserir;
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../Css/Table.css">
    <script src="../js/CheckBox.js"></script>
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
                                                <input type="checkbox" name="codigos[]" value="<?php echo $res['codigo']; ?>" id="checkbox<?php echo $res['codigo']; ?>">
                                                <label for="checkbox<?php echo $res['codigo']; ?>"></label>
                                            </span>
                                        </td>
                                        <td><?php echo $res['dt']; ?>hrs</td>
                                        <td><?php echo $res['categoria']; ?></td>
                                        <td><?php echo $res['peso']; ?>kg</td>
                                        <td>
                                            <a href="#editEmployeeModal" class="edit" data-bs-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteEmployeeModal" class="delete" data-bs-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
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
                        <input name="dt" type="datetime-local" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" class="form-select" required=" " aria-label="Default select example">
                            <option selected value="">Selecione</option>
                            <option value="nao reciclavel"       >não reciclável</option>
                            <option value="reciclavel"           >reciclável</option>
                            <option value="óleo"                 >óleo</option>
                            <option value="tampinhas_plasticas"  >tampinhas plásticas</option>
                            <option value="lacres_de_aluminio"   >lacres de alumínio</option>
                            <option value="tecidos"              >tecidos</option>
                            <option value="meias"                >meias</option>
                            <option value="material_de_escrita"  >material de escrita</option>
                            <option value="sponjas"              >esponjas</option>
                            <option value="eletrônicos"          >eletrônicos</option>
                            <option value="pilhas_e_baterias"    >pilhas e baterias</option>
                            <option value="infectante"           >infectante</option>
                            <option value="químicos"             >químicos</option>
                            <option value="lâmpada_fluorescente" >lâmpada fluorescente</option>
                            <option value="tonners_de_impressora">tonners de impressora</option>
                            <option value="esmaltes"             >esmaltes</option>
                            <option value="cosméticos"           >cosméticos</option>
                            <option value="cartela_de_"          >cartela de medicamento</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label>Peso</label>
                        <input name="peso" type="decimal" class="form-control" required=" " placeholder="00,0">
                    </div>		
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Destino</label>
                        <input name="destino" type="text" class="form-control" required=" " id="inputAddress" placeholder="1234 Main St">
                    </div>					
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Salvar
                        <?php
                            $conexao   = new Conexao();//Conectar no Banco
                            $result    = "";
                            $message   = "";
                            $dt        = "";
                            $categoria = "";
                            $peso      = "";
                            $destino   = "";

                            if(isset($_POST['dt'])&&
                                isset($_POST['categoria'])&&
                                isset($_POST['peso'])&&
                                isset($_POST['destino'])){
                              $dt        = $_POST['dt'];
                              $categoria = $_POST['categoria'];
                              $peso      = $_POST['peso'];
                              $destino   = $_POST['destino'];
                            
                            //Instanciar
                             $inserir = new Inserir();
                             $result = $inserir->cadastrarResiduos($conexao, $dt, $categoria, $peso, $destino);
                            }
                                // Verifica o resultado da inserção
                                if ($result) {
                                    $message = "Resíduo adicionado com sucesso!";
                                } else {
                                    $message = "Erro ao adicionar resíduo. Tente novamente.";
                                }
                            
                        ?>
                        <script>
                                // Exibe o modal com a mensagem após a tentativa de adicionar
                                document.onclick('DOMContentLoaded', function () {
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

<!-- Modal de Exclusão -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="../DAO/excluir_residuos.php">
                <div class="modal-header">						
                    <h4 class="modal-title">Excluir Resíduos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <p>Tem certeza de que deseja excluir esses registros?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancelar">
                    <button type="submit" class="btn btn-danger" value="Excluir">Excluir</button>
                </div>
                <input type="hidden" name="codigos" id="codigosSelecionados">
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="../js/BotaoDark.js"></script>