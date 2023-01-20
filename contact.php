<?php
include "include/header.php";
?>
    <section id="contact">
        
        <div class="container-wrapper">
            <div class="container contact-info">
                <div class="row">
				  <div class="col-sm-4 col-md-4">
                        <div class="contact-form"> 
                            <address>
                              <strong>Address.</strong><br>
                              Panchsheel Suryacity Infratech private limited <br>
                              UG-2, Vinayak Central Palja allahabad, allahabad, 
                              <br>Uttar Pradesh, India 211001 .<br>
                              <abbr title="Mobile"></abbr></address>
                              <abbr title="Phone">Phone:-</abbr>+918840019424 <br>
                              <abbr title="email">Email:-</abbr>info.ultrimax@gmail.com</address>
					</div></div>
                    <div class="col-sm-8 col-md-8">                      
						<div class="contact-form">											
						  
		<!--NOTE: Update your email Id in "contact_me.php" file in order to receive emails from your contact form-->
		<form name="sentMessage" id="contactForm"  novalidate> 
		<div class="control-group">
		<div class="controls">
		<input type="text" class="form-control" 
		placeholder="Full Name" id="name" required
		data-validation-required-message="Please enter your name" />
		<p class="help-block"></p>
		</div>
		</div> 	
		<div class="control-group">
		<div class="controls">
		<input type="email" class="form-control" placeholder="Email" 
		id="email" required
		data-validation-required-message="Please enter your email" />
		</div>
		</div> 	

		<div class="control-group">
		<div class="controls">
		<textarea rows="10" cols="100" class="form-control" 
		placeholder="Message" id="message" required
		data-validation-required-message="Please enter your message" minlength="5" 
		data-validation-minlength-message="Min 5 characters" 
		maxlength="999" style="resize:none"></textarea>
		</div>
		</div> 		 
		<div id="success"> </div> <!-- For success/fail messages -->
		<button type="submit" class="btn btn-primary pull-right">Send</button><br />
		</form>

							 					
						</div>
                    </div>
                </div>
            </div>
        </div>
<!-- <div id="google-map" style="height:400px" data-latitude="40.7141667" data-longitude="-74.00638891"></div>    -->
   </section><!--/#bottom-->
   <?php
include "include/footer.php";
?>