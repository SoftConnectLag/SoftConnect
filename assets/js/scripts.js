jQuery(document).ready(function() {

    var email, matricNo;

    /*
        Fullscreen background
    */
    $.backstretch("assets/img/backgrounds/1.jpg");

    function getEmailAddress() {
        $.ajax({
            url: "assets/action.php",
            method: 'POST',
            data: { checkEmail: 1 },
            success: function(data) {
                // localStorage.emailAdd = data;
                email = data;
                payLagMobile();
            }
        });
    }

    function getMatricNo() {
        $.ajax({
            url: "assets/action.php",
            method: 'POST',
            data: { checkMatric: 1 },
            success: function(data) {
                // localStorage.matricNo = data;
                matricNo = data;
                payLagMobile();
            }
        });
    }

    function payLagMobile() {
        if (!email) {
            getEmailAddress();
            return;
        }
        if (!matricNo) {
            getMatricNo();
            return;
        }
        var handler = PaystackPop.setup({
            key: 'pk_test_b43c6a401419f88ec199b11665a5c6adfbc95aa9',
            email: email,
            amount: 70000,
            metadata: {
                custom_fields: [{
                        display_name: "Purpose",
                        variable_name: "full_name",
                        value: "LagMobile Payment"
                    },
                    {
                        display_name: "Matric No.",
                        variable_name: "f_name",
                        value: matricNo
                    }
                ]
            },
            callback: function(response) {
                var level = $('#student_level').val();
                $.ajax({
                    url: "assets/action.php",
                    method: "POST",
                    data: { updatePayment: 1, lvl: level },
                    success: function(data) {
                        if (data == "Yes") {
                            alert('Payment Successful');
                            location.reload();
                        } else {
                            alert('Could not Complete Action at the Moment');
                            location.reload();
                        }
                    }
                })
            },
            onClose: function() {
                alert('Transaction Ended Abruptly');
            }
        });
        handler.openIframe();
    }

    $('#top-navbar-1').on('shown.bs.collapse', function() {
        $.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function() {
        $.backstretch("resize");
    });

    /*
        Form validation
    */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    $('#registration-form').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'assets/action.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                if (data == 'Missing') {
                    alert("Sorry, the matric number given was not found.");
                } else {
                    $('#responseModal').modal('show');
                    $('#response-text').html(data);
                }
            }
        })
    });

    $('#student_level').change(function(event) {
        $('#notice').html("You Will be Charged NGN 700 for Subscribing to LagMobile Services for a Session");
    });

    $('#checkEligibility').on('submit', function(event) {
        event.preventDefault();
        var level = $('#student_level').val();

        if (level == '0') {
            alert("Please Select a Valid Level");
        } else {
            $.ajax({
                url: 'assets/action.php',
                method: 'POST',
                data: { std_lev: level },
                beforeSend: function() {
                    $("#checker").data("defHtml", $("#checker").html());
                    $('#checker').html('Checking...');
                    $('#checker').prop('disabled', true);
                },
                success: function(data) {
                    if (data == 'Exists') {
                        alert("You have previously Registered");
                        location.reload();
                    } else if (data == 'Yes') {
                        $('#checker').html('Loading Payment Platform...');
                        payLagMobile();
                    } else if (data == 'No') {
                        alert("Could Not Complete Action at the Moment... Try Again Later");
                        $('#checker').html($("#checker").data("defHtml"));
                    } else if (data == "Unpaid") {
                        $('#checker').html('Loading Payment Platform...');
                        payLagMobile();
                    } else {
                        alert("An Error Occured.. Try Again..");
                        location.reload();
                    }
                }
            })
        }

    });

});