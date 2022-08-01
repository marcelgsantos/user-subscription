<?php

require './flash_message.php';

session_start();

// 1. receber a requisição via post
$data = $_POST;
$data["photo"] = $_FILES["photo"];

// 2. validar os dados da requisição
$validationError = validateData($data);

// 3. se tiver erro, redirecionar para a página anterior com erros encontrados
if (count($validationError) !== 0) {
    $_SESSION["data"] = $data;
    $_SESSION["validation"] = $validationError;
    header("Location: ./create.php");
    exit;
}

// 4. caso contrário, adicionar os dados em um arquivo CSV
$extension = explode(".", $data["photo"]["name"])[1];
$hash = md5(rand());
$fileName = $hash . "." . $extension;
$data["fileName"] = $fileName;
move_uploaded_file($data["photo"]["tmp_name"], 'upload/' . $fileName);

$line = implode(";", cleanData($data)) . "\n";
file_put_contents("./applications-data.csv", $line, FILE_APPEND);

// 5. redirecionar para a página anterior com uma mensagem de sucesso
// unset($_SESSION["data"]);
// unset($_SESSION["validation"]);

setFlashMessage('success', 'Usuário inserido com sucesso!', './index.php');

function cleanData(array $data): array
{
    unset($data["photo"]);
    $data["hobbies"] = implode("|", $data["hobbies"]);
    $id = count(file("./applications-data.csv"));
    array_unshift($data, $id);
    return $data;
}

function validateData(array $data): array
{
    $output = [];
    $MEGABYTE = 1024 * 1024;

    if (! greaterThan($data["name"], 5)) {
        $output[] = "O nome deve ter pelo menos 5 caracteres.";
    }

    if (! isCpfValid($data["cpf"])) {
        $output[] = "Insira um CPF válido.";
    }
    
    if (! isEmailValid($data["email"])) {
        $output[] = "O email deve possuir um formato válido.";
    }
    
    if (! isPhoneValid($data["phone"])) {
        $output[] = "Insira um telefone válido.";
    }

    if (! sizeGreaterThan($data["hobbies"] ?? [], 2)) {
        $output[] = "Selecione pelo menos três hobbies.";
    }
    
    if (! isInList($data["age"], ["child", "adult", "elder"])) {
        $output[] = "Selecione pelo menos uma faixa etária.";
    }

    if (! isInList($data["photo"]["type"], ["image/png", "image/jpeg", "image/jpg"])) {
        $output[] = "O arquivo deve ser uma imagem.";
    }

    if ($data["photo"]["error"] != 0) {
        $output[] = "O upload da imagem não foi bem sucedido, tente novamente.";
    }    

    if (! isSizeWithinLimits($data["photo"]["size"], 0, 2 * $MEGABYTE)) {
        $output[] = "Selecione pelo menos uma imagem.";
    }

    if (! greaterThan($data["bio"], 9)) {
        $output[] = "A bio deve ter pelo menos 9 caracteres.";
    }

    return $output;
}

function greaterThan(string $value, int $length): bool
{
    return (strlen($value) >= $length);
}

function sizeGreaterThan(array $list, int $size): bool
{
    return count($list) > $size;
}

function isEmailValid(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isCpfValid(string $value): bool
{
    $regexCpf = "/^[0-9]{3}[\.][0-9]{3}[\.][0-9]{3}[\-][0-9]{2}$/";
    return preg_match($regexCpf, $value);
}

function isPhoneValid(string $value): bool
{
    $regexPhone = "/^[\(][0-9]{2}[\)][\ ][0-9]{5}[-][0-9]{4}$/";
    return preg_match($regexPhone, $value);
}

function isInList(string $item, array $list): bool
{
    return in_array($item, $list);
}

function isSizeWithinLimits(int $element, int $infLimit, int $supLimit): bool
{
    return $element > $infLimit && $element <= $supLimit;   
}

function dump($data): void
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
