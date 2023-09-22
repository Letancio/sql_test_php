<?php

// Crie ou conecte-se a um banco de dados SQLite em memória
$memory_db = new SQLite3(':memory:');

// Verifique se a conexão foi estabelecida corretamente
if (!$memory_db) {
    die("Falha na criação do banco de dados em memória.");
}

// Abra o arquivo SQL
$sql_file = "arquive.sql"; // Substitua pelo nome do seu arquivo SQL
$fp = fopen($sql_file, "r");

// Inicialize com sucesso
$success = true;

// Execute as consultas SQL no arquivo
while (!feof($fp)) {
    $sql = fgets($fp);
    if (trim($sql) !== '') { // Verifique se a linha não está vazia
        $result = $memory_db->exec($sql); // Execute a instrução SQL no banco de dados em memória
        if ($result === false) {
            $success = false;
            break;
        }
    }
}

// Feche o arquivo SQL
fclose($fp);

// Verifique o resultado do teste
if ($success) {
    echo "O arquivo SQL passou no teste de integridade!";
} else {
    echo "O arquivo SQL falhou no teste de integridade.";
}

// Feche a conexão com o banco de dados em memória
$memory_db->close();

?>
