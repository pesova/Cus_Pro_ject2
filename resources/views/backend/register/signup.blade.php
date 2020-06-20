@extends('layout.authbase')
@section('custom_css')

@endsection

@section('content')
<div class="account-pages">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class="card-body p-0">
                    <div class="row h-full">
                        <div class="col-lg-5 py-2 px-5">
                            <div class="mb-3">
                                <h6>MyCustomer</h6>
                            </div>
                            <div class="ml-3">
                                <a href="#" class="align-items-center text-dark">
                                    <svg version="1.1" id="back" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16"
                                        height="16" viewBox="0 0 199.404 199.404"
                                        style="enable-background:new 0 0 199.404 199.404;" xml:space="preserve"
                                        fill="currentColor">
                                        <g>
                                            <polygon
                                                points="135.412,0 35.709,99.702 135.412,199.404 163.695,171.119 92.277,99.702 163.695,28.285" />
                                        </g>
                                    </svg>
                                    Back
                                </a>
                            </div>
                            <div class="mx-auto my-4">
                                <a href="index.html">
                                    {{-- <img src="assets/images/logo.png" alt="" height="24" /> --}}
                                    <h4 class="d-inline align-middle ml-4 text-logo">Create an Account</h4>
                                </a>
                            </div>

                            <form action="#" class="authentication-form">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Your Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="mail"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="hello@coderthemes.com">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Enter your password">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-dual" data-feather="lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" id="confirm-password"
                                            placeholder="Confirm your password">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                        <label class="custom-control-label" for="checkbox-signup">
                                            I accept <a href="javascript: void(0);">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                                </div>
                            </form>

                            <div>
                                <div class="py-3 text-center">
                                    <span class="font-size-16 font-weight-bold text-center">
                                        Or Continue With Social Account
                                    </span>
                                </div>
                                <div class="row justify-content-around">
                                    <div class="">
                                        <a href="#" class="btn btn-white">
                                            <svg id="google" enable-background="new 0 0 512 512" height="20"
                                                viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path
                                                        d="m120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308h-86.308c-34.255 44.488-52.823 98.707-52.823 155.785s18.568 111.297 52.823 155.785h86.308v-86.308c-12.142-20.347-19.131-44.11-19.131-69.477z"
                                                        fill="#fbbd00" />
                                                    <path
                                                        d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216c-20.525 12.186-44.388 19.039-69.569 19.039z"
                                                        fill="#0f9d58" />
                                                    <path
                                                        d="m139.131 325.477-86.308 86.308c6.782 8.808 14.167 17.243 22.158 25.235 48.352 48.351 112.639 74.98 181.019 74.98v-120c-49.624 0-93.117-26.72-116.869-66.523z"
                                                        fill="#31aa52" />
                                                    <path
                                                        d="m512 256c0-15.575-1.41-31.179-4.192-46.377l-2.251-12.299h-249.557v120h121.452c-11.794 23.461-29.928 42.602-51.884 55.638l86.216 86.216c8.808-6.782 17.243-14.167 25.235-22.158 48.352-48.353 74.981-112.64 74.981-181.02z"
                                                        fill="#3c79e6" />
                                                    <path
                                                        d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606c-48.352-48.352-112.639-74.981-181.02-74.981l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"
                                                        fill="#cf2d48" />
                                                    <path
                                                        d="m256 120v-120c-68.38 0-132.667 26.629-181.02 74.98-7.991 7.991-15.376 16.426-22.158 25.235l86.308 86.308c23.753-39.803 67.246-66.523 116.87-66.523z"
                                                        fill="#eb4132" />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="">
                                        <a href="#" class="btn btn-white">
                                            <svg enable-background="new 0 0 24 24" height="20" viewBox="0 0 24 24"
                                                width="20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-6.932 0-5.046 7.85-5.322 9h-3.487v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877c.188-2.824-.761-5.016 2.051-5.016z"
                                                    fill="#3b5999" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="">
                                        <a href="#" class="btn btn-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve" width="20"
                                            height="20">
                                            <g>
                                                <path
                                                    d="M185.255,512c-76.201-0.439-139.233-155.991-139.233-235.21c0-129.404,97.075-157.734,134.487-157.734   c16.86,0,34.863,6.621,50.742,12.48c11.104,4.087,22.588,8.306,28.975,8.306c3.823,0,12.832-3.589,20.786-6.738   c16.963-6.753,38.071-15.146,62.651-15.146c0.044,0,0.103,0,0.146,0c18.354,0,74.004,4.028,107.461,54.272l7.837,11.777   l-11.279,8.511c-16.113,12.158-45.513,34.336-45.513,78.267c0,52.031,33.296,72.041,49.292,81.665   c7.061,4.248,14.37,8.628,14.37,18.208c0,6.255-49.922,140.566-122.417,140.566c-17.739,0-30.278-5.332-41.338-10.034   c-11.191-4.761-20.845-8.862-36.797-8.862c-8.086,0-18.311,3.823-29.136,7.881C221.496,505.73,204.752,512,185.753,512H185.255z" />
                                                <path
                                                    d="M351.343,0c1.888,68.076-46.797,115.304-95.425,112.342C247.905,58.015,304.54,0,351.343,0z" />
                                            </g>
                                        </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p class="text-muted">Already have account? <a href="pages-login.html"
                                            class="text-primary font-weight-bold ml-1">Login</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 d-none d-md-block bg-cover"
                            style="background-image: url({{ asset('/backend/assets/images/login.svg') }});">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection