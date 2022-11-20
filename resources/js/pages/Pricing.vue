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
                                        <div class="nk-block-head-sub"><span>Pricing</span></div>
                                        <div class="nk-block-between-md g-4">
                                            <div class="nk-block-head-content">
                                                <h2 class="nk-block-title fw-normal">Choose Suitable Plan</h2>
                                                <div class="nk-block-des">
                                                    <p>You can change your plan any time by upgrade your plan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            <div class="col-md-4" v-for="(product, index) in products" :key="index">
                                                <div class="price-plan card card-bordered text-center">
                                                    <div class="card-inner">
                                                        <div class="price-plan-media"><img
                                                                src="/images/icons/plan-s1.svg" alt=""></div>
                                                        <div class="price-plan-info">
                                                            <h5 class="title">{{ product.nickname }}</h5><span>If you are
                                                                a small
                                                                business amn please select this plan</span>
                                                        </div>
                                                        <div class="price-plan-amount">
                                                            <div class="amount">${{ product.unit_amount }}
                                                                <span>/yr</span>
                                                            </div>
                                                                <span class="bill">1 User, Billed Yearly</span>
                                                        </div>
                                                        <div class="price-plan-action"><button
                                                                class="btn btn-primary" @click="routPage">Select Plan</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

import { products } from '../services/productService';

export default {
    data() {
        return {
            products: ''
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {

        getProducts() {
            products().then(res => {
                this.products = res.data['data'];
            }, err => {
                this.openToastError('Something went wrong!')
            });
        },
        routPage(){
            this.$router.push({name: 'add-billing'})
        }
    }
}
</script>