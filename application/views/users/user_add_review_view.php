
<style>
  .starrating > input[type="radio"] {
    position: absolute;
    /* left:25px; */
    opacity: 0;
    cursor: pointer;
    /* height: 0;
    width: 0; */
    /* display: none; */
  }
  /* .starrating > input {display: none;}  Remove radio buttons */
  .starrating {
    display: flex;
      flex-direction: row-reverse;
      justify-content: flex-end	
  }

  .starrating > label
  {
    /* color: #FFD600; Start color when not clicked */
    display: inline-block;  */
    width: 1em;
    font-size: 3vw;
    padding-right:15px;
    color: #FFD600;
    cursor: pointer
  }
  .starrating > label:before { 
    content: "\2605";
    position: absolute;
    opacity: 0

  }

  .starrating>label:hover:before,
  .starrating>label:hover~label:before {
      opacity: 1 !important
  }
  .starrating>input:checked~label:before {
      opacity: 1
  }
</style>


<div class="container ">

      <div class="row justify-content-around">
        
        <div class="col-md-12 ">
            <h1 class="text-left mb-5 mt-5">Write a review</h1>
        </div>

        <div class="col-md-12">
          <!-- style="width: 18rem;" -->
          <div class="card"> 
            <div class="card-header">
              <h3>Review of: <?php echo $item; ?></h3>
            </div>

            <div class="card-body">
              <div class="row ">

              <div class="col-md-4">
                <img style='width: 100%;' src="<?php echo base_url(); ?>uploads/admin/img/<?php echo $img; ?>" />
              </div>

                <div class="col-md-8">
                  <?php echo form_open(base_url().'UserItemList/user_update_review_func'); ?>
                    <form class="form-inline ">

                      <div class="form-group ">
                        <!-- <div class="row "> -->
                          <!-- <div class="col-md-12"> -->
                            <h4 for="title">Review Title:</h4>
                            <input type="text" class="form-control col-md-12" name="title" required placeholder="Please write a review title">
                          <!-- </div> -->
                        <!-- </div> -->
                      </div>

                      <div class="form-group">
                        <h4 for="comment">Your Review:</h4>
                        <textarea type="text" class="form-control col-md-12" name="comment" required placeholder="Please write your review" ></textarea>
                      </div>

                      <div class="form-group">
                        <h4 for="comment">Your Total Rating:</h4>
                        <div class="starrating">
                          <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                              <input required type="radio" id="totalstar5" name="totalrating" value="5"/><label for="totalstar5" title="5 star">☆</label>
                              <input type="radio" id="totalstar4" name="totalrating" value="4" /><label for="totalstar4" title="4 star">☆</label>
                              <input type="radio" id="totalstar3" name="totalrating" value="3" /><label for="totalstar3" title="3 star">☆</label>
                              <input type="radio" id="totalstar2" name="totalrating" value="2" /><label for="totalstar2" title="2 star">☆</label>
                              <input type="radio" id="totalstar1" name="totalrating" value="1" /><label for="totalstar1" title="1 star">☆</label>
                          </div>
                        </div>	
                      </div>
                      
                      <div class='row'>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Value for money:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="valuestar5" name="valuerating" value="5" /><label for="valuestar5" title="5 star">☆</label>
                                  <input type="radio" id="valuestar4" name="valuerating" value="4" /><label for="valuestar4" title="4 star">☆</label>
                                  <input type="radio" id="valuestar3" name="valuerating" value="3" /><label for="valuestar3" title="3 star">☆</label>
                                  <input type="radio" id="valuestar2" name="valuerating" value="2" /><label for="valuestar2" title="2 star">☆</label>
                                  <input type="radio" id="valuestar1" name="valuerating" value="1" /><label for="valuestar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Easy of use:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="easystar5" name="easyrating" value="5" /><label for="easystar5" title="5 star">☆</label>
                                  <input type="radio" id="easystar4" name="easyrating" value="4" /><label for="easystar4" title="4 star">☆</label>
                                  <input type="radio" id="easystar3" name="easyrating" value="3" /><label for="easystar3" title="3 star">☆</label>
                                  <input type="radio" id="easystar2" name="easyrating" value="2" /><label for="easystar2" title="2 star">☆</label>
                                  <input type="radio" id="easystar1" name="easyrating" value="1" /><label for="easystar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>
                      </div>

                      <div class='row'>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Software usability:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="softwarestar5" name="softwarerating" value="5" /><label for="softwarestar5" title="5 star">☆</label>
                                  <input type="radio" id="softwarestar4" name="softwarerating" value="4" /><label for="softwarestar4" title="4 star">☆</label>
                                  <input type="radio" id="softwarestar3" name="softwarerating" value="3" /><label for="softwarestar3" title="3 star">☆</label>
                                  <input type="radio" id="softwarestar2" name="softwarerating" value="2" /><label for="softwarestar2" title="2 star">☆</label>
                                  <input type="radio" id="softwarestar1" name="softwarerating" value="1" /><label for="softwarestar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Battery life:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="batterystar5" name="batteryrating" value="5" /><label for="batterystar5" title="5 star">☆</label>
                                  <input type="radio" id="batterystar4" name="batteryrating" value="4" /><label for="batterystar4" title="4 star">☆</label>
                                  <input type="radio" id="batterystar3" name="batteryrating" value="3" /><label for="batterystar3" title="3 star">☆</label>
                                  <input type="radio" id="batterystar2" name="batteryrating" value="2" /><label for="batterystar2" title="2 star">☆</label>
                                  <input type="radio" id="batterystar1" name="batteryrating" value="1" /><label for="batterystar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>
                      </div>

                      <div class='row'>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Camera quality:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="camerastar5" name="camerarating" value="5" /><label for="camerastar5" title="5 star">☆</label>
                                  <input type="radio" id="camerastar4" name="camerarating" value="4" /><label for="camerastar4" title="4 star">☆</label>
                                  <input type="radio" id="camerastar3" name="camerarating" value="3" /><label for="camerastar3" title="3 star">☆</label>
                                  <input type="radio" id="camerastar2" name="camerarating" value="2" /><label for="camerastar2" title="2 star">☆</label>
                                  <input type="radio" id="camerastar1" name="camerarating" value="1" /><label for="camerastar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <h4 for="comment">Hardware performance:</h4>
                            <div class="starrating">
                              <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                  <input required type="radio" id="hardwarestar5" name="hardwarerating" value="5" /><label for="hardwarestar5" title="5 star">☆</label>
                                  <input type="radio" id="hardwarestar4" name="hardwarerating" value="4" /><label for="hardwarestar4" title="4 star">☆</label>
                                  <input type="radio" id="hardwarestar3" name="hardwarerating" value="3" /><label for="hardwarestar3" title="3 star">☆</label>
                                  <input type="radio" id="hardwarestar2" name="hardwarerating" value="2" /><label for="hardwarestar2" title="2 star">☆</label>
                                  <input type="radio" id="hardwarestar1" name="hardwarerating" value="1" /><label for="hardwarestar1" title="1 star">☆</label>
                              </div>
                            </div>	
                          </div>
                        </div>
                      </div>
                      
                      <label class="float-left form-check-label">
                        <input type="checkbox" name="anonymous"> Anonymous Review
                      </label>

                      <div class="col-md-5 offset-md-3 mt-5">      
                        <button type="submit" class="btn btn-primary mb-2" style="width:100%">Submit Review</button>
                      </div>

                    </form>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

