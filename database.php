<?php

function getUsers(): array
{
    $lines = file("./applications-data.csv");

    $header = array_shift($lines);

    $users = [];

    foreach ($lines as $line) { //array map
        $data = explode(";", $line);
        $users[] = [
            'id' => $data[0],
            'name' => $data[1],
            'email' => $data[2],
            'cpf' => $data[3],
            'phone' => $data[4],
            'gender' => $data[5],
            'hobbies' => $data[6],
            'age' => $data[7],
            'bio' => $data[8],
            'photo' => $data[9]
        ];
    }
    return $users;
}
