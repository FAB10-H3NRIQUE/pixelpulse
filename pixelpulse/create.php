<?php
 require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">
    <link href="https://fonts.cdnfonts.com/css/pixel12x10" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/depixel" rel="stylesheet">
<link rel="stylesheet" href="cadastro.css">
    <title>Página de cadastro</title>
</head>
<body background="Design sem nome.png">
    <div class="container_form">

    <?php
if (isset($_POST['submit'])){
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];


$stmt = $pdo->prepare('SELECT COUNT(*)
FROM postagens WHERE titulo = ?');
$stmt->execute([$titulo]);
$count = $stmt->fetchColumn();

if($count > 0) {
    $error ='Já existe uma postagem com esse título.';
}else{

    $stmt = $pdo->prepare('INSERT INTO postagens (titulo, conteudo) VALUES(:titulo, :conteudo)');
    $stmt->execute(['titulo' => $titulo, 'conteudo' => $conteudo]);

    if($stmt->rowCount()){
        echo'<span>Postagem adicionada com sucesso!</span>';
    }else{
        echo '<span>Erro ao adicionar postagem</span>';
    }
   
    }
    if(isset($error)){
        echo '<span>' . $error . '</span>';
    }
        }
   
        ?>

        <h1>CRIE SUA POSTAGEM!</h1>
        <form class="form" method="post">
            
            <div class="form_grupo" >
                <label for="titulo" class="form_label">Título da sua publicação</label>
                <input type="text" name="titulo" class="form_input" id="nome" placeholder="Título" required>
            
                <label for="conteudo" class="form_label">Insira o conteúdo!</label>
                <input type="textarea" name="conteudo" class="form_input" id="nome" placeholder="Conteúdo" required>
            </div>

            <div class="submit">
                <input type="hidden" name="acao" value="enviar">
                <button type="submit" name="submit" class="submit_btn">Criar</button>
                <button><a href="cadastro2.php">Voltar</a></button>
              </div>
      </form>
</body>
</html>