    <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                                <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[shipping][first_name]" placeholder="First Name"/>
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                        <x-form.input name="addr[shipping][last_name]" placeholder="Last Name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][email]" placeholder="Email Address"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone Number</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][phone_number]" placeholder="Phone Number"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Mailing Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][street_address]" placeholder="Mailing Address"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][city]" placeholder="City"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                    <x-form.input name="addr[shipping][postal_code]" placeholder="Post Code"/>
                                                    </div>
                                                </div>
                                            </div>
                                                                                    <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Region/State</label>
                                                    <div class="select-items">
                                                        <x-form.input name="addr[shipping][state]" placeholdr="state"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Country</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="addr[shipping][country]" :options="$countries"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="heading-6 font-weight-400 payment-title">Select Delivery
                                                        Option</h6>
                                                    <div class="payment-option-wrapper">
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" checked id="shipping-1">
                                                            <label for="shipping-1">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-2">
                                                            <label for="shipping-2">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-3">
                                                            <label for="shipping-3">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-4">
                                                            <label for="shipping-4">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">previous</button>
                                                    <a href="javascript:void(0)" class="btn btn-alt">Save & Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>