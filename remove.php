<?php

session_start();

$id = $_GET["id"];

$lines = file("./applications-data.csv");

$header = array_shift($lines);

foreach ($lines as $key => $line) {

    $parts = explode(";", $line);

    if ($parts[0] == $id) {
        unset($lines[$key]);
    }
}

file_put_contents("./applications-data.csv", "$header");

foreach ($lines as $line) {
    file_put_contents("./applications-data.csv", $line, FILE_APPEND);
}

$_SESSION["flash_message"] = [
    "type" => "success",
    "message" => "Usuário removido com sucesso!"
];

header("Location: ./index.php");
