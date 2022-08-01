<?php

function setFlashMessage(string $type, string $message, string $location): void
{
    $_SESSION["flash_message"] = [
        "type" => $type,
        "message" => $message
    ];

    header("Location: $location");
}

function getFlashMessage(): array
{
    $flashMessage = $_SESSION["flash_message"] ?? [];
    unset($_SESSION["flash_message"]);
    return $flashMessage;
}