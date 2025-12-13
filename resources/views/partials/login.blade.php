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
                        <form action="{{ route('register.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <br>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="name" placeholder="UserName">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="displayName"
                                    placeholder="Display Name">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="email" class="form-control" name="email" id="UserEmail"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="mobile"
                                    placeholder="Enter Mobile Number">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="tags"
                                    placeholder="Eg., AI, Automation">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="expertiseTags"
                                    placeholder="Enter Expertise Tags">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="toolsKnown" placeholder="Tools Known">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="skills" placeholder="Enter Skills">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="location" placeholder="Enter Location">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="languages"
                                    placeholder="Enter Languages">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="rate"
                                    placeholder="Enter Hourly Rate / Price Range">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="portfolioURL"
                                    placeholder="Enter Portfolio URL">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <textarea rows="3" name="shortBio" placeholder="Short Bio" class="form-control" style="color:#000;"></textarea>
                            </div>

                            <div class="form-group icon_input mb-3">
                                <textarea rows="3" name="profileBio" placeholder="Profile Bio" class="form-control" style="color:#000;"></textarea>
                            </div>

                            <div class="form-control mb-3">
                                <input class="form-control" type="file" id="formFile" name="profileFile">
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
                        <form action="{{ route('register.store') }}" method="post">
                            @csrf
                            <br>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="name" placeholder="UserName">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="displayName"
                                    placeholder="Display Name">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="email" class="form-control" name="email" id="UserEmail"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password">
                            </div>

                            <div class="form-group icon_input mb-3">
                                <input type="text" class="form-control" name="mobile"
                                    placeholder="Enter Mobile Number">
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
