<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <title>Trabalho PHP</title>
</head>
<body>
  <?php
    require_once('Usuario.php');
    session_start();
    $errName = '';
    $errPerfil = '';
    $errPass = '';
  
    function perfilUsuario() {
      $usuarioPerfil = '';
      if(!empty($_POST['admbox'])){
        $usuarioPerfil = $usuarioPerfil . $_POST["admbox"];
      }
      if(!empty($_POST['contbox'])){
        $usuarioPerfil = $usuarioPerfil . $_POST["contbox"];
      }
      if(!empty($_POST['finanbox'])){
        $usuarioPerfil = $usuarioPerfil . $_POST["finanbox"];
      }
      return $usuarioPerfil; 
     }

     function idCont() {
      $contId = 0;
       if(!empty($_SESSION['usuarios'])){
          $lastUsu = end($_SESSION['usuarios']);
          $contId = $lastUsu->getId();
       }
      return  $contId  + 1;
     }

     function dateFormat($data){
        $dataFormatada = date("d/m/Y", strtotime($data));
        return $dataFormatada;
     }

    if(isset($_POST['submit'])) {
    
      if(empty($_POST['nomeinput'])) {
        $errName= 'Entre com seu nome';
      }

      else if(empty($_POST['admbox']) & empty($_POST['contbox']) & empty($_POST['finanbox'])) {
        $errPerfil = 'Entre com um perfil';
      }
    
      else if(empty($_POST['password']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
        $errPass = 'Senha incorreta. Deve conter ao menos 8 characters, uma letra maiuscula e um characters especial ';
      } else {
        echo "Usuario salvo com sucesso!";
        $_SESSION["usuarios"][] = new Usuario(
          idCont(), $_POST["nomeinput"], $_POST["selectSexo"], perfilUsuario(), dateFormat($_POST["date"]), $_POST["password"]);
      }
    } 
  ?>

 <div class="container"> 
   <div class="col-md-12">
   <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
         <label for="nomeinput">Nome</label>
         <input type="nome" class="form-control" id="nomeinput" name="nomeinput" placeholder="Nome">
         <?php echo $errName; ?>
      </div>
      <div class="form-group row">
         <label for="selectSexo">Sexo</label>
         <select class="form-control" id="selectSexo" name="selectSexo">
            <option>Masculino</option>
            <option>Feminino</option>
         </select>
      </div>
      <div class="form-group row">
         <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="admbox" value=" Administrador " name="admbox">
            <label class="form-check-label" for="admbox">Administrador</label>
         </div>
         <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="contbox" value=" Contábil " name="contbox">
            <label class="form-check-label" for="contbox">Contábil</label>
         </div>
         <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="finanbox" value=" Financeiro " name="finanbox">
            <label class="form-check-label" for="finanbox">Financeiro</label>
         </div>
         <?php echo $errPerfil; ?>
      </div>
      <div class="form-group row">
            <label for="date">Data de Nascimento</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Data de nascimento">
      </div>
      <div class="form-group row">
            <label for="password">Entre com uma senha para acesso:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
            <?php echo $errPass; ?>
      </div>
      <div class="form-group ">
         <div class="">
            <input type="submit" value="Salvar" name="submit" class="btn btn-primary"/>
         </div>
      </div>
   </form>
   </div>

   <?php if(!empty($_SESSION['usuarios'])) {
     foreach($_SESSION['usuarios'] as $usuario){ ?>
  <table class="table">
    <thead>
  <tr>
   <th scope="col">#</th>
   <th scope="col">Nome</th>
   <th scope="col">Sexo</th>
   <th scope="col">Perfil</th>
   <th scope="col">Data Nascimento</th>
  </tr>
  </thead>
  <tbody>
  <tr>
   <th scope="row"><?= $usuario->getId() ?></th>
   <td><?= $usuario->getNome() ?></td>
   <td><?= $usuario->getSexo() ?></td>
   <td><?= $usuario->getPerfil() ?></td>
   <td><?= $usuario->getDataNascimento() ?></td>
 </tr>
  </tbody>
  </table>
  <?php } ?>
  <?php } ?>
  


 </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>