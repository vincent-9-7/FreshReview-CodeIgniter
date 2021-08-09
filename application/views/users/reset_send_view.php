<div class="container login">
 	<!-- .mx-auto用于通过将水平边距设置为来将定宽块级别的内容 -->
	<!-- mt-5: margin top:5, 最大为5 -->
	<div class="col-12 mx-auto" style="width: 50vh;">  <!-- mt-5 -->
		<?php echo form_open(base_url().'ResetPassword/send_uuid_func'); ?>
			<h1 class="text-center">Reset Password</h1>   

				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" placeholder="Your register email address" required="required" name="email" value=''>
				</div>
  
				<div class="form-group">
					<?php echo $error; ?>
				</div>

				<div class="form-group col-12 pb-0 mx-auto" style="width: 40vh;">
					<button type="submit" class="btn primary-color btn-block">Send Email</button>
				</div>

				 
		<?php echo form_close(); ?>
	</div>
</div>