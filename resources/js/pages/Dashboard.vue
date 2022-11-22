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
                                       <h2 class="nk-block-title fw-normal">Welcome</h2>
                                       <div class="nk-block-des">
                                          <p>Welcome to our dashboard. Manage your account and your subscriptions.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Modem List  -->
                              <div class="nk-block">
                                 <div class="card card-bordered">
                                    <div class="card-inner card-inner-md">
                                       <div class="card-title-group">
                                          <h6 class="card-title">Modem List</h6>
                                          
                                       </div>
                                    </div>
                                    <table class="table table-tranx">
                                       <thead>
                                          <tr class="tb-tnx-head">
                                             <th class="tb-tnx-id"><span class="">#</span></th>
                                             <th class="tb-tnx-id"><span class="">Port</span></th>
                                             <th class="tb-tnx-id"><span class="">User Name</span></th>
                                             <th class="tb-tnx-id"><span class="">Current IP</span></th>
                                             <th class="tb-tnx-id"><span class="">Last Change IP</span></th>
                                             <th class="tb-tnx-id"><span class="">Created At</span></th>
                                             <th class="tb-tnx-id"><span class="">Expiry Date</span></th>
                                             <th class="tb-tnx-id"><span class="">Comment</span></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <!-- <tr class="tb-tnx-item">
                                             <td class="tb-tnx-id"><a href="#"><span>4947</span></a></td>
                                             
                                          </tr>
                                          <tr class="tb-tnx-item">
                                             <td class="tb-tnx-id"><a href="#"><span>4904</span></a></td>
                                             <td class="tb-tnx-info">
                                                <div class="tb-tnx-desc"><span class="title">Maintenance Year Subscription</span></div>
                                                <div class="tb-tnx-date"><span class="date">06-19-2019</span><span class="date">06-26-2019</span></div>
                                             </td>
                                             <td class="tb-tnx-amount">
                                                <div class="tb-tnx-total"><span class="amount">$99.00</span></div>
                                                <div class="tb-tnx-status"><span class="badge badge-dot bg-success">Paid</span></div>
                                             </td>
                                          </tr>
                                          <tr class="tb-tnx-item">
                                             <td class="tb-tnx-id"><a href="#"><span>4829</span></a></td>
                                             <td class="tb-tnx-info">
                                                <div class="tb-tnx-desc"><span class="title">Enterprize Year Subscrition</span></div>
                                                <div class="tb-tnx-date"><span class="date">10-04-2018</span><span class="date">10-12-2018</span></div>
                                             </td>
                                             <td class="tb-tnx-amount">
                                                <div class="tb-tnx-total"><span class="amount">$599.00</span></div>
                                                <div class="tb-tnx-status"><span class="badge badge-dot bg-success">Paid</span></div>
                                             </td>
                                          </tr> -->
                                          <tr v-for="(modem, index) in modemsList" :key="index">
                                             <td>{{index+1}}</td>
                                             <td>{{modem.port}}</td>
                                             <td>{{modem.username}}</td>
                                             <td>{{modem.current_ip}}</td>
                                             <td>{{modem.last_ip_change}}</td>
                                             <td>{{modem.creted_at}}</td>
                                             <td>{{modem.expiry_date}}</td>
                                             <td>{{modem.comment}}</td>
                                          </tr>
                                       </tbody>
                                    </table>
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

import { getModems } from '../services/modemServices';

export default {
    data() {
        return {
            modemsList: []
        }
    },
    mounted(){
        this.getModemsData();
    },  
    methods: {

        getModemsData() {
         getModems().then(res => {
               //  console.log(res);
               this.modemsList = res.data;
            }, err => {
                console.log(err);
            });
        }
    }
}
</script>