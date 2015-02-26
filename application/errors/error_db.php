<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Error</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <header id="header">
      <section class="container-fluid">
        <a class="title">Test Project</a>
        
      </section>
    </header>
    
    
    
    <section class="container-fluid" style="padding: 50px;">
      <div class="row">
        <div class="col-md-3"></div>
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title"><strong><?php echo $heading; ?></strong></h3>
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <?php echo $message; ?>
              </div>
            </div>
          </div>
        <div class="col-md-3"></div>
      </div>
    </section>    
    
    
</body>
</html>