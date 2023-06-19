<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/pixel12x10" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/depixel" rel="stylesheet">
<link rel="stylesheet" href="cadastro.css">
    <title>Document</title>
</head>
<body background="Design sem nome.png">
<div class="container_form">

 <?php
if (isset($_POST['submit'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dtnasc = $_POST['dtnasc'];
    $estadocivil = $_POST['estadocivil'];
    $sexo = $_POST['sexo'];


$stmt = $pdo->prepare('SELECT COUNT(*)
FROM blog_corporativo WHERE email = ?');
$stmt->execute([$email]);
$count = $stmt->fetchColumn();

if($count > 0) {
    $error ='Já existe uma conta com esse email.';
}else{
    
    $stmt = $pdo->prepare('INSERT INTO blog_corporativo (nome, email, dtnasc, estadocivil, sexo) VALUES(:nome, :email, :dtnasc, :estadocivil, :sexo)');
    $stmt->execute(['nome' => $nome, 'email' => $email, 'dtnasc' => $dtnasc, 'estadocivil'=> $estadocivil, 'sexo' => $sexo ]);

    if($stmt->rowCount()){
        echo'<span>Conta criada com sucesso!</span>';
    }else{
        echo '<span>Erro ao realizar cadastro. Tente novamente mais tarde</span>';
    }
   
    }
    if(isset($error)){
        echo '<span>' . $error . '</span>';
    }
        }
   
        ?>


        <h1>Formulário de Cadastro</h1>
        <form class="form" method="post">
            
            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="text" name="nome" class="form_input" id="nome" placeholder="Nome" required>
            </div>
            
            <div class="form_grupo">
                <label for="email" class="form_label">Email</label>
                <input type="email" name="email" class="form_input" id="email" placeholder="seuemail@email.com" required>
            </div>
            
            <div class="form_grupo">
                <label for="dtnasc" class="form_label">Data de Nascimento</label>
                <input type="date" name="dtnasc" class="form_input" id="datanascimento" placeholder="Data de Nascimento" required>
            </div>        
            <div class="form_grupo">
                
                <label for="estadocivil" class="text">Estado civil</label>
                <select name="estadocivil" class="dropdown" required>
                    
                    <option selected disabled class="form_select_option" value="">Selecione</option>
                    <option value="Solteiro" class="form_select_option">Solteiro(a)</option>
                    <option value="Casado" class="form_select_option">Casado(a) </option>
                    <option value="Divorciado" class="form_select_option">Divorciado(a)</option>                    
                    <option value="Viúvo" class="form_select_option">Viúvo(a)</option>                    
                
                </select>
            </div>
            <div class="form_grupo">
                <span class="legenda">Sexo:</span>
                
                <div class="radio-btn">
                    <input type="radio" class="form_new_input" id="masculino" name="sexo" value="Masculino" required="required">
                    <label for="masculino" class="radio_label form_label"> <span class="radio_new_btn"></span> Masculino</label>
                </div>
                <div class="radio-btn">
                    <input type="radio" class="form_new_input" id="feminino" name="sexo" value="Feminino" required="required">
                    <label for="feminino" class="radio_label form_label"> <span class="radio_new_btn"></span> Feminino</label>
                </div>
            </div>

            <div class="submit">
                <input type="hidden" name="acao" value="enviar">
                <button type="submit" name="submit" value="agendar">CADASTRAR</button>
                <button><a href="cadastro2.php">Voltar</a></button>
                
              
              </div>
      </form>

</div>

</body>
</html>


