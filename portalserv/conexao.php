<?php
    define('HOST','localhost');
    define('USUARIO','root');
    define('SENHA','senha3762');
    define('DB','db_portalsolar');

    $conexao  = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
