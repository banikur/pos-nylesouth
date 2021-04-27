<!--begin::Quick Panel-->
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
    <!--begin::Header-->
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications">Notifikasi
                    <span class="badge badge-danger badge-pill badge-sm font-weight-bold">0</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_settings">Settings</a>
            </li> -->
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            <!--begin::Tabpane-->
            <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_logs" role="tabpanel">
                <!--begin::Section-->
                <div class="mb-15">
                    <h5 class="font-weight-bold mb-5">Notifikasi</h5>
                    <!--begin: Item-->
                    
                    <div class="d-flex align-items-center bg-light-info rounded p-5 mb-2">
                        <div class="symbol symbol-30 symbol-light mr-5">
                            <span class="symbol-label">
                                <i class="la la-user-astronaut text-success icon-2x"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" style="cursor:pointer" onclick="markAsRead(this)" data-item="" class="font-weight-bolder text-dark-75 text-hover-primary font-size-sm mb-1">Notifikasi</a>
                            <span class="text-info font-size-xs font-weight-bold">
                                <smal><em>dibuat tgl.{{date('d-m-Y h:i:s')}}</em></smal>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center bg-light-info rounded p-5 mb-2">
                        <div class="symbol symbol-30 symbol-light mr-5">
                            <span class="symbol-label">
                                <i class="la la-info-circle icon-2x"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <span class="text-info font-weight-bold">Tidak ada notifikasi</div>
                    </div>
                </div>
               
                <!--end: Item-->


            </div>
            <!--end::Section-->
            <!--begin::Section-->

            <!--end::Section-->
        </div>
        <!--end::Tabpane-->
        <!--begin::Tabpane-->
        <div class="tab-pane fade pt-2 pr-5 mr-n5" id="kt_quick_panel_notifications" role="tabpanel">
            <!--begin::Nav-->
            <div class="navi navi-icon-circle navi-spacer-x-0">
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-bell text-success icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">5 new user generated report</div>
                            <div class="text-muted">Reports based on sales</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon2-box text-danger icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">2 new items submited</div>
                            <div class="text-muted">by Grog John</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-psd text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">79 PSD files generated</div>
                            <div class="text-muted">Reports based on sales</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon2-supermarket text-warning icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                            <div class="text-muted">Total 234 items</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                            <div class="text-muted">Fostest is Barry</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-safe-shield-protection text-danger icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">3 Defence alerts</div>
                            <div class="text-muted">40% less alerts thar last week</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-notepad text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">Avarage 4 blog posts per author</div>
                            <div class="text-muted">Most posted 12 time</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-users-1 text-warning icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">16 authors joined last week</div>
                            <div class="text-muted">9 photodrapehrs, 7 designer</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon2-box text-info icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">2 new items have been submited</div>
                            <div class="text-muted">by Grog John</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon2-download text-success icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">2.8 GB-total downloads size</div>
                            <div class="text-muted">Mostly PSD end AL concepts</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon2-supermarket text-danger icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                            <div class="text-muted">Total 234 items</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-bell text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">7 new user generated report</div>
                            <div class="text-muted">Reports based on sales</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
                <!--begin::Item-->
                <a href="#" class="navi-item">
                    <div class="navi-link rounded">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label">
                                <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                            <div class="text-muted">Fostest is Barry</div>
                        </div>
                    </div>
                </a>
                <!--end::Item-->
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Tabpane-->
        <!--begin::Tabpane-->
        <div class="tab-pane fade pt-3 pr-5 mr-n5" id="kt_quick_panel_settings" role="tabpanel">
            <form class="form">
                <!--begin::Section-->
                <div>
                    <h5 class="font-weight-bold mb-3">Customer Care</h5>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Enable Notifications:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-success switch-sm">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Enable Case Tracking:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-success switch-sm">
                                <label>
                                    <input type="checkbox" name="quick_panel_notifications_2" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Support Portal:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-success switch-sm">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
                <div class="separator separator-dashed my-6"></div>
                <!--begin::Section-->
                <div class="pt-2">
                    <h5 class="font-weight-bold mb-3">Reports</h5>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Generate Reports:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-danger">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Enable Report Export:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-danger">
                                <label>
                                    <input type="checkbox" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Allow Data Collection:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-danger">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
                <div class="separator separator-dashed my-6"></div>
                <!--begin::Section-->
                <div class="pt-2">
                    <h5 class="font-weight-bold mb-3">Memebers</h5>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Enable Member singup:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-primary">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-primary">
                                <label>
                                    <input type="checkbox" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 row align-items-center">
                        <label class="col-8 col-form-label">Enable Customer Portal:</label>
                        <div class="col-4 d-flex justify-content-end">
                            <span class="switch switch-sm switch-primary">
                                <label>
                                    <input type="checkbox" checked="checked" name="select" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
            </form>
        </div>
        <!--end::Tabpane-->
    </div>
</div>
<!--end::Content-->
</div>
<!--end::Quick Panel-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>
</div>
<!--end::Scrolltop-->