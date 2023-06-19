<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo1.css">
    <link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">
    <link href="https://fonts.cdnfonts.com/css/pixel12x10" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/depixel" rel="stylesheet">
<link rel="stylesheet" href="cadastro2.css">
  <title>PixelPulse</title>
</head>

<body>
  <header>
    <div class= "logo">
      <img src="PAC.png">
    </div>
  </header>
  <header class="a">
<ul class=" nav">


     <li> <a href="index.html">Início</a></li>

          <li><a href="sobre.html">Sobre</a></li>

          <li><a href="contato.html">Contato</a></li>
        
</ul>
    
    </header>

<div class="container">
    <a href="create.php" class="neon"> + Crie sua publicação! </a>
  </div>

  <?php
$stmt = $pdo->query('SELECT * FROM postagens ORDER BY titulo');
$postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($postagens) == 0) {
    echo '<p>Nenhum compromisso agendado</p>';
} else {
    echo '<table border="1">';
    echo '<thead><tr><th>Título</th><th>Conteúdo</th>';
    echo '<tbody>';

    foreach ($postagens as $postagem) {
        echo '<tr>';
        echo '<td>' . $postagem['titulo'] . '</td>';
        echo '<td>' . $postagem['conteudo'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
?>

</body>
</html>
