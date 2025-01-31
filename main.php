<?php
    namespace PHP\Modelo;
    
    require_once('Cliente.php');
    require_once('Funcionario.php');

    use PHP\Modelo\Cliente;
    use PHP\Modelo\Funcionario;

    // Objeto
    $cliente1 = new Cliente("12345678910",
                            "João Carlos",
                            "199999-5656",
                            "Rua Jipa, 15",
                            1500);

    $funionario1 = new Funcionario("12345678910",
                                   "João Carlos",
                                   "199999-5656",
                                   "Rua Jipa, 15",
                                   1500);


    //Ver dados
    echo $cliente1->imprimir();
    echo $funionario1->imprimir();

?>