
  
<div class="container">

<div class="row justify-content-around">
  


  <div class="col-md-12 ">
      <h1 class="text-left mb-5 mt-5">Review list of <?php echo $item?></h1>
  </div>

  <table class="table table-striped text-center">
      <thead>
      <tr>
          <th>User Name</th>
          <th>Title</th>
          <th>Comment</th>
          <th>Total Rate</th>
          <th>Value Rate</th>
          <th>Value Rate</th>
          <th>Useable Rate</th>
          <th>Battery Rate</th>
          <th>Camera Rate</th>
          <th>Hardware Rate</th>
      </tr>
      </thead>
      <tbody>
      <?php if(isset($reviews))
          foreach($reviews as $row){
              echo "
                <tr>
                  <td>$row->name</td>
                  <td>$row->title</td>
                  <td>$row->comment</td>
                  <td>$row->totalRate</td>
                  <td>$row->valueRate</td>
                  <td>$row->easyUseRate</td>
                  <td>$row->softwareRate</td>
                  <td>$row->batterLifeRate</td>
                  <td>$row->cameraRate</td>
                  <td>$row->hardwareRate</td>
                </tr>
              ";
          }?>
      </tbody>
  </table>
  
  
</div>
</div>



