
    <div class="container profile">

      <div class="row justify-content-around">
        
        <div class="col-md-12 ">
          <!-- <a href="<?php echo base_url();?>"> -->
            <h1 class="text-left mb-5 mt-5">Profile Settings</h1>
            <!-- <h2 class="text-center">300</h2> -->
          <!-- </a> -->
        </div>

        <div class="col-md-12">
          <!-- style="width: 18rem;" -->
          <div class="card"> 
            <div class="card-header">
              <h3>Email Address</h3>
            </div>

            <div class="card-body">
              <div class="row ">
                <div class="col-md-8">
                  <h4 class="card-title"><?php echo $email; ?></h4>
                  <h6 class="card-subtitle mb-2 text-muted">Email is always private, we will never send you spam.</h6>
                  <?php echo $verifyStatus; ?>
                  <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                </div>

                <div class="col-md-4">
                  <?php echo form_open(base_url().'Profile/check_email_update_func'); ?>
                    <form class="form-inline ">
                      <div class="form-group ">
                        <div class="row ">
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="newEmail" required="required" placeholder="email">
                          </div>

                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Update Email</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php echo form_close(); ?>
                  <?php echo $emailerror; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <!-- style="width: 18rem;" -->
          <div class="card mt-5  "> 
            <div class="card-header">
              <h3>Username</h3>
            </div>

            <div class="card-body">
              <div class="row ">

                <div class="col-md-8">
                  <h4 class="card-title"><?php echo $name; ?></h4>
                  <h6 class="card-subtitle mb-2 text-muted">Username will be shown in your reviews.</h6>
                </div>

                <div class="col-md-4">
  
                  <?php echo form_open(base_url().'Profile/check_name_update_func'); ?>
                    <form class="form-inline ">
                      <div class="form-group ">
                        <div class="row ">
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="newName" required="required" placeholder="name">
                          </div>

                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Update Name</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php echo form_close(); ?>
                  <?php echo $nameerror; ?>
                </div>
              </div>

            </div>

          </div>

        </div>
        

        <div class="col-md-12">
          <!-- style="width: 18rem;" -->
          <div class="card my-5  "> 
            <div class="card-header">
              <h3>Password</h3>
            </div>

            <div class="card-body">
              <div class="row ">

                <div class="col-md-8">
                  <h4 class="card-title">********</h4>
                  <h6 class="card-subtitle mb-2 text-muted">Please keep your password private.</h6>
                </div>

                <div class="col-md-4">
  
                  <?php echo form_open(base_url().'Profile/check_password_update_func'); ?>
                    <form class="form-inline ">
                      <div class="form-group ">
                        <div class="row ">
                          <div class="col-md-6">
                            <input type="password" class="form-control" name="newPassword" required="required" placeholder="password">
                          </div>

                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Update Password</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php echo form_close(); ?>
                  <?php echo $passworderror; ?>
                </div>
              </div>

            </div>

          </div>

        </div>

        <div class="col-md-12">
          <!-- style="width: 18rem;" -->
          <div class="card my-5  "> 
            <div class="card-header">
              <h3>Phone number</h3>
            </div>

            <div class="card-body">
              <div class="row ">

                <div class="col-md-8">
                  <h4 class="card-title"><?php echo $phoneNum; ?></h4>
                  <h6 class="card-subtitle mb-2 text-muted">Testing: +6149236----</h6>
                </div>

                <div class="col-md-4">
  
                  <?php echo form_open(base_url().'TwilioSMS'); ?>
                    <form class="form-inline ">
                      <div class="form-group ">
                        <div class="row ">
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="phonenumber" required="required" placeholder="number">
                          </div>

                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Verify Number</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php echo form_close(); ?>
                  <!-- <?php echo $passworderror; ?> -->
                </div>
              </div>

            </div>

          </div>

        </div>
        
      </div>
    </div>

