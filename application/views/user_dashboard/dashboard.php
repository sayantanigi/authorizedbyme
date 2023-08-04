    <section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
        <div class="container">
            <div class="">
                <h3 class="fw-semibold">Dashboard</h3>
                <div >
                    <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    
	<section class="py-5">
		<div class="container">
			<ul class="navlist-profile">
		        <li><a href="<?= base_url()?>profile/dashboard" class="active">Profile</a></li>
		        <li><a href="<?= base_url()?>profile/teams">Teams</a></li>
		        <li><a href="<?= base_url()?>profile/matches">Matches</a></li>
		    </ul>
		    <div class="divider my-2"></div>
		    <div class="mt-4">
		    	<h3 class="h4 fw-bold text-uppercase text-center text-primary mb-4">Update Profile</h3>
		    	<div class="profileform">
		    		<form id="msform">
	                    <ul id="progressbar">
	                        <li class="active">
	                        	<div class="progressIcon"><i class="fa fa-user"></i></div>
	                        	Profile 
	                        </li>
	                        <li >
	                        	<div class="progressIcon"><i class="fa fa-graduation-cap"></i></div>
	                        	Academics 
	                        </li>
	                        <li>
	                        	<div class="progressIcon"><i class="fa fa-futbol"></i></div>
	                        	Athletics
	                    	</li>
	                        <li>
	                        	<div class="progressIcon"><i class="fa fa-briefcase"></i></div>
	                        	Exprience
	                        </li>
	                        <li>
	                        	<div class="progressIcon"><i class="fa fa-bullhorn"></i></div>
	                        	Reference
	                        </li>
	                    </ul>
	                    <fieldset>
	                    	<div  class="form-box text-start">
	                    		<h4 class="formheading"><span>Personal Information</span></h4>
	                    		<div class="row">
					    			<div class="col-lg-6 mb-3">
					    				<label>First Name</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Last Name</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Upload Profile Photo</label>
					    				<input type="file" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Designation</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Email Id</label>
					    				<input type="email" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Contact Number</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Address</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-6 mb-3">
					    				<label>Location</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-3 mb-3">
					    				<label>City</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-3 mb-3">
					    				<label>State</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-3 mb-3">
					    				<label>Country</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-3 mb-3">
					    				<label>Zip Code</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-12 mb-3">
					    				<label>Player Bio</label>
					    				<textarea class="form-control"></textarea>
					    			</div>
					    		</div>
	                    	</div>
	                    	<input type="button" name="next" class="next action-button" value="Next" />
	                    </fieldset>
	                    <fieldset>
	                    	<div  class="form-box text-start">
	                    		<h4 class="formheading"><span>ACADEMICS INFORMATION</span></h4>
	                    		<div class="row">
									<div class="col-lg-12 mb-3">
					    				<label>School / College Name</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-4 mb-3">
					    				<label>Course Name</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-4 mb-3">
					    				<label>Class Rank</label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-4 mb-3">
					    				<label>Year of Passing </label>
					    				<input type="text" class="form-control" name="">
					    			</div>
					    			<div class="col-lg-12 mb-3">
					    				<label>Achievement </label>
					    				<textarea class="form-control"></textarea>
					    			</div>
					    			<div class="col-lg-12 mb-3 text-end">
					    				<button class="btn btn-success rounded-0">Add More <i class="fa fa-plus"></i></button>
					    			</div>
					    		</div>
	                    	</div>
                            <input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
	                    </fieldset>
	                    <fieldset>
	                    	<div  class="form-box text-start">
	                    		<h4 class="formheading"><span>ATHLETICS INFORMATION</span></h4>
	                    		<div class="row">
	                    			<div class="col-lg-3 mb-3">
	                    				<label>(Height) Feet</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Inches</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Weight</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Footed</label>
	                    				<select class="form-select">
	                    					<option>Select</option>
	                    					<option>Left</option>
	                    					<option>Right</option>
	                    					<option>Both</option>
	                    				</select>
	                    			</div>
	                    			<div class="col-lg-12 mb-3">
                    					<label>Strength</label>
                    					<textarea class="form-control"></textarea>
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Position</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Sport</label>
	                    				<select class="form-control">
	                    					<option>Select</option>
	                    					<option>Baseball</option>
	                    					<option>Soccer</option>
	                    					<option>Hockey</option>
	                    					<option>Football</option>
	                    					<option>Tennis</option>
	                    				</select>
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>High School Team</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-3 mb-3">
	                    				<label>Club Team</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    		</div>
	                    	</div>
	                    	<input type="button" name="next" class="next action-button" value="Next" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
	                    </fieldset>
	                    <fieldset>
	                    	<div  class="form-box text-start">
	                    		<h4 class="formheading"><span>EXPRIENCE INFORMATION</span></h4>
	                    		<div class="row">
	                    			<div class="col-lg-6 mb-3">
	                    				<label>Club Name</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-6 mb-3">
	                    				<label>Designation</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-6 mb-3">
	                    				<label>Start Date</label>
	                    				<input type="date" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-6 mb-3">
	                    				<label>End Date</label>
	                    				<input type="date" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-12 mb-3">
                    					<label>Information</label>
                    					<textarea class="form-control"></textarea>
	                    			</div>
	                    		</div>
	                    	</div>
	                    	<input type="button" name="next" class="next action-button" value="Next" /> 
	                    	 <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
	                    </fieldset>
	                    <fieldset>
	                    	<div  class="form-box text-start">
	                    		<h4 class="formheading"><span>REFERENCE INFORMATION</span></h4>
	                    		<div class="row">
	                    			<div class="col-lg-6 mb-3">
	                    				<label>Coach Name</label>
	                    				<input type="text" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-6 mb-3">
	                    				<label>Coach Email</label>
	                    				<input type="email" class="form-control" name="">
	                    			</div>
	                    			<div class="col-lg-12 mb-3 text-end">
	                    				<button class="btn btn-success rounded-0">Add More <i class="fa fa-plus"></i></button>
	                    			</div>
	                    		</div>
	                    	</div>
	                    	<input type="button" name="next" class="next action-button" value="Submit" /> 
	                    	<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
	                    </fieldset>
                	</form>
			    	
			    </div>
		    </div>
		</div>
	</section>