<template>
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-lg">
                        <div
                            class="nk-split-content  mx-auto nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5"><a href="#"
                                    class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em
                                        class="icon ni ni-info"></em></a></div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5 text-center"><a href="javascript:;" class="logo-link"><img
                                            class="logo-light logo-img logo-img-lg" src="images/logo.png"
                                            srcset="images/logo2x.png 2x" alt="logo"><img
                                            class="logo-dark logo-img logo-img-lg" src="images/logo-dark.png"
                                            srcset="images/logo-dark2x.png 2x" alt="logo-dark"></a></div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content text-center">
                                        <h5 class="nk-block-title">Reset password</h5>
                                        <div class="nk-block-des">
                                            <p>If you forgot your password, well, then we’ll email you instructions to
                                                reset your password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form @submit.prevent="formSubmit" class="form-validate is-alter">
                                    <div class="form-group">
                                        <div class="form-label-group"><label class="form-label"
                                                for="default-01">Email</label><a class="link link-primary link-sm"
                                                href="#">Need Help?</a></div>
                                        <div class="form-control-wrap"><input type="text"
                                                class="form-control form-control-lg" id="default-01" v-model="forgetForm.email" name="email"
                                                placeholder="Enter your email address">
                                                <span v-for="error of f$.forgetForm.email.$errors" :key="error.$uid"
                                                    class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit">Send Reset
                                            Link</button></div>
                                </form>
                                <div class="form-note-s2 pt-5 text-center"><router-link to="/"><strong>Return to
                                            login</strong></router-link></div>
                            </div>
                            <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm w-100 text-center m-0 d-inline">
                                        <li class="nav-item d-inline"><a class="nav-link" href="#">Terms &amp; Condition</a></li>
                                        <li class="nav-item d-inline"><a class="nav-link" href="#">Privacy Policy</a></li>
                                        <li class="nav-item d-inline"><a class="nav-link" href="#">Help</a></li>
                                    </ul>
                                </div>
                                <div class="mt-3 text-center">
                                    <p>&copy; 2022 DashLite. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, email, helpers } from "@vuelidate/validators";
import { forget } from '../services/authService'

export default {
    data() {
        return {
            f$: useVuelidate(),
            errorMessage: "",
            forgetForm: {
                email: ''
            }
        }
    },
    validations() {
        return {
            forgetForm: {
                email: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    email: helpers.withMessage("The email field is a valid email", email)
                }
            },
        };
    },

    methods: {
        formSubmit() {
            this.f$.$validate();
            if (!this.f$.$error) {
                console.log(this.forgetForm);
                forget(this.forgetForm).then(res => {
                    console.log(res);
                    if(res.status == 200){
                        this.openToastSuccess('We have sent you reset password link on your given email address.');
                        setTimeout(() => {
                            window.location = '/'
                        }, 2000);
                    }
                }, err => {
                    console.log(err.response);
                    if(err.response.data.errors.email){
                        this.openToastError(err.response.data.errors.email[0]);
                    }
                    
                })
            } else {
                console.log(this.forgetForm);
            }
        }
    }
}
</script>