<template>
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div
                            class="nk-split-content mx-auto nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5"><a href="#"
                                    class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em
                                        class="icon ni ni-info"></em></a></div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5"><a href="javascript:;" class="logo-link"><img
                                            class="logo-light logo-img logo-img-lg" src="images/logo.png"
                                            srcset="images/logo2x.png 2x" alt="logo"><img
                                            class="logo-dark logo-img logo-img-lg" src="images/logo-dark.png"
                                            srcset="images/logo-dark2x.png 2x" alt="logo-dark"></a></div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Register</h5>
                                        <div class="nk-block-des">
                                            <p>Create New Dashlite Account</p>
                                        </div>
                                    </div>
                                </div>
                                <form @submit.prevent="formSubmit" class="form-validate is-alter">
                                    <div class="form-group"><label class="form-label" for="email">Email</label>
                                        <div class="form-control-wrap"><input type="email" v-model="registerForm.email" name="email"
                                                class="form-control form-control-lg" id="email"
                                                placeholder="Enter your email address">
                                                <span v-for="error of f$.registerForm.email.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group"><label class="form-label" for="password">Passcode</label>
                                        <div class="form-control-wrap"><a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password"><em
                                                    class="passcode-icon icon-show icon ni ni-eye"></em><em
                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em></a><input
                                                type="password" v-model="registerForm.passcode" name="passcode" class="form-control form-control-lg" id="password"
                                                placeholder="Enter your passcode">
                                                <span v-for="error of f$.registerForm.passcode.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group"><label class="form-label" for="password">Confirm Passcode</label>
                                        <div class="form-control-wrap"><a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password"><em
                                                    class="passcode-icon icon-show icon ni ni-eye"></em><em
                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em></a>
                                                <input
                                                type="password" v-model="registerForm.passcodeConfirm" name="passcodeConfirm" class="form-control form-control-lg" id="password"
                                                placeholder="Re-ennter your passcode">
                                                <span v-for="error of f$.registerForm.passcodeConfirm.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-control-xs custom-checkbox"><input
                                                type="checkbox" v-model="registerForm.privacy" name="privacy" class="custom-control-input"
                                                id="checkbox-privacy"><label class="custom-control-label"
                                                for="checkbox-privacy">I agree to Dashlite <a tabindex="-1"
                                                    href="#">Privacy Policy</a></label>
                                                    <span v-for="error of f$.registerForm.privacy.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-control-xs custom-checkbox"><input
                                                type="checkbox" v-model="registerForm.terms" name="terms" class="custom-control-input"
                                                id="checkbox-terms"><label class="custom-control-label"
                                                for="checkbox-terms">I agree to Dashlite  <a tabindex="-1" href="#">
                                                    Terms.</a></label>
                                                    <span v-for="error of f$.registerForm.terms.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-group"><button
                                            class="btn btn-lg btn-primary btn-block" type="submit">Register</button></div>
                                </form>
                                <div class="form-note-s2 pt-4 text-center"> Already have an account ? <router-link
                                        to="/login"><strong>Sign in instead</strong></router-link>
                                </div>

                            </div>
                            <div class="nk-block nk-auth-footer text-center">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm mx-auto">
                                        <li class="nav-item"><a class="nav-link" href="#">Terms & Condition</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Privacy Policy</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Help</a></li>

                                    </ul>
                                </div>
                                <div class="mt-3">
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
import { required, email, helpers, sameAs  } from "@vuelidate/validators";
import {login} from '../service';

export default {
    data(){
        return{
            f$: useVuelidate(),
            errorMessage: "",
            registerForm: {
                email: '',
                passcode: '',
                passcodeConfirm: '',
            }
        }
    },  
    validations() {
        return {
            registerForm: {
                email: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    email: helpers.withMessage("The email field is a valid email", email)
                },
                passcode: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                passcodeConfirm: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    sameAsPassword: sameAs(this.registerForm.passcode)
                },
                privacy: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                terms: {
                    required: helpers.withMessage("This field cannot be empty", required)
                }
            },
        };
    },

    methods:{
        formSubmit(){
            this.f$.$validate();
            if (!this.f$.$error) {
                console.log(this.registerForm);
                // login(this.registerForm).then(res => {
                //     console.log(res);
                // })
            } else {
                console.log(this.registerForm);
            }
        }
    }
}
</script>