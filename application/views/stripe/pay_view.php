  <style>
      .pay {
        display: flex;
        justify-content: center;
        align-items: center;
        /* background: #242d60; */
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto',
        'Helvetica Neue', 'Ubuntu', sans-serif;
        /* height: 100vh; */
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      #donate {
        background: #CAF0F8;
        /* display: flex; */
        padding-Top:20px;
        padding-bottom:0px;
        /* padding: 20px 10px; */
        flex-direction: column;
        width: 400px;
        /* height: 112px; */
        border-radius: 6px;
        justify-content: space-between;
      }
      .product {
        display: flex;
      }
      .description {
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      h3,
      h5 {
        font-style: normal;
        font-weight: 500;
        font-size: 1.4rem;
        line-height: 20px;
        letter-spacing: -0.154px;
        color: #242d60;
        margin: 0;
      }
      h5 {
        opacity: 0.5;
      }

      img {
    border-radius: 6px;
    margin: 10px;
    width: 54px;
    height: 57px;
      }

    #checkout-button {
    
      height: 36px;
      background: #556cd6;
      color: white;
      width: 100%;
      font-size: 14px;
      border: 0;
      font-weight: 500;
      cursor: pointer;
      letter-spacing: 0.6;
      border-radius: 0 0 6px 6px;
      transition: all 0.2s ease;
      box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
    }
    #checkout-button:hover {
      opacity: 0.8;
    }
  </style>
  
  <div class="pay mb-4">
      <section id="donate">
        <div class="product">
          <img
            src="<?php echo base_url();?>assets/img/good.ico"
            alt="The cover of Stubborn Attachments"
          />
          <div class="description">
            <h3 class="">Like this project? Donate Us</h3>
            <!-- <h5 class="">$20.00</h5> -->
            <h5>Test:4242 4242 4242 4242</h5>
            <h5>4000 0000 0000 9995</h5>
          </div>
        </div>

        <button type="button" id="checkout-button" class="">Pay</button>
      </section>

      <script type="text/javascript">
          // Create an instance of the Stripe object with your publishable API key
          var stripe = Stripe("pk_test_51IcUB9CPFz0OZLZgIfMRgyGOqdXq1k1EBP5xerG9l3Tz5CAVdhHuVolTtcLEIi1h6R2TI3Udc4tsBMBSHeTurb0k00TeaGJPRq");
          var checkoutButton = document.getElementById("checkout-button");

          checkoutButton.addEventListener("click", function () {
            // htdocs/FreshReview/application/views/stripe
            fetch("<?php echo base_url(); ?>Pay", {
              method: "POST",
            })
              .then(function (response) {
                return response.json();
              })
              .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
              })
              .then(function (result) {
                // If redirectToCheckout fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using error.message.
                if (result.error) {
                  alert(result.error.message);
                }
              })
              .catch(function (error) {
                console.error("Error:", error);
              });
          });
        </script>
    </div>
</main>