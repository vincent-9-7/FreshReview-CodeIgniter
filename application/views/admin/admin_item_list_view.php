
  <div class="container">

 <!-- 🌟 jQuery AJAX -->
 <script>
    $(document).ready(function(){
      load_data();

      function load_data(query){
        $.ajax({
          url:"<?php echo base_url(); ?>Ajax/fatch",
          method:"GET", // Submit method
          data:{query:'totaltotalitem'},
          
          success:function(response){
            // console.log(response)
            $('#result').html("");
            
            if (response == "" ) {
                $('#result').html(response);
            }

            else{
              const obj = JSON.parse(response);
              console.log('result: ',obj)

              if(obj.length>0){
                let items=[];
                $.each(obj, function(i,val){

                  const button = '<button type="button" class="btn btn-primary m-auto"  onclick="location.href=\'<?php echo base_url(); ?>AdminItemList/update?'+val.itemName+'\'">'+'Update Item'+'</button>';                    
                  const newItem = $(
                    '<div class="row card mb-5" style="">'

                      + '<div class="card-header">'
                        + '<h3>Phone name: '+val.itemName+'</h3>'
                      + '</div>'

                      + '<div class="card-body" >'
                        +'<div class="row">'

                          + '<div class="col-md-3 my-2">'
                            + '<img style="width: 100%;" src="' +'<?php echo base_url(); ?>uploads/admin/img/' +val.filename+ '" />'
                          + '</div>'

                          + '<div class="col-md-7 mt-2">'
                              +'<h5 class="card-subtitle pt-2 my-0">Price: $999</h5>'
                              +'<h5 class="card-subtitle py-0 mt-2">Storage: 64GB/128GB/256GB</h5>'
                              +'<h5 class="card-subtitle py-0 mt-2 text-muted">Manufacturer Warranty: One Year</h5>'
                              +'<h5 class="card-text text-primary py-0 mt-2 ">Total reviews: '+val.totalReviews+'</h5>'
                          + '</div>'

                          + ' <div class="row justify-content-center col-md-2 ">'
                                +button
                          + '</div>'

                        + '</div>'
                      + '</div>'
                    + '</div>')
                  items.push(newItem);
                });

                //items只展示前2个结果
                // if(items.length>2) {
                //   items = items.slice(0,2)
                // }
                //🌟 展示搜索到的结果
                $('#result').append.apply($('#result'), items);         
              }
            };
          }
        });
    }
    
  });
</script>
<!-- 🌟 END jQuery AJAX -->

<div class="row justify-content-around">
  
  <div class="col-md-12 ">
      <h1 class="text-left mb-5 mt-5">Items List</h1>
  </div>

  

  <div class="col-md-12 ">
    <button type="button" class="btn btn-primary mb-5" 
            onclick="location.href='<?php echo base_url();?>AdminAddItem'">
            ADD NEW ITEM
    </button>
  </div>

  <!-- 展示所有item -->
  <div class="col-md-12 ">
    <div id="result" class=""> </div>
  </div>

</div>
</div>


