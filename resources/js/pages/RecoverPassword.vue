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
                                <div class="brand-logo pb-5 text-center"><a href="javascript:;" class="logo-link"><img
                                            class="logo-light logo-img logo-img-lg" src="/images/logo.png"
                                            srcset="images/logo2x.png 2x" alt="logo"><img
                                            class="logo-dark logo-img logo-img-lg" src="/images/logo-dark.png"
                                            srcset="/images/logo-dark2x.png 2x" alt="logo-dark"></a></div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content text-center">
                                        <h5 class="nk-block-title">Recover Password</h5>
                                        <div class="nk-block-des">
                                            <!-- <p>Recover your password</p> -->
                                        </div>
                                    </div>
                                </div>
                                <form @submit.prevent="formSubmit" class="form-validate is-alter">
                                    <div class="form-group"><label class="form-label" for="email">Email</label>
                                        <div class="form-control-wrap"><input type="email" v-model="recoverPasswordForm.email" name="email"
                                                class="form-control form-control-lg" id="email"
                                                placeholder="Enter your email address">
                                                <span v-for="error of f$.recoverPasswordForm.email.$errors" :key="error.$uid" class="invalid">
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
                                                type="password" autocomplete="password" v-model="recoverPasswordForm.password" name="password" class="form-control form-control-lg" id="password"
                                                placeholder="Enter your passcode">
                                                <span v-for="error of f$.recoverPasswordForm.password.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group"><label class="form-label" for="password_confirmation">Confirm Passcode</label>
                                        <div class="form-control-wrap"><a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password"><em
                                                    class="passcode-icon icon-show icon ni ni-eye"></em><em
                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em></a>
                                                <input
                                                type="password" autocomplete="password" v-model="recoverPasswordForm.password_confirmation" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation"
                                                placeholder="Re-ennter your passcode">
                                                <span v-for="error of f$.recoverPasswordForm.password_confirmation.$errors" :key="error.$uid" class="invalid">
                                                    {{ error.$message }}
                                                </span>
                                            </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit">Recover Password</button></div>
                                </form>
                                <div class="form-note-s2 pt-4 text-center"> Remembered Password? <router-link
                                        to="/"><strong>Sign in instead</strong></router-link>
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
import { required, email, helpers, sameAs, minLength,  } from "@vuelidate/validators";
import { confirmpassword } from '../services/authService';

export default {
    data(){
        return{
            f$: useVuelidate(),
            errorMessage: "",
            recoverPasswordForm: {
                email: '',
                password: '',
                password_confirmation: '',
                password_recovery_token:''
            }
        }
    },  
    validations() {
        return {
            recoverPasswordForm: {
                email: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    email: helpers.withMessage("The email field is a valid email", email)
                },
                password: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    minLength: minLength(8)
                },
                password_confirmation: {
                    required: helpers.withMessage("This field cannot be empty", required),
                    sameAsPassword: sameAs(this.recoverPasswordForm.password)
                },
            },
        };
    },
    mounted(){
        this.routeData();
    },  
    methods:{
        routeData(){
            const paramData = this.$route.params;
            // console.log(this.$route);
            this.recoverPasswordForm.password_recovery_token = paramData.token;
            console.log(this.recoverPasswordForm);

        },
        formSubmit(){
            this.f$.$validate();
            if (!this.f$.$error) {
                console.log(this.recoverPasswordForm);
                confirmpassword(this.recoverPasswordForm).then(res => {
                    console.log(res);
                    this.openToastSuccess('Your password has been changed successfully.');
                    setTimeout(() => {
                        window.location = '/';    
                    }, 2000);
                    
                }, err => {
                    console.log(err.response);
                    this.openToastError(err.response.data.error);
                })
            } else {
            }
        },
        // profile() {
        //     profile().then(res => {
        //         localStorage.setItem('email', res.data.email);
        //     }, err => {
        //     })
        // }
    }
}
</script>