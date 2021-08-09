

  <!-- ======= Home background Section ======= -->
  <div id="hero" class="" style="padding-top: 25vh"> 
  <!-- d-flex align-items-center -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 pt-5 pt-lg-0 order-2 order-lg-1">
          <h1 class="text-center">Search easier, choose easier.</h1>
          <h2 class="text-center">Get the newest reviews.</h2>
          <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
          
          <div class="row justify-content-center">
              <div class="col-md-12">
                <form class="form-inline d-flex justify-content-center">
                  <?php echo form_open('Ajax'); ?>
                  
                    <input id="search_text" style="width: 100vh" type="search" class="form-control" type="search" placeholder="Which phone are you looking for? (eg: iphone/S20)" aria-label="Search">
                
                    <!-- <button id="show-button" type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search</button> -->
                    <!-- <button id="search-button" type="button" class="btn btn-primary">Button</button> -->
                  <?php echo form_close(); ?>
                </form>
              </div>

              <!-- 结果栏开始隐藏 -->
              <div class="collapse pt-0 px-4 " id="collapseExample">
                
                    <div class="card bg-white border py-0 px-1 mr-0 " style="max-width: 100vh"  id=""> 
                        <div id="result" class=""> </div>
                        
                        <!-- <div class="row">
                          <div class="col-md-12 px-0 mb-0"> -->
                        <a class="btn btn-primary " style="width:100%" href="<?php echo base_url(); ?>UserItemList" role="button">See all items</a>
                          <!-- </div> -->
                        <!-- </div> -->
                    </div>
              
              </div>
              <!-- 显示结果的部分 -->

          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Home background -->

  <!-- 🌟 jQuery AJAX -->
  <script>
      $(document).ready(function(){
        load_data();

        function load_data(query){
          $.ajax({
            url:"<?php echo base_url(); ?>Ajax/fatch",
            method:"GET", // Submit method
            data:{query:query},
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

                    const button = '<button type="button" class="btn btn-primary m-auto"  onclick="location.href=\'<?php echo base_url(); ?>UserItemList/user_review_func?'+val.itemName+'\'">'+'Start Review'+'</button>';                    
                    const newItem = $(
                      '<div class="row card mb-0 mx-0" style="">'
                        // + '<div class="card-header py-0">'
                        //   + '<h3">'+val.itemName+'</h3>'
                        // + '</div>'
                        + '<div class="card-body py-0" >'
                          +'<div class="row">'
                            + '<div class="col-md-2 my-2">'
                              + '<img style="width: 100%;" src="' +'<?php echo base_url(); ?>uploads/admin/img/' +val.filename+ '" />'
                            + '</div>'
                            + '<div class="col-md-7 mt-2">'
                                +'<h6 class="card-title mb-0">Phone: '+val.itemName+'</h6>'
                                +'<h7 class="card-title mb-0">Price: $999</h7><br>'
                                +'<h7 class="card-title mb-0">Storage: 64GB/128GB/256GB</h7><br>'
                                +'<h7 class="card-text text-primary mb-0">Total reviews: 192 </h7>'
                            + '</div>'
                            + ' <div class="row justify-content-center col-md-3 mt-2">'
                                  +button
                            + '</div>'
                          + '</div>'
                        + '</div>'
                      + '</div>')
                    items.push(newItem);
                  });

                  //items只展示前2个结果
                  if(items.length>2) {
                    items = items.slice(0,2)
                  }
                  //🌟 展示搜索到的结果
                  $('#result').append.apply($('#result'), items);         
                }
                else{
                  // $('#result').html("We will add this item in future!");
                  $('#result').append(
                      '<div class="row card mb-0 mx-0">'
                        + '<div class="card-body py-0" >'
                          +'<div class="row">'
                      
                              + '<div class="col-md-12 mt-2">'
                                  +'<h5 class="text-danger py-5" style="padding:0 50px; " >We will add this item in future!</h5>'                        
                              + '</div>'
                            +"</div>"
                          +"</div>"
                      +"</div>"
                    );
                }; 
              };
            }
          });
      }
      
      // 🌟 释放键盘键时会发生keyup事件，触发load_data函数
      $('#search_text').keyup(function(){
        const search = $(this).val();

          // 1/2 如果有输入
          if(search != ''){
            load_data(search);
            $('#collapseExample').css({'display':'block',});
          }
          // 2/2 如果没输入
          else{
            load_data();
            $('#collapseExample').css('display','none');
          }
      });
    });
  </script>
  <!-- 🌟 END jQuery AJAX -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <img src="assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up">Voluptatem dignissimos provident quasi</h3>
            <p data-aos="fade-up" data-aos-delay="100">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
            </p>
            <div class="row">
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-receipt"></i>
                <h4>Corporis voluptates sit</h4>
                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
              </div>
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-cube-alt"></i>
                <h4>Ullamco laboris nisi</h4>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section> -->
    <!-- End About Section -->


    <!-- ======= Popular Review Section ======= -->
    <!-- <section id="team" class="team">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <p>Popular Review</p>
        </div>

        <div class="row">

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member">
              <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Chief Executive Officer</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="member">
              <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Product Manager</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="member">
              <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>CTO</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Amanda Jepson</h4>
                  <span>Accountant</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->
    <!-- End Popular Review Section -->

    <!-- Recently Viewed List Section -->
    <!-- <section id="team" class="team">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <p>Recently Viewed List</p>
        </div>

        <div class="row">

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member">
              <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Chief Executive Officer</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="member">
              <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Product Manager</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="member">
              <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>CTO</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Amanda Jepson</h4>
                  <span>Accountant</span>
                </div>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->
    <!-- End Recently Viewed List Section -->


    <!-- ======= Clients Section ======= -->
    <!-- <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Brand</h2>
          <p>We contain these</p>
        </div>

        <div class="owl-carousel clients-carousel" data-aos="fade-up" data-aos-delay="100">
          <img src="assets/img/clients/client-1.png" alt="">
          <img src="assets/img/clients/client-2.png" alt="">
          <img src="assets/img/clients/client-3.png" alt="">
          <img src="assets/img/clients/client-4.png" alt="">
          <img src="assets/img/clients/client-5.png" alt="">
          <img src="assets/img/clients/client-6.png" alt="">
          <img src="assets/img/clients/client-7.png" alt="">
          <img src="assets/img/clients/client-8.png" alt="">
        </div>

      </div>
    </section> -->
    <!-- End Clients Section -->

    <!-- ======= Join Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Join Us</h2>
          <p>We are looking for the front-end web developer!</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>St Lucia,Brisbane, 4072,Australia</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>dongyu.wu@uqconnect.edu.au</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+61 492364884</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.0923643644414!2d153.01241906583599!3d-27.49750279999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b91508241eb7c49%3A0x9ae9946d3710eee9!2sThe%20University%20of%20Queensland!5e0!3m2!1sen!2sau!4v1618723298085!5m2!1sen!2sau" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
    <!-- End Contact Us Section -->


 
   

  <!-- </main> -->
  <!-- End #main -->

