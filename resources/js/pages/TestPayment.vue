<template>
    <div class="nk-app-root">
        <form id="payment-form">
            <div id="payment-element">
                <!-- Elements will create form elements here -->
            </div>
            <button id="submit">Submit</button>
            <div id="error-message">
                <!-- Display error message to your customers here -->
            </div>
        </form>
    </div>
</template>

<script>
const stripe = Stripe(process.env.MIX_STRIPE_PUBLIC_KEY);

export default {
    mounted(){
        this.loadStripe()
    },
    methods:{
        loadStripe: function() {

            const options = {
                clientSecret: 'seti_1M6HgaG9Oh4TRW8S7DLkCu4F_secret_MpxbaL4q1836oa1CNUXMjQHSfMmWLMC', // @todo dynamic
                // Fully customizable with appearance API.
                appearance: {/*...*/},
            };

            const elements = stripe.elements(options);
            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');

            const form = document.getElementById('payment-form');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {error} = await stripe.confirmSetup({
                    //`Elements` instance that was used to create the Payment Element
                    elements,
                    confirmParams: {
                        // @todo thank you page
                        return_url: 'https://example.com/account/payments/setup-complete',
                    }
                });

                if (error) {
                    // This point will only be reached if there is an immediate error when
                    // confirming the payment. Show error to your customer (for example, payment
                    // details incomplete)
                    const messageContainer = document.querySelector('#error-message');
                    messageContainer.textContent = error.message;
                } else {
                    // Your customer will be redirected to your `return_url`. For some payment
                    // methods like iDEAL, your customer will be redirected to an intermediate
                    // site first to authorize the payment, then redirected to the `return_url`.
                }
            });

        }
    }
}
</script>
