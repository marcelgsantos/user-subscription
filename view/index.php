<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>

        <div>
            <a href="create.php" class="btn btn-primary">Cadastrar Cliente</a>
        </div>

        <?php if (! empty($flashMessage)): ?>
            <div class="alert alert-<?= $flashMessage["type"] ?>" role="alert">
                <?= $flashMessage["message"]; ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Gênero</th>
                    <th>Hobbies</th>
                    <th>Faixa Etária</th>
                    <th>Mini Bio</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) !== 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user["id"]; ?></td>
                            <td><?= $user["name"]; ?></td>
                            <td><?= $user["email"]; ?></td>
                            <td><?= $user["cpf"]; ?></td>
                            <td><?= $user["phone"]; ?></td>
                            <td><?= $user["gender"]; ?></td>
                            <td><?= implode(", ", explode("|", $user["hobbies"])); ?></td>
                            <td><?= $user["age"]; ?></td>
                            <td><?= $user["bio"]; ?></td>
                            <td><img src="upload/<?= $user["photo"]; ?>"></td>
                            <td><a href="./remove.php?id=<?= $user["id"]; ?>">Remover</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">Nenhum cliente encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
