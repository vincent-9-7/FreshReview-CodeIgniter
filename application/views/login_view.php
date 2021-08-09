<div class="container login">
 	<!-- .mx-auto用于通过将水平边距设置为来将定宽块级别的内容 -->
	<!-- mt-5: margin top:5, 最大为5 -->
	<div class="col-12 mx-auto" style="width: 50vh;">  <!-- mt-5 -->
		<?php echo form_open(base_url().'Login/check_login_func'); ?>
			<h1 class="text-center">Login</h1>   

				<div class="form-group">
					<label for="email">Email address:</label>
					<input type="text" class="form-control" placeholder="email" required="required" name="email" value='<?php echo $email; ?>'>
				</div>

				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" placeholder="password" required="required" name="password">
				</div>

				<div class="form-group">
					<?php echo $error; ?>
				</div>

				<div class="form-group col-12 pb-0 mx-auto" style="width: 40vh;">
					<button type="submit" class="btn primary-color btn-block">Log in</button>
					<p class="mt-3 text-left mb-0">By logging in, I agree to terms & conditions.</p>
				</div>

				<div class="clearfix col-12 mx-auto" style="width: 50vh;">
					<div class="row">
						<div class="col-12 col-md-6">
							<label class="float-left form-check-label">
								<input type="checkbox" name="remember"> Remember me
							</label>
						</div>
						<div class="col-12 col-md-6">
							<a href="<?php echo base_url();?>ResetPassword" class="float-md-right float-sm-left ">Forgot Password?</a>
						</div>
					</div>
				</div>
				 
		<?php echo form_close(); ?>
	</div>
</div>