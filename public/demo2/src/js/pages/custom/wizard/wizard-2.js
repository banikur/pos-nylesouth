"use strict";

// Class definition
var KTWizard2 = function() {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizard;
    var _validations = [];

    // Private functions
    var initWizard = function() {
        // Initialize form wizard
        _wizard = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: true // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
        });

        // Validation before going to next page
        _wizard.on('beforeNext', function(wizard) {
            // Don't go to the next step yet
            _wizard.stop();

            // Validate form
            var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
            validator.validate().then(function(status) {
                if (status == 'Valid') {
                    _wizard.goNext();

                    KTUtil.scrollTop();
                } else {
                    Swal.fire({
                        text: "Data Wajib di Isi Untuk ke Langkah Berikutnya",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        // Change event
        _wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    //REGISTER TANPA WIUP//

    var initValidation = function() {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    tab2_email_akun: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            },
                        }
                    },
                    tab2_nama_pic: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    count: {
                        validators: {
                            greaterThan: {
                                message: 'Mohon Check Ulang Password anda ',
                                min: 4,
                            }
                        }
                    },
                    tab2_no_ktp: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    tab1_nama_perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab1_nomor_akte: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab1_badan_usaha: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab_1_no_nib: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 3
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    tab3_alamat_perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab3_no_tlp: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab3_provinsi: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    tab3_kab_kota: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 4
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    tab4_npwp_perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 5
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    ccname: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));
    }

    return {
        // public functions
        init: function() {
            _wizardEl = KTUtil.getById('kt_wizard_v2');
            _formEl = KTUtil.getById('kt_form');

            initWizard();
            initValidation();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});