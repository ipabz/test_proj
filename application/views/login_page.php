<section class="container-fluid login-form">
  <div class="row">
    <div class="col-md-3"></div>
    <?php print form_open('login', 'class="form-horizontal col-md-6"'); ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Log In</strong></h3>
        </div>
        <div class="panel-body">
          <div class="container-fluid">
            
            <?php
            if ($error !== '') {
            ?>
            <div class="alert alert-danger" role="alert"><?php print $error; ?></div>
            <?php
            }
            ?>
            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email_address" class="form-control" id="inputEmail3" placeholder="Email" value="<?php print set_value('email_address'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" value="<?php print set_value('password'); ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="remember_me" <?php print ((!empty($_POST['remember_me'])) ? "checked" : ""); ?>> Remember me
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </div>
            <div class="pull-right">
              <a href="<?php print site_url('signup'); ?>">Create an a ccount!</a>
            </div>
          </div>
        </div>
      </div>
    <?php print form_close(); ?>
    <div class="col-md-3"></div>
  </div>
</section>    