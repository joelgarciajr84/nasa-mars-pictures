<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Class_HelloMars.php');
$Mars = new HelloMars();

if(isset($_POST['data_das_fotos']) && isset($_POST['select_rover'])){
  $photosdate   = $_POST['data_das_fotos'];
  $rover        = $_POST['select_rover'];
  $images       = json_decode($Mars->getPictures($photosdate, $rover));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Pesquise as Fotos de Marte</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<a href="https://github.com/joelgarciajr84/nasa-mars-pictures"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>

<div class="row row-header" id="top">
  <div class="container">


  <div class="col-lg-6 welcome">
    <h1>Welcome to Mars</h1>
    <hr>
    <p>
      Junte-se a nós na exploração a Marte. <br> Selecione ao lado o dia e qual sonda <br> espacial você deseja e visualize as fotos.
    </p>
  </div>
  <div class="box-api">
    <div align="center">
      <img align="center" src="logo.png" alt="" style=" width: 25%;">
      <img align="center" src="univale.jpg" alt="" style=" width: 25%;">
      <hr>
    </div>
    <div align="center">
      <form method="post" action="#resultado" >
        <fieldset>

          <!-- Form Name -->

          <!-- Text input-->
          <div  class="form-group">
            <label class="col-md-4 control-label" for="Data">Data das Fotos</label>
            <div class="col-md-5">
              <input id="Data" name="data_das_fotos" type="date" value="<?php echo $photosdate; ?>"class="form-control input-md" required>
            </div>
          </div>
          <br>
          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="select_rover">Selecione o Robô</label>
            <div class="col-md-4">
              <select required  id="select_rover" name="select_rover" class="form-control">
                <option value="">Selecione</option>
                <?php
                    foreach ($Mars->rovers as $key => $value):?>
                        <option value="<?php echo $key;?>" <?php if ($rover == $key) {
                            echo "selected";
                        } ?>><?php echo $value;?></option>
                        <?php endforeach;?>
                </select>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <div align="center" class="col-md-4">
                <button  id="enviar" type="submit" name="enviar" class="btn btn-success">Buscar Fotos</button>
                </div
              </div>

            </fieldset>
          </form>
        </div>
  </div>
  </div>
</div>
<?php
if (isset($images) && !isset($images->photos)) {
echo '<script type="text/javascript">alert("Nada encontrado nessa data, tenta outra!?");</script>';

}else{
 ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="bootstrap/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
  </html>

    <div class="container container-result" id="resultado">
      <h2>Resultados:</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>SOL</th>
              <th>CAMERA</th>
              <th>IMG</th>
              <th>DATA</th>
              <th>ROVER</th>

            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($images as $image) {
              for ($i=0; $i < count($image); $i++) { ?>

                <tr>
                  <td><?php echo $image[$i]->id;?></td>
                  <td><?php echo $image[$i]->sol ?></td>
                  <td><?php echo $image[$i]->camera->name?></td>
                  <td align="center">

                    <a  href="<?php echo $image[$i]->img_src; ?>" target="_blank"><img align="center" style="width:50%" src="<?php echo $image[$i]->img_src; ?>" alt="Clique"></a>
                  </td>
                  <td><?php echo date("d/m/Y",strtotime($image[$i]->earth_date));?></td>
                  <td><?php echo $image[$i]->rover->name ?>

                  </td>

                </tr>
                <?php
              }
            }
        }

          ?>

        </tbody>
      </table>
      <?php   if (isset($images) && isset($images->photos)):?>
      <a href="#top">Voltar ao topo (nova pesquisa)</a>
      <br>
      <a href="#resultado">Voltar ao topo do resultado</a>
    <?php endif; ?>
    </div>
  </div>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69269217-1', 'auto');
  ga('send', 'pageview');

</script>
