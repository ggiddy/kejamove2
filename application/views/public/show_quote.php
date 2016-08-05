<?php echo form_open('app/post_dispatch'); ?>
    <div class="container tpad">
        <div id="options_carousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <!-- Wrapper for slides -->

            <ul class="nav nav-pills nav-justified">
                <li class="active" id="addons" style="border-right: 3px solid #fff;" data-target="#options_carousel" data-slide-to="0">
                    <a id="addons_anchor" href="#"><strong>1. Select Addons</strong></a></li>
                <li id="dispatch" data-target="#options_carousel" data-slide-to="1">
                    <a id="dispatch_anchor" href="#"><strong>2. Dispatch</strong></a>
                </li>
            </ul>
            <br>
            <hr class="hidden-xs">

            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $request['user_id']; ?>">
            <input type="hidden" name="house_size" id="house_size" value="<?php echo $request['house_size']; ?>">
            <input type="hidden" name="distance" id="distance" value="<?php echo $request['distance']; ?>">

            <div class="carousel-inner">
                <div class="item active" id="addon_selection">
                    <div class="row text-center">
                        <div class="col-xs-12 col-sm-4 limit">
                            <div class="checkbox">
                                <input id="house_cleaning" name="house_cleaning" type="checkbox" value="1">
                                <label for="house_cleaning" style="font-weight: 600">
                                    House Cleaning
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 limit">
                            <div class="text-center">
                                <p>We've partnered with hired help to get you full cleaning of your house at <span style="color: #fd852d;">50% off</span>.</p>
                            </div>
                        </div>
                        <div class="col-sm-4 limit">
                            <div class="text-center">
                                <small>KES.</small><span style="color: #fd852d; font-size: 20px;"><b> 2,000</b></span>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-sm-4 limit">
                            <div class="checkbox">
                                <input id="interior_decorator" name="interior_decorator" type="checkbox">
                                <label for="interior_decorator"  style="font-weight: 600">
                                    Interior Decorator
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 limit">
                            <div class="text-center">
                                <p><span>Want to make your home look stylish?</span></p>
                                <p><span>Get an interior designer to advise on arrangement and decoration.</span></p>
                            </div>
                        </div>
                        <div class="col-sm-4 limit">
                            <div class="text-center">
                                <small>KES.</small><span style="color: #fd852d; font-size: 20px;"><b> 2,000</b></span>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row text-center">
                        <div class="col-sm-offset-4 col-sm-4">
                            <button id="addons_proceed" style=" border-radius: 0 !important;" type="button" class="btn btn-lg btn-warning">
                                <strong>
                                    Proceed
                                    <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                                </strong>
                            </button>
                        </div>

                    </div>
                </div>
                <!-- End Item -->

                <div class="item">
                    <div class="row vertical-divider">
                        <div class="col-xs-12 col-sm-5">
                            <div class="col-xs-8">
                                <p><small id="base_charge_label" class="hidden">Base Charge</small></p>
                                <p><small id="distance_charge_label" class="hidden">Distance Charge</small></p>
                                <p><small id="loaders_label" class="hidden">Helpers</small></p>
                                <p><small id="packaging_label" class="hidden">Packaging Material</small></p>
                                <p><small id="cleaning_label" class="hidden">House Cleaning</small></p>
                                <p><small id="decorator_label" class="hidden">Interior Decorator</small></p>
                                <hr id="labels_hr" style="max-width: 150px;" class="hidden">
                                <p><strong><small id="subtotal_label" class="hidden">Subtotal:</small></strong></p>
                            </div>
                            <div class="col-xs-4">
                                <p><small id="base_charge_cost"></small><p>
                                <p><small id="distance_charge_cost"></small><p>
                                <p><small id="loaders_cost"></small><p>
                                <p><small id="packaging_cost"></small><p>
                                <p><small id="cleaning_cost"></small><p>
                                <p><small id="decorator_cost"></small><p>
                                <hr id="values_hr" style="max-width: 70px;" class="hidden">
                                <p><strong><small id="subtotal"></small></strong></p>
                            </div>
                            <br>

                            <div id="mail_to_self" class="checkbox">
                                <label for="email_quote">
                                    <input id="email_quote" name="email_quote" type="checkbox">
                                    Mail quotation to myself...
                                </label>
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <input id="email_txt" type="email" name="client_email" class="form-control input-lg text-center hidden" placeholder="email address">
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <button
                                    disabled="disabled"
                                    autocomplete="off"
                                    data-loading-text="Sending..."
                                    type="button"
                                    id="send_mail" class="btn btn-lg btn-info hidden">
                                    Send <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                </button>
                                <button
                                    type="button"
                                    id="sent" class="btn btn-lg btn-success hidden">
                                    <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                     Sent
                                </button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <ol>
                                <li>Go to M-PESA on your phone</li>
                                <li>Select Buy Goods option</li>
                                <li>Enter Till No.<strong><span style="color: #fd852d;">871400</span></strong></li>
                                <li>Enter M-PESA PIN and send</li>
                                <li>You will receive a confirmation SMS from M-PESA</li>
                                <li>Enter the confirmation code below</li>
                            </ol>
                            <div class="col-xs-12 col-sm-8 col-md-7">
                                <input style="text-transform: uppercase;"  type="text" name="confirmation_code" class="input-lg form-control text-center" placeholder="M-PESA Code" required minlength="10" maxlength="10">
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-5">
                                <button name="dispatch" style="border-radius: 0px !important;" type="submit" class="btn btn-lg btn-warning">
                                    <strong>
                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                        Dispatch!
                                    </strong>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Item -->
            </div>
            <!-- End Carousel Inner -->

        </div>
        <!-- End Carousel -->
    </div>
</form>

<br><br>
<script src="<?php echo base_url('assets/scripts/quote_carousel.js'); ?>"></script>
<script src="<?php echo base_url('assets/scripts/write_quote.js'); ?>"></script>
<script src="<?php echo base_url('assets/scripts/send_mail.js'); ?>"></script>