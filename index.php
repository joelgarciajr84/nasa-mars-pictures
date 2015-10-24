<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Class_HelloMars.php');
$Mars = new HelloMars();
require('wideimage/lib/WideImage.php');
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
  </head>
  <body>
<style>
	td{
		text-align: center !important;
	}
</style>
    <h1 align="center">Fotos de Marte</h1>
    <div align="center">
    	<img align="center" src="logo.png" alt="" style=" width: 10%;">
	<img align="center" src="univale.jpg" alt="" style=" width: 10%;">
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
<div align="center">
<form method="post" action="" >
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
	
	}elseif(isset($images) && is_array($images)){?>
	<div class="container">
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