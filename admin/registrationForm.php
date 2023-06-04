<div class="content-wrapper" style="min-height: 711px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registration Form</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <form id="frm-registration" method="post" class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper linear">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#personal-info-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="personal-info-part" id="personal-info-part-trigger" aria-selected="false" fdprocessedid="tnj6f" disabled="disabled">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Personal Data</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#educational-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="educational-part" id="educational-part-trigger" aria-selected="true">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Educational Background</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#requirements-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="educational-part" id="educational-part-trigger" aria-selected="true">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Requirements</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- --------------------PERSONAL INFORMATION --------------------------- -->
                                    <div id="personal-info-part" class="content" role="tabpanel" aria-labelledby="personal-info-part-trigger">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="code">Freshmen Appointment Code</label>
                                                    <input type="text" class="form-control" name="code" id="code" placeholder="2023-1-00001" required>
                                                    <input type="hidden" class="form-control" name="id" id="id">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="appointment_date">Appointment Date</label>
                                                    <input type="text" class="form-control" name="appointment_date" id="appointment_date" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="appointment_time">Appointment Time</label>
                                                    <input type="text" class="form-control" name="appointment_time" id="appointment_time" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="grade">Average</label>
                                                    <input type="text" class="form-control" name="grade" id="grade" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="lastname">Last Name</label>
                                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="firstname">First Name</label>
                                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="middlename">Middle Name</label>
                                                    <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Middle Name" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="pob">Place of Birth</label>
                                                    <input name="pob" id="pob" class="form-control" placeholder="Place of Birth" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="date" class="form-control" name="dob" id="dob" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" id="gender" class="form-control" readonly required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" id="age" class="form-control" placeholder="Age" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="civil_status">Civil Status</label>
                                                    <div class="form-check">
                                                        <input type="radio" name="civil_status" class="form-check-input" value="Single" disabled>
                                                        <label for="civil_status">Single</label>                                            
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="civil_status" class="form-check-input" value="Married" disabled>
                                                        <label for="civil_status">Married</label>                                            
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="civil_status" class="form-check-input" value="Widowed" disabled>
                                                        <label for="civil_status">Widowed</label>                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="citizenship">Citizenship</label>
                                                    <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Citizenship" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="religion">Religion</label>
                                                    <input type="text" class="form-control" name="religion" id="religion" placeholder="Religion" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="@email" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="phone">Contact Number</label>
                                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="09xxxxxxxxx" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="telephone">Residence Telephone No.</label>
                                                    <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Residence Telephone No." readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Complete Home Address</label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Home Address" readonly required>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="brgy">Barangay</label>
                                                    <input type="text" class="form-control" name="brgy" id="brgy" placeholder="Barangay" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="zone">Zone</label>
                                                    <input type="text" class="form-control" name="zone" id="zone" placeholder="Zone" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="district">District</label>
                                                    <input type="text" class="form-control" name="district" id="district" placeholder="District" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="mother_name">Mother's Name</label>
                                                    <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother's Name" readonly required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="father_name">Father's Name</label>
                                                    <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father's Name" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="mother_occupation">Occupation</label>
                                                    <input type="text" class="form-control" name="mother_occupation" id="mother_occupation" placeholder="Mother's Occupation" readonly required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="father_occupation">Occupation</label>
                                                    <input type="text" class="form-control" name="father_occupation" id="father_occupation" placeholder="Father's Occupation" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="guardian">Guardian</label>
                                                    <input type="text" class="form-control" name="guardian" id="guardian" placeholder="Guardian Name" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="guardian_relation">Relation</label>
                                                    <input type="text" class="form-control" name="guardian_relation" id="guardian_relation" placeholder="Guardian Relation" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="guardian_address">Guardian Home Address</label>
                                            <input type="text" class="form-control" name="guardian_address" id="guardian_address" placeholder="Guardian Home Address" readonly>
                                        </div>

                                        <button class="btn btn-primary" type="button" onclick="nextForm()">Next</button>
                                    </div>
                                    <!-- ----------------------------EDUCATIONAL BACKGROUND------------------------ -->
                                    <div id="educational-part" class="content" role="tabpanel" aria-labelledby="educational-part-trigger">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="elem_school">Elementary School</label>
                                                    <input type="text" class="form-control" name="elem_school" id="elem_school" placeholder="Elementary School" readonly required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="elem_school_graduated">Year Graduated</label>
                                                    <input type="text" class="form-control" name="elem_school_graduated" id="elem_school_graduated" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="high_school">High School</label>
                                                    <input type="text" class="form-control" name="high_school" id="high_school" placeholder="High School" readonly required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="high_school_graduated">Year Graduated</label>
                                                    <input type="text" class="form-control" name="high_school_graduated" id="high_school_graduated" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="senior_high">Senior High School</label>
                                                    <input type="text" class="form-control" name="senior_high" id="senior_high" placeholder="Senior High School" readonly required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="senior_high_graduated">Year Graduated</label>
                                                    <input type="text" class="form-control" name="senior_high_graduated" id="senior_high_graduated" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="strand">Strand <span class="text-info">(PLEASE SPECIFY THE STRAND)</span></label>
                                            <input type="text" class="form-control" name="strand" id="strand" placeholder="Strand" readonly required>
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                        <button class="btn btn-primary" type="button" onclick="stepper.next()">Next</button>
                                    </div>
                                     <!-- ---------------------------- REQUIREMENTS ------------------------ -->
                                    <div id="requirements-part" class="content" role="tabpanel" aria-labelledby="requirements-part-trigger">
                                        <div class="display p-4">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="birth_certificate" name="birth_certificate" >
                                                        <label for="requirements">Birth Certificate</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="diploma_elementary" name="diploma_elementary" >
                                                        <label for="requirements">Elementary Diploma</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="diploma_high_school" name="diploma_high_school" >
                                                        <label for="requirements">High School Diploma</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="voters_id_parent" name="voters_id_parent" >
                                                        <label for="requirements">Voter's Identification Parent</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="voters_id_applicant" name="voters_id_applicant" >
                                                        <label for="requirements">Voter's Identification Applicant</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="voters_certificate_parent" name="voters_certificate_parent" >
                                                        <label for="requirements">Voter's Certificate Parent</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="voters_certificate_applicant" name="voters_certificate_applicant" >
                                                        <label for="requirements">Voter's Certificate Applicant</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="good_moral" name="good_moral" >
                                                        <label for="requirements">Good Moral</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="form_138" name="form_138" >
                                                        <label for="requirements">Form 138</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="stepper.previous()">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="registerStudent()">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>