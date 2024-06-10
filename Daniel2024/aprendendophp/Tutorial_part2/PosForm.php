!<?php
    echo" <h1> Ola mundo </h1> ";
    $nome = $_POST[ 'nome' ];
    $endereco = $_POST[ 'endereco'];
    $Apelido = $_POST [ 'Apelido' ];
    echo $nome;
    echo '<br>';
    echo '<p> Seu Apelido E: </p>';
    echo $Apelido;
    echo '<p> Voce mora na rua </p>';
    echo $endereco;

    ?>