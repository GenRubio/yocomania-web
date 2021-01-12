<div>
    <div class="row text-center justify-content-center">
        @foreach ($productos as $producto)
            <a wire:click="registerTrans({{ auth()->user()->id }}, '{{ $producto->token }}')" type="button" class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3 p-0 {{ $producto->token }}" style="height: 210px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('');
                text-decoration: none;">
                <div class="d-flex justify-content-end flex-column" style="width: 100%; height: 100%;">
                    <div style="background-color: #0000007a; height: 50px;">
                        <h4 class="mt-2"><strong style="color:whitesmoke">{{ $producto->nombre }}</strong>
                            <h4>
                    </div>
                    <div class="rounded-bottom" style="background-color: #000000b8; height: 35px;">
                        <h6 class="mt-2"><strong style="color: gold">{{ $producto->precio }}</strong></h6>
                    </div>
                </div>
            </a>
            <!-- Load Stripe.js on your website. -->
            <script src="https://js.stripe.com/v3"></script>
            <script>
                (function() {
                    var stripe = Stripe(
                        'pk_test_51I7cy4I5NFYJjszOzAOMI5VyW7ACbZyBwVaB195Zoj36RCAQEmIiKVMfIxFOubmYlNk1HkhvUfRvUSDw7V3P3O1100j7R62AVo'
                    );
                    $('.{{ $producto->token }}').click(function(e) {
                        stripe.redirectToCheckout({
                                lineItems: [{
                                    price: '{{ $producto->token }}',
                                    quantity: 1
                                }],
                                mode: 'payment',
                                successUrl: "{{ route('tienda.pagos') }}",
                                cancelUrl: "{{ route('tienda.pagos') }}",
                            })
                            .then(function(result) {
                                if (result.error) {
                                    var displayError = document.getElementById('error-message');
                                    displayError.textContent = result.error.message;
                                }
                            });
                    })
                })();

            </script>
        @endforeach
    </div>
</div>
