<div class="container-fluid fill">
    <div class="intro-text">
        <div class="col-md-12 text-center">
            <h1>Moving made Simple!</h1>
            <h3>Get an instant quote for your house move for free.</h3>
        </div>
    </div>
    <div id="request_details" class="request-details">
        <?php
        $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'id'=>'request_form');
        echo form_open('app/post_request', $attributes);
        ?>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="distance" name="distance" type="hidden">
                        <div class="col-md-offset-1 col-md-2">
                            <input type="text" class="input-lg form-control text-center" name="moving_from" id="moving_from" placeholder="Moving From" required="required">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="input-lg form-control text-center" name="moving_to" id="moving_to" placeholder="Moving To"  required="required">
                        </div>
                        <div class="col-md-2">
                            <select id="bedrooms" name="bedrooms" class="form-control input-lg text-center" required="required">
                                <option value="">Bedrooms</option>
                                <option value="0">Bedsitter</option>
                                <option value="1">1 Bedroom</option>
                                <option value="2">2 Bedroom +</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="input-lg form-control text-center" name="phone" id="phone" placeholder="Phone Number" minlength="10" maxlength="10" required="required" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="submit_request" name="submit_request" class="btn btn-warning btn-lg" disabled>Get a Free Quote</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!--Testimonials div-->
<div class="container-fluid testimonial">
    <div id="myCarousel" class="carousel testimonial slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-md-3 text-center">
                    <div class="testimonial-person">
                        <img src="<?=base_url();?>images/people/testimonials/bett.jpg">
                    </div>
                </div>
                <div class="col-md-9">
                    <p class="">
                        "Very punctual, and very efficient. Great staff who are very polite and
                        professional. I was settled at the new house in record time and with AMAZING
                        convenience. The team is fully of energy and enthusiasm. I was impressed by
                        their expertise in moving furniture even around tricky spaces.
                        That is excellent customer service"
                    </p>
                    <p class="pull-left">
                        - Bett.
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="col-md-3 text-center">
                    <div class="testimonial-person">
                        <img src="<?=base_url();?>images/people/testimonials/beverly.jpg">
                    </div>
                </div>
                <div class="col-md-9 testimonial-body">
                    <p class="">
                        "In 4 hours things were packed in my old house,
                        moved to the new house, the house was spotless at the time everything was at its place. All I
                        had to do is make my bed. And that is because I chose to move with KejaMove"
                    </p>
                    <p class="pull-left">
                        - Beverly Mbeke.
                    </p>
                </div>
            </div>
            <div class="item">
                <div class="col-md-3 text-center">
                    <div class="testimonial-person">
                        <img src="<?=base_url();?>images/people/testimonials/judy.jpg">
                    </div>
                </div>
                <div class="col-md-9 testimonial-body">
                    <p class="">
                        "This team is amazing, they take their time to make sure that when you
                        move everything goes smoothly. Trust me even the most complicated furniture
                        they fixed perfectly without a manual. Thanks Brian and team I surely recommend
                        kejamove."
                    </p>
                    <p class="pull-left">
                        - Judy Mwangi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/location_autocomplete.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/googlemap.js') ?>"></script>

