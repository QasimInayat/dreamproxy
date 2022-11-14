<template>
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content mx-auto nk-block-area nk-block-area-column nk-auth-container bg-white nk-block-middle">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5"><a href="#"
                                    class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em
                                        class="icon ni ni-info"></em></a></div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5"><a href="javascript:;" class="logo-link"><img
                                            class="logo-light logo-img logo-img-lg" src="images/logo.png"
                                            srcset="images/logo2x.png 2x" alt="logo"><img
                                            class="logo-dark logo-img logo-img-lg" src="images/logo-dark.png"
                                            srcset="images/logo-dark2x.png 2x" alt="logo-dark"></a></div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Sign-In</h5>
                                        <div class="nk-block-des">
                                            <p>Access the DashLite panel using your email and passcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <form @submit.prevent="formSubmit" class="form-validate is-alter" autocomplete="off">
                                    <div class="form-group">
                                        <div class="form-label-group"><label class="form-label"
                                                for="email-address">Email or email</label><a
                                                class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                                        </div>
                                        <div class="form-control-wrap"><input autocomplete="off" type="email"
                                                class="form-control form-control-lg" v-model="loginForm.email" name="email" id="email-address"
                                                placeholder="Enter your email address">
                                                <span v-for="error of f$.loginForm.email.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group"><label class="form-label"
                                                for="password">Passcode</label><a class="link link-primary link-sm"
                                                tabindex="-1" href="auth-reset.html">Forgot Code?</a></div>
                                        <div class="form-control-wrap"><a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password"><em
                                                    class="passcode-icon icon-show icon ni ni-eye"></em><em
                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em></a>
                                                    <input
                                                autocomplete="new-password" v-model="loginForm.passcode" name="passcode" type="password"
                                                class="form-control form-control-lg"  id="password"
                                                placeholder="Enter your passcode">

                                                <span v-for="error of f$.loginForm.passcode.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>

                                                <!-- <div class="input-errors" v-for="error of f$.loginForm.passcode.$errors" :key="error.$uid">
                                                <div class="error-msg alert alert-danger mt-2">
                                                    <i class="fa fa-info-circle"></i>
                                                    {{ error.$message }}
                                                </div>
                                                </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group"><button type="submit" class="btn btn-lg btn-primary btn-block">Sign
                                            in</button></div>
                                </form>
                                <div class="form-note-s2 pt-4 text-center"> New on our platform? <router-link to="/register">Create
                                        an account</router-link></div>
                                
                                <div class="text-center mt-5"><span class="fw-500">I don't have an account? <a
                                            href="#">Try 15 days free</a></span></div>
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
                                    <button @click="pro">fsdfa</button>
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
import {login} from '../service';
import {products} from '../service';

export default {
    data(){
        return{
            f$: useVuelidate(),
            errorMessage: "",
            loginForm: {
                email: '',
                passcode: ''
            }
        }
    },  
    validations() {
        return {
            loginForm: {
                email: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    email: helpers.withMessage("The email field is a valid email", email)
                },
                passcode: {
                    required: helpers.withMessage("This field cannot be empty", required),
                }
            },
        };
    },

    methods:{
        formSubmit(){
            this.f$.$validate();
            if (!this.f$.$error) {
                console.log(this.loginForm);
                login(this.loginForm).then(res => {
                    console.log(res);
                })
            } else {
                console.log(this.loginForm);
            }
        },

        pro(){
            products().then(res => {
                console.log(res);
            })
        }
    }
}
</script>