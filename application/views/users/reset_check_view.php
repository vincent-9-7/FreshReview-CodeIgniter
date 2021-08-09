<div class="container login">
 	<!-- .mx-auto用于通过将水平边距设置为来将定宽块级别的内容 -->
	<!-- mt-5: margin top:5, 最大为5 -->
	<div class="col-12 mx-auto" style="width: 50vh;">  <!-- mt-5 -->
		<?php echo form_open(base_url().'ResetPassword/check_uuid_func'); ?>
			<h1 class="text-center">Reset Password</h1>   

				<div class="form-group">
					<label for="email">Reset Key:</label>
					<input type="text" class="form-control" placeholder="Key In Your Email" required="required" name="key" value=''>
				</div>
        <!-- <?php echo $email; ?> -->
				<div class="form-group">
					<label for="pwd">New Password:</label>
					<input type="password" class="form-control" placeholder="password" required="required" name="newpassword">
				</div>

				<div class="form-group">
					<?php echo $error; ?>
				</div>

				<div class="form-group col-12 pb-0 mx-auto" style="width: 40vh;">
					<button type="submit" class="btn primary-color btn-block">Reset</button>
				</div>

				 
		<?php echo form_close(); ?>
	</div>
</div>