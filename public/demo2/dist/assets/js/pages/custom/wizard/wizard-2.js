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

    var initValidation = function() {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1 PERIZINAN
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    nomor_perizinan: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    ditetapkan_oleh: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    luas: {
                        validators: {
                            notEmpty: {
                                message: 'Harap di Isi'
                            }
                        }
                    },
                    lokasi_1: {
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

        // Step 2 DIEREKSI
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    count: {
                        validators: {
                            greaterThan: {
                                message: 'Minimal 1 Staff ',
                                min: 1,
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

        // Step 3 SAHAM
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    count_saham: {
                        validators: {
                            greaterThan: {
                                message: 'Minimal 1 Pemilik Saham',
                                min: 1,
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
                    count: {
                        validators: {
                            greaterThan: {
                                message: 'Dokumen Wajib Di Isi',
                                min: 1,
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