<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('Class_HelloMars.php');
$Mars = new HelloMars();
#require('wideimage/lib/WideImage.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Fotos de Marte</title>


  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
  <style>
  body {
    background: #000;
  }

  h1,h2,h3,h4,h5,h6 {
    font-family: font-family: 'Ubuntu', sans-serif;
  }
  .row-header {
    background: url('images/background.jpg');
    background-size: 100%;
    margin-bottom: 50px;
  }

  .container-result {
    background-color: #FFF;
    padding: 25px;
  }
  .box-api {
    margin-top: 100px;
    margin-bottom: 150px;
    padding: 25px;
    width: 35%;
    margin-left: 50%;
    background-color: rgba(98,40,25,0.7);
    border-radius: 5px;
    color: #FFF;
    text-align: left;
    font-family: arial, sans-serif;
    font-weight: bolder;


  }
  .welcome {
    float:left;
    color:#FFF;
    margin-top: 220px;
    text-shadow: 9px 4px 17px rgba(7, 7, 7, 0.73);
    font-family: 'Ubuntu', sans-serif;
  }
  .welcome p {
    color: #FFF;
    font-size: 19px;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 500;
    text-shadow: 3px 2px 4px rgba(7, 7, 7, 0.98);
    line-height: 1.5em;
  }
  td{
    text-align: center !important;
  }
  </style>
<div class="row row-header">
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
              <input id="Data" name="data_das_fotos" type="date" placeholder="Data das fotos" class="form-control input-md" required="">
            </div>
          </div>
          <br>
          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="select_rover">Selecione o Robô</label>
            <div class="col-md-4">
              <select required  id="select_rover" name="select_rover" class="form-control">
                <option  value="">Selecione</option>
                <?php
                foreach ($Mars->rovers as $key => $value) {?>
                  <option value="<?php echo $key ?>"><?php echo $value ?></option>
                  <?php } ?>
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





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="bootstrap/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
  </html>
  <?php
  if(isset($_POST['data_das_fotos']) && isset($_POST['select_rover'])){
    $photosdate = $_POST['data_das_fotos'];
    $rover = $_POST['select_rover'];
    $images = json_decode($Mars->getPictures($photosdate, $rover));
  }
  if (isset($images) && empty($images)) {
    echo "No images found :(";

  }elseif(isset($images)){?>
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
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
