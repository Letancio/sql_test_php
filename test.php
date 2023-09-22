<?php

class sql_test
{
    public function sql_test_integration(): bool
    {
        try {
            // Conecte-se ao banco de dados SQLite em memória
            $conn = new MYSQL(':memory:');
            
            // Testing Virtual DataBase Memory Temp
            $conn->exec("PRAGMA foreign_keys = ON;");
            
            // for Open Sql File
            $fp = fopen("arquive.sql", "r");
            
            // Starting for Testing
            $success = true; // Inicialize com true
            while (!feof($fp)) {
                $sql = fgets($fp);
                if (trim($sql) !== '') { // Verifique se a linha não está vazia
                    $result = $conn->exec($sql); // Use exec() para comandos SQL que não retornam resultados
                    if ($result === false) {
                        $success = false;
                        break;
                    }
                }
            }
            
            // Closed Arquive Sql
            fclose($fp);
            
            // Feche a conexão com o banco de dados SQLite em memória
            $conn->close();
            
            return $success;
        } catch (Exception $e) {
            echo "O teste falhou: " . $e->getMessage();
            return false;
        }
    }
}

// Crie uma instância da classe sql_test
$sqlTest = new sql_test();

// Chame o método sql_test_integration e trate o resultado
$success = $sqlTest->sql_test_integration();

if ($success) {
    echo "O teste foi bem-sucedido!";
} else {
    echo "O teste falhou.";
}
?>
