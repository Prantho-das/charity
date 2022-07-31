@extends('backend.index')
@section('app')
<div class="alert alert-danger alert-block hidden" id="alert">

    <button type="button" class="close" data-dismiss="alert">×</button>

    <strong id="message"></strong>

</div>
<div class="form-box" id="login-box">
    <div class="header">Card Info</div>
    <div class="body bg-gray">
        <div class="form-group">
            <label for="">Card Holder Name</label>
            <input type="text" id="card-holder-name" class="form-control" placeholder="John Doe"
                value="{{ auth()->user()->name }}" />
        </div>

        <div class="form-group">
            <label for="">Donation Amount(USD):</label>
            <input type="number" min="0" step="1" id="amount" class="form-control" value="10" />
        </div>

    </div>
    <div class="footer">
        <div class="form-group">
            <div id="paypal-button-container"></div>
        </div>

    </div>
</div>
@endsection

@push('script')
<script
    src="https://www.paypal.com/sdk/js?client-id=AZ77_EEI8We5IK4GG3EJaJZrl3LLWZ9u1ShcdgNenMzI2zK71f4mOHzdUajpveD5kL7FExV24wPDyg6-&currency=USD&intent=capture"
    data_source="integrationbuilder"></script>

<script>
    const fundingSources = [
                paypal.FUNDING.PAYPAL
                ]

              for (const fundingSource of fundingSources) {
                const paypalButtonsComponent = paypal.Buttons({
                  fundingSource: fundingSource,

                  // optional styling for buttons
                  // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                  style: {
                    shape: 'pill',
                    height: 40,
                  },

                  // set up the transaction
                  createOrder: (data, actions) => {
                    // pass in any options from the v2 orders create call:
                    // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                    const createOrderPayload = {
                      purchase_units: [
                        {
                          amount: {
                            value: $('#amount').val(),
                          },
                        },
                      ],
                    }

                    return actions.order.create(createOrderPayload)
                  },

                  // finalize the transaction
                  onApprove: (data, actions) => {
                    const captureOrderHandler = (details) => {
                      const payerName = details.payer.name.given_name
                      console.log('Transaction completed!')
                    }
                      fetch('{{url('home.stripe.post')}}',{
                        method:"POST",
                        headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body:JSON.stringify({
                            amount:$('#amount').val(),
                            paid_for:"DONATION",
                            transaction_id:details.token
                        })
                      })
                      .then((val)=>{
                        alert('success')
                      }).catch((err)=>console.log(err))
                    return actions.order.capture().then(captureOrderHandler)
                  },

                  // handle unrecoverable errors
                  onError: (err) => {
                    console.error(
                      'An error prevented the buyer from checking out with PayPal',
                    )
                   // window.location.reload()
                  },
                })

                if (paypalButtonsComponent.isEligible()) {
                  paypalButtonsComponent
                    .render('#paypal-button-container')
                    .catch((err) => {
                      console.error('PayPal Buttons failed to render')
                    })
                } else {
                  console.log('The funding source is ineligible')
                }
              }
</script>
@endpush
