<?php

    session_start(); //início de sessão. permite estabelecer e trocar informações de sessões entre páginas

    $data = $_SESSION["data"] ?? []; //data recebe os dados da sessão
    $validation = $_SESSION["validation"] ?? []; //validation recebe os dados de erros da sessão

    function checked(string $value, array $list): string
    {
        return in_array($value, $list) ? "checked" : "";
    }

    function checkedGender(string $form, string $gender): string
    {
        return $form === $gender ? "checked" : "";
    }

    function selected(string $form, string $selection): string
    {
        return $form === $selection ? "selected" : "";
    }

    //var_dump($data);
    //var_dump($validation);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <title>Criar Usuário</title>
    </head>
    <body>
        <div class="container mb-3">

            <?php //condição para apresentar as mensagens de erro ?>
            <?php if (count($validation) !== 0) { ?>
                <!-- escrita pra definição de classe do erro -->
                <ul class="alert alert-danger py-2 mt-2" role="alert">
                    <?php //iteração das mensagens de erro ?>
                    <?php foreach ($validation as $error) { ?>
                        <li class="mx-3"><?= $error; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <div class="col-6">
                <h1>Cadastrar Cliente</h1>
                <form method="post" action="store.php" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="name">Nome:</label>
                        <div class="col-6">
                            <input type="text" name="name" id="name" value="<?= $data["name"] ?? ""; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="email">Email:</label>
                        <div class="col-6">
                            <input type="email" name="email" id="email" value="<?= $data["email"] ?? ""; ?>" placeholder="ex.: johndoe@example.com" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="cpf">CPF:</label>
                        <div class="col-6">
                            <input type="text" name="cpf" id="cpf" value="<?= $data["cpf"] ?? ""; ?>" class="form-control">
                            <div class="text-muted">O CPF deve conter pontos e traço.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="phone">Telefone:</label>
                        <div class="col-6">
                            <input type="text" name="phone" id="phone" value="<?= $data["phone"] ?? ""; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label class="col-3 col-form-label">Gênero:</label>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="radio" name="gender" id="female" value="F" <?= checkedGender("F", $data["gender"] ?? ""); ?> class="form-check-input">
                                <label class="form-check-label" for="female">Feminino</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="male" value="M" <?= checkedGender("M", $data["gender"] ?? ""); ?> class="form-check-input">
                                <label class="form-check-label" for="male">Masculino</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            Hobbies:
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="music" value="Música" <?= checked("Música", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="music">Música</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="dance" value="Dança" <?= checked("Dança", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="dance">Dança</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="natural_sciences" value="Ciências da Natureza" <?= checked("Ciências da Natureza", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="natural_sciences">Ciências da Natureza</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="carpentry" value="Carpintaria" <?= checked("Carpintaria", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="carpentry">Carpintaria</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="languages" value="Linguagens" <?= checked("Linguagens", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="languages">Linguagens</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="public_speaking" value="Public Speaking" <?= checked("Public Speaking", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="public_speaking">Public Speaking</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="bird_watching" value="Observação de pássaros" <?= checked("Observação de pássaros", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="bird_watching">Observação de Pássaros</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="mechanics" value="Mecânica" <?= checked("Mecânica", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="mechanics">Mecânica</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="psychology" value="Psicologia" <?= checked("Psicologia", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="psychology">Psicologia</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="programming" value="Programação" <?= checked("Programação", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="programming">Programação</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]"  id="social_sciences" value="Ciências Sociais" <?= checked("Ciências Sociais", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="social_sciences">Ciências Sociais</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobbies[]" id="mathematics" value="Matemática" <?= checked("Matemática", $data["hobbies"] ?? []); ?> class="form-check-input">
                                <label class="form-check-label" for="mathematics">Matemática</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label class="col-3 col-form-label" for="age">Faixa Etária:</label>
                        <div class="col-6">
                            <select name="age" id="age" class="form-select">
                                <option value="">Selecione...</option>
                                <option value="child" <?= selected("child", $data["age"] ?? "") ?>>0 - 18</option>
                                <option value="adult" <?= selected("adult", $data["age"] ?? "") ?> >19 - 65</option>
                                <option value="elder" <?= selected("elder", $data["age"] ?? "") ?>> 65</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="photo">Fotografia:</label>
                        <div class="col-6">
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-3 col-form-label" for="bio">Bio:</label>
                        <div class="col-6">
                            <textarea name="bio" id="bio" rows="4" class="form-control"><?= $data["bio"] ?? ""; ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <button type="submit" class="col-4 me-3 btn btn-primary">Enviar</button>
                        <button type="clear" class="col-4 ms-3 btn btn-outline-secondary">Limpar</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
