
<style>
  #drop-zone {
    /*Sort of important*/
    width: 300px;
    /*Sort of important*/
    height: 200px;
    /* position:absolute; */
    left:50%;
    /* top:100px; */
    margin-left:-150px;
    border: 2px dashed rgba(0,0,0,.3);
    /* border-radius: 20px; */
    /* font-family: Arial; */
    text-align: center;
    position: relative;
    line-height: 180px;
    /* font-size: 20px; */
    color: rgba(0,0,0,.3);
  }

  #drop-zone input {
      position: absolute;
      cursor: pointer;
      left: 0px;
      top: 0px;
      height:195px;
      width:295px;
      font-size: 1rem;
      color:black;
      /* position: */
      /*Important This is only comment out for demonstration purposes.
      opacity:0; */
  }

  #clickHere {
    cursor: pointer;
    line-height: 26px;
    width: 295px;
    height: 195px;
    border-radius: 4px;
    background: #fef8f5;
  }
</style>

<!-- drag file js -->
<script>
  $(function () {
      var dropZoneId = "drop-zone";
      // var buttonId = "clickHere";
      var dropZone = $("#" + dropZoneId);

      var inputFile = dropZone.find("input");
      document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
          e.preventDefault();
          e.stopPropagation();
      }, true);
  })
</script>

  <div class="container" >
    <!-- style="height:91vh;" -->
    <div class="row justify-content-around">
      <div class="col-md-12 ">
        <!-- <a href="<?php echo base_url();?>"> -->
          <h1 class="text-left mb-5 mt-5">Add Item</h1>
          <!-- <h2 class="text-center">300</h2> -->
        <!-- </a> -->
      </div>

      <div class="col-md-12" >
        <!-- style="width: 18rem;" -->
        <div class="card mb-5" > 
          <div class="card-body">
            <div class="row ">
              <div class="col-md-12">
                <?php echo form_open_multipart(base_url().'AdminAddItem/admin_add_item_func'); ?>
            
                  <form class="form-inline">
                    <div class="form-group pb-0">
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" placeholder="phone name" required name="name" value=''>
                      <?php echo $itemerror; ?>
                    </div>

                    <div class="form-group">
                      <label for="name">Price:</label>
                      <input type="text" class="form-control" placeholder="phone price" required  name="price" value=''>
                    </div>

                    <div class="form-group">
                      <label for="name">Storage:</label>
                      <input type="text" class="form-control" placeholder="phone storage" required  name="storage" value=''>
                    </div>

                    <div class="form-group">
                      <label for="name">Image:</label>
                      <br>
                      <div id="drop-zone">
                          <div id="clickHere">
                              <input type="file" name="itemImg" required size="20" id="file" />
                          </div>
                      </div>
                      <?php echo $imgerror; ?>
                    </div>

                    <div class="row justify-content-center">
                      <button type="submit" class="btn btn-primary px-5 my-2">Submit</button>
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

