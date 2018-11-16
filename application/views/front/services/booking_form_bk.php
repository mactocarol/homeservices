
 
<div class="inner_pages_section"> 
<section class="service padding_60">
<div class="container">
<div class="row payment-main">

<div class="payment-main-container">

<div class="payment-content-wrapper">
<div class="payment-section">
<div class="checkout-row center">
<h2 class="checkout-service-header-text">Complete your booking</h2>
<p class="title-description">Great!  We have availability at this time.  A few more details and we can complete your booking.</p>
</div>
</div>


<div class="availability-lightbox">
<div class="availability-overlay"></div>

<div class="payment-section">
<div class="checkout-row">
<h3>Address</h3>
<div class="h4 hidden address-errors-container"></div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_user_attributes_first_name">First Name</label>
<input class="string optional" id="booking_user_attributes_first_name" maxlength="128" name="booking[user_attributes][first_name]" size="50" type="text">
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_user_attributes_last_name">Last Name</label>
<input class="string optional inspectletIgnore" id="booking_user_attributes_last_name" maxlength="128" name="booking[user_attributes][last_name]" size="50" type="text">
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_address_attributes_address1">Street Address</label>
<input class="string required inspectletIgnore placeholder" id="booking_address_attributes_address1" maxlength="255" name="booking[address_attributes][address1]" placeholder="" size="50" autocomplete="off" type="text">
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_address_attributes_address2">Flat <span class="hide-small"> (optional)</span>
</label><input class="string optional inspectletIgnore" id="booking_address_attributes_address2" maxlength="128" name="booking[address_attributes][address2]" size="50" type="text">
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_address_attributes_city">Town/City</label>
<input class="string required" id="booking_address_attributes_city" maxlength="128" name="booking[address_attributes][city]" size="50" value="" type="text">
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_address_attributes_state">County</label>
<input class="string required" id="booking_address_attributes_state" maxlength="30" name="booking[address_attributes][state]" size="30" value="" type="text">
</div>
</div>



<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="booking_user_attributes_phone">Phone Number</label>
<div class="phone-input-field">
<input class="full_phone optional full-phone-field js-limit-input js-phone-input inspectletIgnore" id="booking_user_attributes_phone" maxlength="14" name="booking[user_attributes][phone]" size="14" type="tel">
<div class="phone-country-code">+44</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12">
<label for="booking_reported_source_id">How did you hear about us? (optional)</label>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="select-wrapper form-select-wrapper"><select class="hb_select optional when-font" id="booking_reported_source_id" name="booking[reported_source_id]"><option value="">Select one</option>
<option value="22">TV</option>
<option value="21">Radio</option>
<option value="5">Facebook</option>
<option value="27">Satellite Radio</option>
<option value="19">Daily Deal Site</option>
<option value="12">Subway / Tube Ad</option>
<option value="15">Rewards Website</option>
<option value="14">Handy Street Team</option>
<option value="13">Newspaper/Magazine</option>
<option value="1">Handy Postcard/Mailer</option>
<option value="16">Friend/Family/Word of Mouth</option>
<option value="17">Search Engine (Google/Yahoo/Bing)</option>
<option value="28">Road Trucks</option></select></div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12">
<label for="coupon">Promo Code (optional)</label>
<input id="quote_request_coupon_id" name="quote_request[coupon_id]" type="hidden">
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<input class="numeric integer optional padding-for-icon" id="coupon" name="coupon" type="text">
<button class="btn-small btn-secondary js-validate-coupon" type="button">Apply</button>
<button class="btn-remove-coupon btn-secondary js-remove-coupon hidden" type="button">Remove</button>
</div>

<div class="small-12 columns error-text" id="coupon_errors"></div>
</div>

</div>



<div class="payment-section">
<div class="col-md-12 col-sm-12 col-xs-12">
<h3>Payment</h3>
</div>
<div class="js-credit-card-entry-box">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="card_number">Credit Card Number</label>
<div class="cardnub">
<input class="js-limit-input padding-for-icon inspectletIgnore" id="card_number" name="card_number" value="" type="tel">
<i class="fa fa-lock card-field-lock"></i>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<img alt="Credit Cards" class="credit-card-icons" src="https://files.handy.com/assets/miscellaneous/payment-strip-c3449295c5ed7f856d24a11f024aa73f.png">
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="expiration">Expiration</label>
<input class="js-cc-date-input inspectletIgnore placeholder" id="expiration" maxlength="5" name="expiration" placeholder="MM/YY" value="" type="text">
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<label for="card_code">Security Code</label>
<input class="inspectletIgnore placeholder" id="card_code" name="card_code" placeholder="CVC" value="" type="tel">
</div>
</div>
</div>

</div>

<div class="payment-section no-border-bottom">
<div class="booking-continue-button-container">
<div class="checkout-row">
<div class="booking-disclaimer-info">
<div class="center smaller">By clicking the button below, I accept Handy's <a href="<?php echo base_url();?>BookingTerms">Terms of Use</a></div>
<input id="terms_of_use" name="terms_of_use" value="1" type="hidden">
<input id="user_preferences" name="booking[user_attributes][user_preferences_attributes][email_opt_in]" value="true" type="hidden">

</div>
<button class="booking-continue-button btn-continue btn-primary js-submit-payment-button" type="submit">Complete Booking</button>
</div>
</div>
</div>

</div>
</div>
</div>


<div class="sidebar-container ">
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="payment-content-wrapper">
<div class="payment-section">
<div class="checkout-row info-row">
<span class="icon-times close-summary js-close-editable-summary"></span>
<div class="payment-info-graphics payment-info-graphics-home">
<i class="fa fa-home"></i>
</div>
<div class="payment-info-content info-sidebar-text">
<strong class="payment-service-name">Moving Help</strong>
<a href="#" data-method="post" rel="nofollow" style="padding-left: 10px">edit</a>
<ul class="js-hospitality-extra-flat-fee-list">
</ul>
<ul class="js-extra-list"></ul>
<ul class="js-extra-flat-fee-list"></ul>
</div>
</div>
<div class="checkout-row info-row">
<div class="payment-info-graphics payment-info-graphics-calendar">
<i class="fa fa-calendar-o"></i>
</div>
<div class="payment-info-content info-sidebar-text">
<p>
23 January 2017 @ 
<span class="nowrap">4:00 pm</span>
</p>
</div>
</div>
<div class="checkout-row info-row">
<div class="payment-info-graphics payment-info-graphics-clock">
<i class="fa fa-clock-o"></i>
</div>
<div class="payment-info-content info-sidebar-text"><p>
<span class="js-job-hours">2</span>
hours
</p></div>
</div>
<div class="checkout-row js-frequency-row hidden info-row">
<div class="payment-info-graphics payment-info-graphics-refresh">
<i class="fa fa-refresh"></i>
</div>
<div class="payment-info-content info-sidebar-text">
<p class="recurring-frequency"></p>
</div>
</div>
</div>
<div class="payment-summary" id="payment_breakdown" style="display: block;">
<div data-symbol="£" id="payment_summary_symbol"></div>
<div data-commitment="no_commitment" id="commitment-type"></div>
<div class="payment-section">
<div class="checkout-row">
<div class="payment-summary-subtotal payment-summary-row" style="display: block;">
<div class="payment-summary-title">Subtotal</div>
<div class="payment-summary-amount">£40.00</div>
</div>
<div class="payment-summary-coupon payment-summary-row hidden" style="">
<div class="payment-summary-title"></div>
<div class="payment-summary-amount">(-£0.00)</div>
</div>
<div class="payment-summary-offer payment-summary-row hidden" style="">
<div class="payment-summary-title">Special Offer</div>
<div class="payment-summary-amount">(-£0.00)</div>
</div>
<div class="payment-summary-row">
<div class="payment-summary-title long-title tns-title">
Trust &amp; Support Fee
<i class="fa fa-question-circle-o gray-icon has-tip tip-top" data-tooltip="" reflow-foundation-tooltip="" data-selector="tooltip-iy46rv280" title=""></i>
</div>
<div class="payment-summary-amount tns-amount">£1.80</div>
</div>
<div class="payment-summary-credits payment-summary-row hidden" style="">
<div class="payment-summary-title">Credits</div>
<div class="payment-summary-amount">(-£0.00)</div>
</div>
</div>
</div>
</div>
<div class="payment-section no-border-bottom">
<div class="checkout-row total-price-row">
<div class="total-price-text">
<span>Total</span>
</div>
<div class="total-price">£<span class="js-total-price" style="display: inline;">41<span class="price-cents">80</span></span><span class="price-suffix"></span></div>
</div>
</div>
</div>

</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<h3 class="center">Questions?</h3>

<div id="accordion" class="panel-group">
<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-caret-right"></i> What’s included in a cleaning service?</a></h4>
</div>
<div id="collapseOne" class="panel-collapse collapse">
<div class="panel-body">See what's included in a cleaning service </div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion"> <i class="fa fa-caret-right"></i>How does your pricing work?</a></h4>
</div>
<div id="collapseTwo" class="panel-collapse collapse">
<div class="panel-body">
<ul>
<li>Our cleanings are priced on a per hour basis, with a minimum booking of 3 hours.</li>
<li>Your full price is based on the number of hours you select.</li>
<li>For a deeper clean, we offer cleaning extras such as fridge or oven cleaning during checkout. Most cleaning extras add one half hour of time and cost to your booking.</li>
</ul></div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapseThree" data-toggle="collapse" data-parent="#accordion"> <i class="fa fa-caret-right"></i>Can I change or cancel my booking? </a></h4>
</div>
<div id="collapseThree" class="panel-collapse collapse">
<div class="panel-body">It’s easy to change or cancel your booking on your bookings page.</div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapsefour" data-toggle="collapse" data-parent="#accordion"> <i class="fa fa-caret-right"></i>What is your cancellation and rescheduling policy? </a></h4>
</div>
<div id="collapsefour" class="panel-collapse collapse">
<div class="panel-body"><ul>
<li>Up to 24 hours before your booking, you may reschedule or cancel for free!</li>
<li>Within the 2–24 hour range before your booking, you may reschedule or cancel for a 10GBP fee.</li>
<li>Within 2 hours of your booking, you may reschedule or cancel, though no refund will be given for these changes.</li>
</ul></div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"> <a class="accordion-toggle" href="#collapse5" data-toggle="collapse" data-parent="#accordion"> <i class="fa fa-caret-right"> </i>Which Handy professional will come to my place? </a></h4>
</div>
<div id="collapse5" class="panel-collapse collapse">
<div class="panel-body"><ul>
<li>Handy has a vast network of friendly, experienced professional cleaners that have been vetted for quality, reliability, and customer satisfaction.</li>
<li>Based on the time and date of your request, we work to assign the best professional available.</li>
<li>Like working with a specific pro? Add them to your Pro Team from the mobile app and they'll be requested first for all future bookings.</li>
<li>You will receive an email with details about your professional prior to your appointment.</li>
</ul></div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapse6" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-caret-right"> </i>Why am I not able to book the time and date I want? </a></h4>
</div>
<div id="collapse6" class="panel-collapse collapse">
<div class="panel-body"><ul> 
<li>We do our very best to provide you with a cleaner at the time and date you request.</li>
<li>During certain times/dates of increased demand, we may restrict appointment availability or suggest alternatives to ensure that a professional is available to complete your service.</li>
</ul></div>
</div>
</div>

<div class="panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a class="accordion-toggle" href="#collapse7" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-caret-right"> </i>I need more help. </a></h4>
</div>
<div id="collapse7" class="panel-collapse collapse">
<div class="panel-body">Need more help?</div>
</div>
</div>

</div>
</div>

</div>

</div>
</div>
</section>
</div>	
	
	
