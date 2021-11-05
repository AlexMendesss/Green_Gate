<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Endereços</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-editar-perfil.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-alterar-senha.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-endereco.css">

    </head>

    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){

        function get_endereco($cep){
        $cep = preg_replace("/[^0-9]/","",$cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);
        return $xml;

        }

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 1){

    ?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <a href="painel_produtor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Menu para Administrar -->

    <main>
    <aside class="main-aside-produtor">
        <nav>
            <ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="editar_perfil.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="#"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="endereco.php"><li><i class="fas fa-map-marked-alt"></i>
                    Endereços
                </li></a>  
                <a href="deletar.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>
                <a href="../invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main adicionar-endereco">
            <h3>Adicionar Endereço</h3>

            <form method="POST">

                <div class="linha primeira">
                    CEP: <input type="text" name="cep">
                    Bairro: <input type="text" name="bairro">
                </div>

                <div class="linha segunda">
                    Logradouro: <input type="text" name="logradouro">
                    Número Residencial: <input type="text" name="n_residencial">
                </div>

                <div class="linha terceira">
                    Complemento: <input type="text" name="complemento">
                </div>

                <div class="linha quarta">
                    <div class="btn">
                        <i class="fas fa-plus"> 
                            <input type="submit" name="adicionar" value="">                
                        </i>
                    </div>
                </div>

            </form>

        </section>
    </main>

    <?php

    if(isset($_POST['adicionar'])){

        if(empty($_POST['cep']) or empty($_POST['bairro']) or empty($_POST['logradouro']) or empty($_POST['n_residencial'])){
            echo ('<script>window.alert("Preencha os campos!");window.location="endereco.php"</script>');

        }else{

        $cep_usuario = $_POST['cep'];
        $endereco = (get_endereco($cep_usuario));
        $estado = $endereco->uf;
        $cidade = $endereco->localidade;
        $bairro = $_POST['bairro'];
        $logradouro = $_POST['logradouro'];
        $n_residencial = $_POST['n_residencial'];
        $complemento = $_POST['complemento'];

        $sql_adiciona_endereco = 'insert into endereco(cep, estado, cidade, bairro, logradouro, n_residencial, complemento, tp_usuario, id_pf_fisico, id_pf_juridico) values ("'.$cep_usuario.'", "'.$estado.'", "'.$cidade.'", "'.$bairro.'", "'.$logradouro.'", '.$n_residencial.', "'.$complemento.'", '.$dados_usuario['tp_usuario'].', null, '.$dados_usuario['id_pf_juridico'].');';

        $endereco = mysqli_query($conectar, $sql_adiciona_endereco);

            if($endereco){
                echo ('<script>window.alert("Endereço adicionado com sucesso!");window.location="endereco.php"</script>');
            }else{
               echo ('<script>window.alert("Erro ao adicionar o endereço!");window.location="endereco.php"</script>'); 
            }

        }

    }else{}

    ?>

    <!-- Rodapé -->

    <footer class="main-footer">
        <section class="cont-footer">
            <div>
                <p>Para quem se compromete com o meio ambiente.</p>
            </div>
        </section>

        <div id="linha-vert"></div>

        <div class="footer-icon">
            <a href="https://www.facebook.com/Green-Gate-103711395206238"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>



    <?php

    }else{
        header('location:../invalido.php');
    }

    }else{
        unset($_SESSION['entrar']);
        header('location:../invalido.php');
    }

    ?>

    </body>
</html>