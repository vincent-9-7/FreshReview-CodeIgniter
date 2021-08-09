<?php echo form_open(base_url().'email/send'); ?>
<div class="container">
			<div class="col-md-12 ">
					<h1 class="text-left mb-5 mt-5">Send Email</h1>
			</div>

			<div class="form-group">
					<label for="to" class="col-sm-1 control-label">To:</label>
					<div class="col-sm-11">
						<input name="to" type="email" class="form-control select2-offscreen" id="to" placeholder="Type email" tabindex="-1">
					</div>
			</div>

			<div class="form-group">
					<label for="subject" class="col-sm-1 control-label">Subject:</label>
					<div class="col-sm-11">
						<input name="subject" class="form-control select2-offscreen" id="subject" placeholder="Type title" tabindex="-1">
					</div>
			</div>		

			<br/>

			<div class="form-group">
				<textarea name="msg" class="form-control col-sm-11" id="message" name="body" rows="9" placeholder="Mail"></textarea>
			</div>
				
			<div class="form-group">	
				<button type="submit" class="btn btn-primary mb-2">Send</button>
			</div>
</div>
<?php echo form_close(); ?>