<?php

function test_sql_php() {
    // Configurações do banco de dados MySQL
    $hostname = "localhost";  // Nome do servidor
    $username = "root"; // Nome de usuário do MySQL
    $password = "";   // Senha do MySQL
    $database = "php_test"; // Nome do banco de dados

    // Crie uma conexão com o banco de dados MySQL
    $mysqli = new mysqli($hostname, $username, $password, $database);

    // Verifique a conexão
    if ($mysqli->connect_error) {
        die("Falha na conexão: " . $mysqli->connect_error);
    }

    // Abra o arquivo SQL
    $sql_file = "aqui_vai_o_arquivo_sql.sql"; // Substitua pelo nome do seu arquivo SQL
    $fp = fopen($sql_file, "r");

    // Inicialize com sucesso
    $success = true;

    // Execute as consultas SQL no arquivo
    $query = "";
    while (!feof($fp)) {
        $line = fgets($fp);
        if (trim($line) !== '') { // Verifique se a linha não está vazia
            $query .= $line;
            if (substr(trim($line), -1) == ';') { // Se a linha terminar com ponto e vírgula, execute a consulta
                if ($mysqli->query($query) !== TRUE) { // Execute a instrução SQL no banco de dados MySQL
                    $success = false;
                    break;
                }
                $query = ""; // Limpe a consulta para a próxima instrução
            }
        }
    }

    // Feche o arquivo SQL
    fclose($fp);

    // Verifique o resultado do teste
    if ($success) {
        echo "O arquivo SQL passou no teste de integridade! Nome do arquivo: " . $sql_file . "<br><br><br>";
    } else {
        echo "O arquivo SQL falhou no teste de integridade: " . $sql_file . "<br>Erro: " . $mysqli->error . "<br><br><br>";
    }

    // Feche a conexão com o banco de dados MySQL
    $mysqli->close();
}

// Chame a função para testar o SQL
test_sql_php();

?>
