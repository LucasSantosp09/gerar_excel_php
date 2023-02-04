<?php
session_start(); // Iniciar a sessão

include_once('conexao.php');

echo "<h1>Listar Usuarios</h1>";

// Link para gerar excel
echo "<a href='gerar_excel.php'>Gerar Excel</a><br><br>";

// Verificar se existe a variável global
if(isset($_SESSION['msg'])){

    // Imprimir o valor que está dentro da variável global
    echo $_SESSION['msg'];

    // Destruir a variável global
    unset($_SESSION['msg']);
}

// QUERY para recuperar os registros do banco de dados
$query_usuarios = "SELECT id, nome, email, endereco FROM usuarios ORDER BY id DESC";

// Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();

// Acessa o IF quando encontrar registro no banco de dados
if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){

    // Ler os registros retornado do banco de dados
    while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
        //var_dump($row_usuario);

        // Extrair os dados do array para imprimir através no nome da coluna
        extract($row_usuario);

        // Imprimir os dados do registro
        echo "ID: $id <br>";
        echo "Nome: $nome <br>";
        echo "E-mail: $email <br>";
        echo "Endereço: $endereco <br>";
        echo "<hr>";
    }
}else{ // Acessa O ELSE quando não encontrar nenhum registro no BD
    echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
}

?>