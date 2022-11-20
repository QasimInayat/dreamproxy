<template>
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap ">
                <app-header />
                <div class="nk-content ">
                    <div class="container wide-xl">
                        <div class="nk-content-inner">
                            <app-menu />
                            <div class="nk-content-body">
                                <div class="nk-content-wrap">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between-md g-4">
                                            <div class="nk-block-head-content">
                                                <h2 class="nk-block-title fw-normal">Billing</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <form @submit.prevent="formSubmit" class="form-validate is-alter" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="name">Name</label>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="name" id="name" v-model="billingForm.name"
                                                                placeholder="Enter your name">
                                                                <span v-for="error of f$.billingForm.name.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="surname">Surname</label>
                                                        </div>
                                                        <div class="form-control-wrap"><input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="surname" id="surname" v-model="billingForm.surname"
                                                                placeholder="Enter your surname">
                                                                <span v-for="error of f$.billingForm.surname.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="company">Company</label>
                                                        </div>
                                                        <div class="form-control-wrap"><input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="company" id="company" v-model="billingForm.company"
                                                                placeholder="Enter your company">
                                                                <span v-for="error of f$.billingForm.company.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="address">Address</label>
                                                        </div>
                                                        <div class="form-control-wrap"><input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="address" id="address" v-model="billingForm.address"
                                                                placeholder="Enter your address">
                                                                <span v-for="error of f$.billingForm.address.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="country">Country</label>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <select name="country" v-model="billingForm.country_id" id="country" class="form-control form-control-lg">
                                                                <option value="" disabled selected>Select your country</option>
                                                                <option v-for="(country, index) in countries" :key="index" :value="country.id">{{country.name}}</option>   
                                                            </select>
                                                            <span v-for="error of f$.billingForm.country_id.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="province">Province</label>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <select name="province" v-model="billingForm.province_id" id="province" class="form-control form-control-lg">
                                                                <option value="" disabled selected>Select your province</option>
                                                                <option v-for="(province, index) in provinces" :key="index" :value="province.id">{{province.name}}</option> 
                                                            </select>
                                                            <span v-for="error of f$.billingForm.province_id.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="city">City</label>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="city" id="city" v-model="billingForm.city"
                                                                placeholder="Enter your city">
                                                            <span v-for="error of f$.billingForm.city.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="postal-code">Postal Code</label>
                                                        </div>
                                                        <div class="form-control-wrap"><input autocomplete="off"
                                                                type="number" class="form-control form-control-lg"
                                                                name="postal-code" id="postal-code" v-model="billingForm.postal_code"
                                                                placeholder="Enter your postal code">
                                                                <span v-for="error of f$.billingForm.postal_code.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-label-group"><label class="form-label"
                                                                for="vat">VAT</label>
                                                        </div>
                                                        <div class="form-control-wrap"><input autocomplete="off"
                                                                type="text" class="form-control form-control-lg"
                                                                name="vat" id="vat" v-model="billingForm.vat"
                                                                placeholder="Enter your vat">
                                                                <span v-for="error of f$.billingForm.vat.$errors" :key="error.$uid"
                                                                    class="invalid">
                                                                    {{ error.$message }}
                                                                </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12  text-end">
                                                    <div class="form-group"><button class="btn btn-lg btn-primary me-3" type="submit">Save</button>
                                                        <button class="btn btn-lg btn-outline-warning" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <app-footer />
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
import { country, province } from '../services/addressService';
import { saveBilling, getBilling } from '../services/billingServices';

export default {
    data() {
        return {
            f$: useVuelidate(),
            errorMessage: "",
            billingForm: {
                name: '',
                surname: '',
                company: '',
                address: '',
                country_id: '',
                province_id: '',
                city: '',
                postal_code: '',
                vat:''
            },
            countries:[],
            provinces:[]
        }
    },
    validations() {
        return {
            billingForm: {
                name: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                surname: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                company: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                address: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                country_id: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                province_id: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                city: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                postal_code: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
                vat: {
                    required: helpers.withMessage("This field cannot be empty", required),
                },
            },
        };
    },
    mounted(){
        this.getCounties();
        this.getProvinces();
        this.getBillingData();
    },
    methods: {
        formSubmit() {
            this.f$.$validate();
            if (!this.f$.$error) {
                console.log(this.billingForm);
                saveBilling(this.billingForm).then(res => {
                    console.log(res);
                }, err => {
                    console.log(err);
                });
            } else {
            }
        },

        getBillingData(){
            getBilling().then(res => {
                console.log(res);
                this.billingForm.name = res.data.name;
                this.billingForm.surname = res.data.surname;
                this.billingForm.company = res.data.company;
                this.billingForm.address = res.data.address;
                this.billingForm.country_id = res.data.country_id;
                this.billingForm.province_id = res.data.province_id;
                this.billingForm.postal_code = res.data.postal_code;
                this.billingForm.vat = res.data.vat;
            }, err => {
                this.openToastError('Something went wrong!')
            })
        },

        getCounties(){
            country().then(res => {
                this.countries = res.data[0];
            }, err => {
                console.log(err);
            })
        },
        getProvinces(){
            province().then(res => {
                this.provinces = res.data[0]
            }, err => {
                console.log(err);
            })
        }
    }
}
</script>