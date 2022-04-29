< script >
    methods: {
        paypal.Button.render({
            env: 'sandbox', // Optional: specify 'sandbox'  environment
            client: {
                sandbox: 'xxxx',
                production: 'xxxx'
            },
            locale: 'en_US',
            style: {
                size: 'large',
                color: 'gold',
                shape: 'pill',
                label: 'checkout',
                tagline: 'true'
            },
            commit: true, // Optional: show a 'Pay Now' button in  the checkout flow


            payment: function (resolve, reject) {
                // Set up the payment here, when the buyer clicks  on the button

                let returnUrl = "_YOUR_RETURN_URL";
                let amount = 20

                //Here call your own API server
                return new Promise((resolve, reject) => {
                    axios.post('/checkout-paypal', {
                        return_url: returnUrl,
                        amount: amount
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' +  state.token
                        }
                    })
                        .then(res => {
                            resolve(res.data.id)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })

            },



            onAuthorize: function (data) {
                // Execute the payment here, when the buyer approves the transaction

                return new Promise((resolve, reject) => {
                    axios.post('/execute-paypal', {
                        payer_id: data.payerID,
                        payment_id: data.paymentID,
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' + state.token
                        }
                    })
                        .then(res => {
                            resolve(res)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })

            }, '#paypal-button')


        /**
         * 
         */
        window.paypal
        .Buttons({
          env: "sandbox",

          // client: {
          //   // sandbox: 'ARQ-WKAkFn3g4C111Ud3lLaUAfzagvJ_pmkLKBVMASvv6nyjX3fv3j0gtBdJEDhRPznYP9sLtf9oiJfH',
          //   // production: 'EFNo9sAyqiOmnlRHsAdXiGBf6ULysEIfKUVsn58Pq6ilfGHVFn03iVvbWtfiht-irdJD_df1MECvmBC2'
          //   sandbox:
          //     "AdPjlYVHhNaucvd-GuZlXFhpIyCwExD5DvmMoh_JAtLZmOnBQYu9FE8zcbEgW4GDBAw89McTC8bvcbNq",
          // },

          locale: "en_US",
          style: {
            size: "small",
            layout: "vertical",
            size: "responsive",
            color: "gold",
            shape: "pill",
            label: "pay",
            // tagline: "true",
          },

          commit: true,

          // payment() is called when the button is clicked
          createOrder: (data, actions) => {
            // Make a call to the REST API to set up the payment
            return actions.order.create({                                          
              purchase_units: [{
                  reference_id: this.orderItems.order_id,
                  description: this.product.description,

                  amount: {
                    currency_code: "USD",
                    value: this.order.grandTotal,       
                  },
                }],
            });
          },
          // onAuthorize() is called when the buyer approves the payment
          onAuthorize: async (data, actions, resp) => {
            const order = await actions.order.capture(details);
            this.form;
            this.orders();

            // Get the payment details
            return actions.payment.get().then(function (paymentDetails) {
              // Show a confirmation using the details from paymentDetails

              // Make a call to the REST API to execute the payment
              return actions.payment
                .execute()
                .then(function () {
                  // Show a success page to the buyer
                  actions.redirect(this.redirect_urls.return_url);                 
                })
                .catch(function (err) {
                  // redirect to error page
                  actions.redirect(this.redirect_urls.cancel_url);                  
                });
            });
            console.log(order);
          },

          onCancel: function (data, actions) {
            // Show a cancel page or return to cart
            actions.redirect(this.redirect_urls.cancel_url);            
          },

          onError: (err) => {
            console.log(err);
          },
        })
        .render(this.$refs.paypal);
        // .render(this.$refs.payment);       
    },


        </script>
