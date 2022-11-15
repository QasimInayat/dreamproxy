<template>
    <div class="nk-header nk-header-fixed is-light  nk-header-fixed">
                  <div class="container-lg wide-xl">
                     <div class="nk-header-wrap">
                        <div class="nk-header-brand"><a href="index.html" class="logo-link"><img class="logo-light logo-img" src="/images/logo.png" srcset="/images/logo2x.png 2x" alt="logo"><img class="logo-dark logo-img" src="/images/logo-dark.png" srcset="/images/logo-dark2x.png 2x" alt="logo-dark"><span class="nio-version">Subscription</span></a></div>
                        <div class="nk-header-tools">
                           <ul class="nk-quick-nav">
                              <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                 <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                    <div class="quick-icon border border-light"><img class="icon" src="/images/flags/english-sq.png" alt=""></div>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                                    <ul class="language-list">
                                       <li><a href="#" class="language-item"><img src="/images/flags/english.png" alt="" class="language-flag"><span class="language-name">English</span></a></li>
                                       <li><a href="#" class="language-item"><img src="/images/flags/spanish.png" alt="" class="language-flag"><span class="language-name">Español</span></a></li>
                                       <li><a href="#" class="language-item"><img src="/images/flags/french.png" alt="" class="language-flag"><span class="language-name">Français</span></a></li>
                                       <li><a href="#" class="language-item"><img src="/images/flags/turkey.png" alt="" class="language-flag"><span class="language-name">Türkçe</span></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="dropdown user-dropdown">
                                 <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <div class="user-toggle">
                                       <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                       <div class="user-name dropdown-indicator d-none d-sm-block">{{ email }}</div>
                                    </div>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                       <div class="user-card">
                                          <div class="user-avatar"><em class="icon ni ni-user-alt"></em></div>
                                          <div class="user-info"><span class="lead-text"></span><span class="sub-text">{{ email }}</span></div>
                                          <div class="user-action"><a class="btn btn-icon me-n2" href="profile-setting.html"><em class="icon ni ni-setting"></em></a></div>
                                       </div>
                                    </div>
                                    <div class="dropdown-inner">
                                       <ul class="link-list">
                                          <li><a href="profile.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                          <li><a href="profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                          <li><a href="profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                       </ul>
                                    </div>
                                    <div class="dropdown-inner">
                                       <ul class="link-list">
                                          <li @click="logout"><a href="javascript:;"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </li>
                              <li class="dropdown notification-dropdown">
                                 <a href="#" class="dropdown-toggle nk-quick-nav-icon me-lg-n1" data-bs-toggle="dropdown">
                                    <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                    <div class="dropdown-head"><span class="sub-title nk-dropdown-title">Notifications</span><a href="#">Mark All as Read</a></div>
                                    <div class="dropdown-body">
                                       <div class="nk-notification">
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                          <div class="nk-notification-item dropdown-inner">
                                             <div class="nk-notification-icon"><em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em></div>
                                             <div class="nk-notification-content">
                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                <div class="nk-notification-time">2 hrs ago</div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="dropdown-foot center"><a href="#">View All</a></div>
                                 </div>
                              </li>
                              <li class="d-lg-none"><a href="#" class="toggle nk-quick-nav-icon me-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
</template>

<script>
   export default{
      data(){
         return{
            email:''
         }
      },
      mounted(){
         this.email = this.userEmail
      },
      methods:{
         logout(){
            localStorage.removeItem('token');
            location.reload();
         }
      }
   }
</script>