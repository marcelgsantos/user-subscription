<?php

function getUsers(): array
{
    $lines = file("./applications-data.csv");
    $header = array_shift($lines);
    return array_map(function($line) {
        $keys = ['id', 'name', 'email', 'cpf', 'phone', 'gender', 'hobbies', 'age', 'bio', 'photo'];
        $values = explode(";", $line);
        return array_combine($keys, $values);
    }, $lines);
}

function removeUser(string $id): void
{
    $lines = file("./applications-data.csv");
    $header = array_shift($lines);

    $remainingLines = array_filter($lines, fn ($line) => explode(';', $line)[0] !== $id);
    file_put_contents('./applications-data.csv', [$header, ...$remainingLines]);
}