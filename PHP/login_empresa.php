<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Green Gate | Login Empresa</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style-login.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-login-empresa.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
  </head>
  <body>

  <?php

    include('conexao.php');
      session_start();
        if(!isset($_SESSION['entrar'])){

        $id = $_SESSION['id_usuario'];

        $sql_usuario = 'select * from usuario where id_usuario = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['usuario'] == 1){

        $sql_empresa = 'select cnpj from empresa where id_produtor='.$id.';';
        $resul_empresa = mysqli_query($conectar, $sql_empresa);

  ?>

  <section class="section-empresa">
    <div class="main-login-empresa">
      <h1>Login da Empresa </h1>

      <form name="login-empresa" method="POST" action="#">

          <input class="cnpj" type="text" name="cnpj" placeholder="CNPJ">

          <input class="senha-empresa" type="password" name="senha" placeholder="Senha">

        <div class="botao">
          <i class="fas fa-paper-plane"><input type="submit" name="entrar_empresa" value=""></i>
        </div>

      </form>

    </div>
  </section>

    <svg class="ondas" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20962 10601">
      <path class="primeira_onda" fill="#90a955" d="M27489 8635c504 1667 831 3818-27 5680s-2901 3434-6193 3904-7834-161-12155-589c-4321-427-8421-649-10976-1537-2555-889-3565-2443-4071-4061-505-1619-505-3302 938-4835 1442-1533 4327-2916 6274-3122s2958 764 3877 1522 1746 1304 2738 1382 2148-312 2976-730 1327-864 2136-1014c810-151 1929-6 2757 206s1363 490 1978 775c614 284 1308 574 1947 535s1223-407 1935-875c712-469 1552-1037 2240-1266 688-228 1223-117 1832 530 608 646 1290 1828 1794 3495z" />

      <path class="segunda_onda" fill="#c7d66d" d="M25681 10400c-171 822-305 1990-646 3115-341 1124-889 2206-1856 2808-968 602-2355 724-4668 1064s-5550 898-8520 987-5672-290-9037-859c-3366-568-7394-1326-9403-2118-2008-791-1996-1616-1892-3305 103-1689 298-4242 1412-5731 1113-1488 3146-1912 4953-1627 1808 284 3390 1276 4522 1878s1814 814 2423 552 1145-998 2333-1388c1187-389 3025-432 4266 275 1240 707 1884 2164 2861 2407 976 244 2285-726 3493-1308 1209-581 2316-775 3731-567 1415 207 3137 815 4290 1221 1153 407 1737 612 1926 953 189 342-18 820-188 1643z" />

      <path class="terceira_onda" fill="#ECF39E" d="M30706 11822c-291 731-653 1801-1548 2972-895 1170-2321 2441-4988 3026-2667 586-6574 485-10469 541s-7778 268-10906-256-5501-1784-6906-3382c-1404-1598-1840-3533-1957-4910-118-1377 82-2195 1029-2854 946-659 2637-1158 4033-1002s2495 968 3440 1630 1737 1175 2905 1086c1169-89 2714-780 3810-1332 1095-552 1740-965 2665-820s2130 848 3110 1360c980 513 1734 837 2458 672s1416-819 2179-1050 1597-40 3058 269c1461 310 3550 739 5069 1177 1519 437 2469 883 2998 1112 529 228 639 240 584 440-55 201-274 591-564 1321z" />
    </svg>


<?php

    if (isset($_POST['entrar_empresa'])) {
      $cnpj = mysqli_real_escape_string($conectar, $_POST['cnpj']);
      $senha = mysqli_real_escape_string($conectar, md5($_POST['senha']));

      if($senha == $dados_usuario['senha']){

        $_SESSION['cnpj_empresa']= $_POST['cnpj'];
        header('location:painel_empresa.php');

      }else{
        header('location:login_empresa.php');
      }

    }else{
    }

  }else{
    header('location:invalido.php');
  }

  }else{
    unset($_SESSION['entrar']);
    header('location:invalido.php');
  }

?>


</body>
</html>