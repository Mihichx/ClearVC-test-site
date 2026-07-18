<?php

$configPath = __DIR__ . '/config.php';
$connect = null;

if (file_exists($configPath)) {
    $config = require_once $configPath;
    
    if (!empty($config['db']['dbname'])) {
        $dbConf = $config['db'];
        $strConnect = "mysql:host={$dbConf['host']};dbname={$dbConf['dbname']};charset={$dbConf['charset']}";

        try {
            $connect = new PDO($strConnect, $dbConf['username'], $dbConf['password']);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<div style='padding:20px; background:#ffdddd; color:#aa0000; border:1px solid #cc0000; font-family:sans-serif;'>";
            echo "<h2> Ошибка подключения к базе данных:</h2>";
            echo "<code>" . htmlspecialchars($e->getMessage()) . "</code>";
            echo "</div>";
            exit;
        }
    }
}
