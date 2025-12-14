<div class="offcanvas offcanvas-end" tabindex="-1" id="loginslide" aria-labelledby="loginslideLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="loginslideLabel">Login / Signup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#export" role="tab" data-bs-toggle="tab" class="nav-link active">
                        Export SignUp
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#user" role="tab" data-bs-toggle="tab" class="nav-link">
                        User SignUp
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                {{-- Export Signup --}}
                <div class="tab-pane active" role="tabpanel" id="export">
                    <div class="exportSignUp">
                        <form id="expertRegisterForm" action="{{ route('register.store') }}" method="post"
                            enctype="multipart/form-data" class="needs-validation ajax-form" novalidate>
                            @csrf
                            <br>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="name" placeholder="UserName"
                                    required>
                                <div class="invalid-feedback">
                                    User name is required
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="display_name" placeholder="Display Name"
                                    required>
                                <div class="invalid-feedback">Display name is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="email" class="form-control" name="email" id="UserEmail"
                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">

                                <!-- input wrapper -->
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5" name="password" id="password"
                                        placeholder="Password" required>

                                    <span class="password-toggle" data-target="password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>

                                <!-- strength meter (outside wrapper) -->
                                <div class="progress mt-2" style="height:5px;">
                                    <div id="password-strength-bar" class="progress-bar"></div>
                                </div>

                                <small id="password-strength-text" class="text-muted"></small>

                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3 password-wrapper">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm Password" required>

                                <span class="password-toggle" data-target="password_confirmation">
                                    <i class="fa fa-eye"></i>
                                </span>

                                <div class="invalid-feedback">
                                    Passwords do not match
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="mobile"
                                    placeholder="Enter Mobile Number" required>
                                <div class="invalid-feedback">
                                    Mobile number is required
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <select class="form-control selectpicker" name="tags[]" multiple
                                    data-live-search="true" title="Select Tags" required>
                                    <option value="AI">AI</option>
                                    <option value="Automation">Automation</option>
                                    <option value="Chatbot">Chatbot</option>
                                    <option value="Machine Learning">Machine Learning</option>
                                    <option value="Data Analytics">Data Analytics</option>
                                </select>

                                <div class="invalid-feedback select-error">
                                    Please select at least one tag
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="expertiseTags"
                                    placeholder="Enter Expertise Tags" required>
                                <div class="invalid-feedback">Expertise Tags are required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="toolsKnown"
                                    placeholder="Tools Known" required>
                                <div class="invalid-feedback">ToolsKnown are required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="skills" placeholder="Enter Skills"
                                    required>
                                <div class="invalid-feedback">Skills are required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="location"
                                    placeholder="Enter Location" required>
                                <div class="invalid-feedback">Location is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="languages"
                                    placeholder="Enter Languages" required>
                                <div class="invalid-feedback">Languages are required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="rate"
                                    placeholder="Enter Hourly Rate / Price Range" required>
                                <div class="invalid-feedback">Hourly Rate / Price Range is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="portfolioURL"
                                    placeholder="Enter Portfolio URL">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <textarea rows="3" name="shortBio" placeholder="Short Bio" class="form-control" style="color:#000;" required></textarea>
                                <div class="invalid-feedback">Short bio is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <textarea rows="3" name="profileBio" placeholder="Profile Bio" class="form-control" style="color:#000;"
                                    required></textarea>
                                <div class="invalid-feedback">Profile bio is required</div>
                            </div>

                            <div class="form-control mb-3">
                                <input class="form-control" type="file" id="formFile" name="profileFile" required>
                                <div class="invalid-feedback profileFile-error">Profile file is required</div>
                            </div>
                            <input type="hidden" name="role" value="expert">

                            <br>
                            <button type="submit" class="btn btn-primary arrowLink">Submit</button>
                        </form>
                    </div>
                </div>

                {{-- User Signup --}}
                <div class="tab-pane" role="tabpanel" id="user">
                    <div class="userSignUp">
                        <form id="userRegisterForm" action="{{ route('register.store') }}" method="post"
                            class="needs-validation ajax-form" novalidate>
                            @csrf
                            <br>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="name" placeholder="UserName"
                                    required>
                                <div class="invalid-feedback">Username is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="display_name"
                                    placeholder="Display Name" required>
                                <div class="invalid-feedback">Display name is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="email" class="form-control" name="email" id="UserEmail"
                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                                <div class="invalid-feedback">Email is required</div>
                            </div>

                            <div class="form-group icon_input mb-3">

                                <!-- input wrapper -->
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5" name="password" id="password"
                                        placeholder="Password" required>

                                    <span class="password-toggle" data-target="password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>

                                <!-- strength meter (outside wrapper) -->
                                <div class="progress mt-2" style="height:5px;">
                                    <div id="password-strength-bar" class="progress-bar"></div>
                                </div>

                                <small id="password-strength-text" class="text-muted"></small>

                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3 password-wrapper">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm Password" required>

                                <span class="password-toggle" data-target="password_confirmation">
                                    <i class="fa fa-eye"></i>
                                </span>

                                <div class="invalid-feedback">
                                    Passwords do not match
                                </div>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="mobile"
                                    placeholder="Enter Mobile Number" required>
                                <div class="invalid-feedback">Mobile number is required</div>
                            </div>
                            <input type="hidden" name="role" value="user">

                            <br>
                            <button type="submit" class="btn btn-primary arrowLink">Submit</button>
                        </form>
                    </div>
                </div>

            </div> {{-- .tab-content --}}
        </div>
    </div>
</div>
