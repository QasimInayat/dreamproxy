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
                                        <div class="nk-block-head-sub"><a class="back-to" href="invoices.html"><em
                                                    class="icon ni ni-arrow-left"></em><span>Invoices</span></a></div>
                                        <div class="nk-block-between-md g-4">
                                            <div class="nk-block-head-content">
                                                <h2 class="nk-block-title fw-normal">Invoice #746F5K2</h2>
                                                <div class="nk-block-des">
                                                    <p>Your invoice details are given bellow.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="invoice">
                                            <div class="invoice-action"><a
                                                    class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary"
                                                    href="invoice-print.html" target="_blank"><em
                                                        class="icon ni ni-printer-fill"></em></a></div>
                                            <div class="invoice-wrap">
                                                <div class="invoice-brand text-center"><img
                                                        src="/images/logo-dark.png"
                                                        srcset="/images/logo-dark2x.png 2x" alt=""></div>
                                                <div class="invoice-head">
                                                    <div class="invoice-contact"><span class="overline-title">Invoice
                                                            To</span>
                                                        <div class="invoice-contact-info">
                                                            <h4 class="title">Gregory Anderson</h4>
                                                            <ul class="list-plain">
                                                                <li><em class="icon ni ni-map-pin-fill"></em><span>House
                                                                        #65, 4328 Marion Street<br>Newbury, VT
                                                                        05051</span></li>
                                                                <li><em class="icon ni ni-call-fill"></em><span>+012
                                                                        8764 556</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-desc">
                                                        <h3 class="title">Invoice</h3>
                                                        <ul class="list-plain">
                                                            <li class="invoice-id"><span>Invoice
                                                                    ID</span>:<span>66K5W3</span></li>
                                                            <li class="invoice-date"><span>Date</span>:<span>26 Jan,
                                                                    2020</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="invoice-bills">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-150px">Item ID</th>
                                                                    <th class="w-60">Description</th>
                                                                    <th>Price</th>
                                                                    <th>Qty</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>24108054</td>
                                                                    <td>Dashlite - Conceptual App Dashboard - Regular
                                                                        License</td>
                                                                    <td>$40.00</td>
                                                                    <td>5</td>
                                                                    <td>$200.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>24108054</td>
                                                                    <td>6 months premium support</td>
                                                                    <td>$25.00</td>
                                                                    <td>1</td>
                                                                    <td>$25.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>23604094</td>
                                                                    <td>Invest Management Dashboard - Regular License
                                                                    </td>
                                                                    <td>$131.25</td>
                                                                    <td>1</td>
                                                                    <td>$131.25</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>23604094</td>
                                                                    <td>6 months premium support</td>
                                                                    <td>$78.75</td>
                                                                    <td>1</td>
                                                                    <td>$78.75</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Subtotal</td>
                                                                    <td>$435.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Processing fee</td>
                                                                    <td>$10.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">TAX</td>
                                                                    <td>$43.50</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Grand Total</td>
                                                                    <td>$478.50</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was
                                                            created on a computer and is valid without the signature and
                                                            seal. </div>
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