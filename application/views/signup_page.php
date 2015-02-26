<section class="container-fluid signup-form">
  <div class="row">
    <div class="col-md-3"></div>
    <?php print form_open('signup', 'class="form-horizontal col-md-6"'); ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Sign Up</strong></h3>
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
              <label for="inputfirst_name" class="col-sm-2 control-label">First Name</label>
              <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" id="inputfirst_name" placeholder="First Name" value="<?php print set_value('first_name'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputlast_name" class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" id="inputlast_name" placeholder="Last Name" value="<?php print set_value('last_name'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email_address" class="form-control" id="inputEmail3" placeholder="Email" value="<?php print set_value('email_address'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail4" class="col-sm-2 control-label">Repeat Email</label>
              <div class="col-sm-10">
                <input type="email" name="repeat_email_address" class="form-control" id="inputEmail4" placeholder="Repeat Email" value="<?php print set_value('repeat_email_address'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" value="<?php print set_value('password'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputGender" class="col-sm-2 control-label">Gender</label>
              <div class="col-sm-10">
                <?php
                $gender_data = array(
                    '' => '',
                    'M' => 'Male',
                    'F' => 'Female'
                );
                
                print form_dropdown('gender', $gender_data, $this->input->post('gender', TRUE), 'name="gender" class="form-control" id="inputGender"');
                ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <span class="light">By clicking Create Account, you agree to our <a href="">Terms</a> and that you have read our <a href="">Data Policy</a>, including our <a href="">Cookie Use</a>.</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Create Account</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php print form_close(); ?>
    <div class="col-md-3"></div>
  </div>
</section>    <br /><br />