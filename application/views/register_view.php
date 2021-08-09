<div class="container login" style="height: 120vh;padding-bottom:0vh; margin-bottom:15vh;">
 	<!-- .mx-auto用于通过将水平边距设置为来将定宽块级别的内容 -->
	<!-- mt-5: margin top:5, 最大为5 -->
	<div class="col-12 mx-auto" style="width: 50vh;">  <!-- mt-5 -->
		<?php echo form_open(base_url().'Register/check_register_func'); ?>
			<h1 class="text-center">Register</h1>   

			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="text" class="form-control" placeholder="email" required="required" name="email" value='<?php echo $email; ?>'>
			</div>

			<div class="form-group">
				<label for="email">User name:</label>
				<input type="text" class="form-control" placeholder="name" required="required" name="name" value='<?php echo $name; ?>'>
			</div>

			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" placeholder="password" required="required" name="password">
				<?php echo $passwordStrength; ?>
			</div>


			<div class="d-flex justify-content-center">
				<div class="g-recaptcha" data-sitekey="6LeQEb8aAAAAAA7Qf0oO7kugRPpOpRBf2_70sFUh"></div>
			</div>

			<div class="form-group mt-4">
				<?php echo $error; ?>
			</div>

			<div class="form-group col-12 pb-0 mx-auto" style="width: 40vh;">
				<button type="submit" class="btn primary-color btn-block">Register</button>
				<p class="mt-3 text-left mb-0">By register, I agree to terms & conditions.</p>
			</div>

			<div class="clearfix col-12 mx-auto" style="width: 40vh;">
				<!-- <div class="row">
					<div class="col-12 col-md-12"> -->
						<a href="<?php echo base_url();?>Login" class="float-md-right float-sm-right ">Already has account?</a>
					<!-- </div>
				</div> -->
			</div>
				 
		<?php echo form_close(); ?>
	</div>
</div>

