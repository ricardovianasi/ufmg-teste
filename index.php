<?php 
	require_once 'Lcd.php';
?>

<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta charset="utf-8">
	<title>Avaliação UFMG</title>	
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	
	<style type="text/css">
	  html,
      body {
        height: 100%;
      }
      
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -60px;
      }

      #push,
      #footer {
        height: 60px;
      	margin-top: 10px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }
      
      .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin form .form-signin-heading,
      .form-signin form .checkbox {
        margin-bottom: 10px;
      }
      .form-signin form input[type="text"],
      .form-signin form input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  
      .form-signin .console {
	  	font-family:Courier;
		color: #CCCCCC;
		background: #000000;
		border: 3px double #CCCCCC;
		padding: 10px;
      	min-height: 50px;
	  }
	</style>
	
</head>

<body>

	<div id="wrap">
		<div class="container">
			<div class="page-header">
            	<h1>LCD Display</h1>
        	</div>
        	
        	<p class="lead">Teste apresentado a UFMG como pr&eacute;-requisito para concorrer a vaga de desenvolvedor senior</p>
      		
      		<?php 
      		if(isset($_POST['enviar'])) {		
      			$tam  = isset($_POST['tamanho']) ? $_POST['tamanho'] : '';
      			$entrada  = isset($_POST['entrada']) ? $_POST['entrada'] : '';
      			$arquivo = isset($_POST['arquivo']) ? $_POST['arquivo'] : false;
      		
      			$lcd = new Lcd($tam, $entrada);
      		} elseif(isset($_POST['limpar'])) {
				$_POST = null;
			}
      		?>
      		<div class="form-signin">
      		<div class="console">
		    	<?php echo isset($lcd) ? $lcd->imprimir($arquivo) : ""; ?>
		    </div>
      		<form method="post" action="">
        		<h3 class="form-signin-heading">Informe os dados</h3>
        		<input type="text" name="tamanho" id="tamanho" class="input-block-level" placeholder="Tamanho dos dígitos" value="<?php echo isset($_POST['tamanho']) ? $_POST['tamanho'] : '';?>">
        		<input type="text" name="entrada" id="entrada" class="input-block-level" placeholder="Informe os números" value="<?php echo $entrada  = isset($_POST['entrada']) ? $_POST['entrada'] : ''; ?>">
        		<label class="checkbox">
          			<input type="checkbox" name="arquivo" value="1"> Salvar em arquivo
        		</label>
        		<p>
        			<button class="btn btn-primary" name="enviar" type="submit">Enviar</button>
        			<button class="btn btn-danger" name="limpar" type="submit">Limpar</button>
        		</p>
      		</form>	
      		</div>

      		
		</div>
		<div id="push"></div>
	</div>
	
	<div id="footer">
      <div class="container">
        <p class="muted credit">Ricardo Soares Viana - ricardovianasi@gmail.com</p>
      </div>
    </div>

</body>

</html>
