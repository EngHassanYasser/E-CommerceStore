<x-front-layout title="Order Payment">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

                    <div id="payment-message" style="display:none;" class="alert alert-danger"></div>

                    <form id="payment-form">

                        <div id="payment-element"></div>

                        <button type="submit" id="submit" class="btn mt-3">
                            <span id="button-text">Pay Now</span>
                            <span id="spinner" style="display:none;">Processing...</span>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");

        let elements;

        document.addEventListener("DOMContentLoaded", async function () {

            console.log("Page Loaded");

            await initialize();

            document
                .getElementById("payment-form")
                .addEventListener("submit", handleSubmit);

        });

        async function initialize() {

            try {

                console.log("Creating PaymentIntent...");

                const response = await fetch(
                    "{{ route('orders.payment-intent.create', $order) }}", {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }
                );

                console.log("HTTP Status:", response.status);

                const data = await response.json();

                console.log("Server Response:", data);

                if (!response.ok) {
                    throw new Error(data.message ?? "Unable to create Payment Intent.");
                }

                if (!data.clientSecret) {
                    throw new Error("clientSecret was not returned from server.");
                }

                console.log("Client Secret:", data.clientSecret);

                elements = stripe.elements({
                    clientSecret: data.clientSecret
                });

                const paymentElement = elements.create("payment", {
                    layout: "accordion"
                });

                paymentElement.mount("#payment-element");

                console.log("Stripe Elements Mounted Successfully");

            } catch (error) {

                console.error("Initialize Error:");
                console.error(error);

                showMessage(error.message);

            }

        }

        async function handleSubmit(e) {

            e.preventDefault();

            setLoading(true);

            try {

                console.log("Confirming Payment...");

                const result = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{ route('stripe.return', $order) }}"
                    }
                });

                console.log(result);

                if (result.error) {

                    console.error("Stripe Error:");
                    console.error(result.error);

                    showMessage(result.error.message);
                }

            } catch (error) {

                console.error("Confirm Payment Exception:");
                console.error(error);

                showMessage(error.message);

            } finally {

                setLoading(false);

            }

        }

        function showMessage(message) {

            console.error("Message:", message);

            const container = document.getElementById("payment-message");

            container.style.display = "block";
            container.innerHTML = message;

            setTimeout(() => {

                container.style.display = "none";
                container.innerHTML = "";

            }, 5000);

        }

        function setLoading(isLoading) {

            document.getElementById("submit").disabled = isLoading;

            document.getElementById("spinner").style.display =
                isLoading ? "inline" : "none";

            document.getElementById("button-text").style.display =
                isLoading ? "none" : "inline";

        }
    </script>

</x-front-layout>