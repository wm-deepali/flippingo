<form method="post">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Basic Information</h4>
            <hr class="border-top-gray my-0" />
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Your Email</label>
                        <input class="form-control form--control ps-3" type="email" name="email"
                            placeholder="you@email.com" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Password</label>
                        <div class="position-relative">
                            <input class="form-control form--control ps-3 password-field" type="password"
                                name="password" placeholder="Password" />
                            <a href="javascript:void(0)" class="position-absolute top-0 right-0 h-100 toggle-password"
                                title="toggle show/hide password">
                                <i class="far fa-eye eye-on"></i>
                                <i class="far fa-eye-slash eye-off"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="label-text d-flex align-items-center">Listing Tile
                            <span class="fas fa-question tip ms-2" data-bs-toggle="tooltip" data-placement="top"
                                title="Name of your business"></span></label>
                        <input class="form-control form--control ps-3" type="text" name="text"
                            placeholder="e.g. Super duper burger" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group select2-container-wrapper">
                        <label class="label-text">Category</label>
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="0">Select a Category</option>
                            <option value="1">Shops</option>
                            <option value="2">Hotels</option>
                            <option value="3">Restaurants</option>
                            <option value="4">Fitness</option>
                            <option value="5">Travel</option>
                            <option value="6">Salons</option>
                            <option value="7">Event</option>
                            <option value="8">Business</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text d-flex align-items-center">Keywords Or Tags
                            <span class="fas fa-question tip ms-2" data-bs-toggle="tooltip" data-placement="top"
                                title="These keywords or tags will help your listing to find in search.Maximum of 5 keywords related with your business"></span></label>
                        <input class="form-control form--control ps-3 tags-input" type="text" name="text"
                            placeholder="e.g. burger" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="label-text">Description</label>
                        <textarea class="form-control form--control ps-3 user-text-editor"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Location / Contact</h4>
            <hr class="border-top-gray my-0" />
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Address</label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="Address" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Temporary Address</label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="Address" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group select2-container-wrapper">
                        <label class="label-text">City</label>
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Select a City</option>
                            <option value="1">New York</option>
                            <option value="2">Los Angeles</option>
                            <option value="3">Chicago</option>
                            <option value="4">Phoenix</option>
                            <option value="5">Washington</option>
                            <option value="6">Boston</option>
                            <option value="7">Philadelphia</option>
                            <option value="8">Baltimore</option>
                            <option value="9">Seattle</option>
                            <option value="10">San Francisco</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group select2-container-wrapper">
                        <label class="label-text">State</label>
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Select a State</option>
                            <option value="1">California</option>
                            <option value="2">Florida</option>
                            <option value="3">Texas</option>
                            <option value="4">Hawaii</option>
                            <option value="5">Arizona</option>
                            <option value="6">Michigan</option>
                            <option value="7">New Jersey</option>
                            <option value="8">Georgia</option>
                            <option value="9">South Carolina</option>
                            <option value="10">Montana</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group select2-container-wrapper">
                        <label class="label-text">country</label>
                        <select class="select-picker" data-width="100%" data-size="5" data-live-search="true">
                            <option value="">Select a Country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>

                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong SAR China</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>

                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Zip-Code</label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="Zip-code" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="label-text">Phone <span class="text-gray">Optional</span></label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="Number" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="price-card-section">
        <h5 class="price-title">Choose Price & Delivery Date</h5>
        <label class="price-card">
            <input type="radio" name="delivery" checked>
            <div class="price-card-content">
                <div>
                    <p class="est-title">Estimated Delivery:</p>
                    <h6 class="est-date">Thu, 21st Aug</h6>
                </div>
                <div class="price">£138.50</div>
            </div>
        </label>

        <label class="price-card">
            <input type="radio" name="delivery">
            <div class="price-card-content">
                <div>
                    <p class="est-title">Estimated Delivery:</p>
                    <h6 class="est-date">Sat, 23rd Aug</h6>
                    <div class="extra-details">
                        <p>Ireland</p>
                        <ul>
                            <li>High Quality Printing</li>
                            <li>All Prints are Checked by Supervisor</li>
                            <li>Delivery Charges are for <b>Ireland Only</b></li>
                        </ul>
                    </div>
                </div>
                <div class="price">£158.50</div>
            </div>
        </label>

        <label class="price-card">
            <input type="radio" name="delivery">
            <div class="price-card-content">
                <div>
                    <p class="est-title">Estimated Delivery:</p>
                    <h6 class="est-date">Sun, 24th Aug</h6>
                </div>
                <div class="price">£178.50</div>
            </div>
        </label>
    </div>



    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Media</h4>
            <hr class="border-top-gray my-0" />
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Website <span class="text-gray">Optional</span></label>
                        <input class="form-control form--control ps-3" type="text" name="text"
                            placeholder="www. Flippingo.com" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Facebook Link
                            <span class="text-gray">Optional</span></label>
                        <input class="form-control form--control ps-3" type="text" name="text"
                            placeholder="www.facebook.com" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Twitter Link
                            <span class="text-gray">Optional</span></label>
                        <input class="form-control form--control ps-3" type="text" name="text"
                            placeholder="www.twitter.com" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="label-text">Video Link <span class="text-gray">Optional</span></label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="URL" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Photo</h4>
            <hr class="border-top-gray my-0" />
            <label class="label-text">Gallery Images</label>
            <div class="file-upload-wrap">
                <input type="file" name="files[]" class="multi file-upload-input with-preview" multiple />
                <span class="file-upload-text"><i class="fal fa-upload me-2"></i>Drag & Drop Files Here to
                    Upload</span>
            </div>
            <label class="label-text">Company Logo</label>
            <div class="file-upload-wrap file-upload-wrap-layout-2">
                <input type="file" name="files[]" class="multi file-upload-input with-preview" multiple />
                <span class="file-upload-text"><i class="fal fa-image me-2"></i>Choose a file</span>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Amenities</h4>
            <hr class="border-top-gray my-0" />
            <div class="amenities-wrap mt-4">
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="ElevatorInBuilding" />
                    <label class="custom-control-label" for="ElevatorInBuilding">Elevator in building</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="FriendlyWorkspace" />
                    <label class="custom-control-label" for="FriendlyWorkspace">Friendly workspace</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="InstantBook" />
                    <label class="custom-control-label" for="InstantBook">Instant Book</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="WirelessInternet" />
                    <label class="custom-control-label" for="WirelessInternet">Wireless Internet</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="FreeParkingOnPremises" />
                    <label class="custom-control-label" for="FreeParkingOnPremises">Free parking on
                        premises</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block me-2">
                    <input type="checkbox" class="custom-control-input" id="FreeParkingOnStreet" />
                    <label class="custom-control-label" for="FreeParkingOnStreet">Free parking on street</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="SmokingAllowed" />
                    <label class="custom-control-label" for="SmokingAllowed">Smoking allowed</label>
                </div>
                <div class="custom-control custom-checkbox mb-2 d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="Events" />
                    <label class="custom-control-label" for="Events">Events</label>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Opening Hours</h4>
            <hr class="border-top-gray my-0" />
            <div class="my-4">
                <label class="label-text">Monday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="monClosed" />
                            <label class="custom-control-label" for="monClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Tuesday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tueClosed" />
                            <label class="custom-control-label" for="tueClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Wednesday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="WednesdayClosed" />
                            <label class="custom-control-label" for="WednesdayClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Thursday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ThursdayClosed" />
                            <label class="custom-control-label" for="ThursdayClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Friday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="FridayClosed" />
                            <label class="custom-control-label" for="FridayClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Saturday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="SaturdayClosed" />
                            <label class="custom-control-label" for="SaturdayClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
            <div class="mb-4">
                <label class="label-text">Sunday</label>
                <div class="row align-items-center">
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Opening Time</option>
                            <option value="open">Open</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-1">
                        <span class="text-gray d-block text-center">to</span>
                    </div>
                    <!-- end col-lg-1 -->
                    <div class="col-lg-4 select2-container-wrapper">
                        <select class="select-picker" data-width="100%" data-size="5">
                            <option value="">Closing Time</option>
                            <option value="closed">Closed</option>
                            <option value="1">1:00am</option>
                            <option value="2">2:00am</option>
                            <option value="3">3:00am</option>
                            <option value="4">4:00am</option>
                            <option value="5">5:00pm</option>
                            <option value="6">6:00pm</option>
                            <option value="7">7:00pm</option>
                            <option value="8">8:00pm</option>
                            <option value="9">9:00am</option>
                            <option value="10">10:00am</option>
                            <option value="11">11:00am</option>
                            <option value="12">12:00am</option>
                            <option value="13">1:00pm</option>
                            <option value="14">2:00pm</option>
                            <option value="15">3:00pm</option>
                            <option value="16">4:00pm</option>
                            <option value="17">5:00pm</option>
                            <option value="18">6:00pm</option>
                            <option value="19">7:00pm</option>
                            <option value="20">8:00pm</option>
                            <option value="21">9:00pm</option>
                            <option value="22">10:00pm</option>
                            <option value="23">11:00pm</option>
                            <option value="24">12:00pm</option>
                        </select>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="SundayClosed" />
                            <label class="custom-control-label" for="SundayClosed">Closed</label>
                        </div>
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Price Details</h4>
            <hr class="border-top-gray my-0" />
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="form-group select2-container-wrapper">
                        <label class="label-text">Price Range</label>
                        <select class="select-picker" data-width="100%">
                            <option value="0">Price Range</option>
                            <option value="0">Not to say</option>
                            <option value="1">$ Inexpensive</option>
                            <option value="2">$$ Moderate</option>
                            <option value="3">$$$ Pricey</option>
                            <option value="4">$$$$ Ultra High</option>
                        </select>
                    </div>
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="label-text">Price From</label>
                        <input class="form-control form--control ps-3" type="text" name="text" placeholder="e.g. $5" />
                    </div>
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="label-text">Price To</label>
                        <input class="form-control form--control ps-3" type="text" name="text"
                            placeholder="e.g. $300" />
                    </div>
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->
    <div class="custom-control custom-checkbox mb-2">
        <input type="checkbox" class="custom-control-input" id="privacyCheckbox" />
        <label class="custom-control-label" for="privacyCheckbox">I Agree to Flippingo
            <a href="#" class="btn-link">Privacy Policy</a></label>
    </div>
    <div class="custom-control custom-checkbox mb-2">
        <input type="checkbox" class="custom-control-input" id="termsCheckbox" />
        <label class="custom-control-label" for="termsCheckbox">I Agree to Flippingo
            <a href="#" class="btn-link">Terms of Services</a></label>
    </div>
    <button class="theme-btn border-0 mt-3" type="submit">
        Submit Listing
    </button>
</form>