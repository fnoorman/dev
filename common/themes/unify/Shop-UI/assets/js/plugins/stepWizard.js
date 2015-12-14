var StepWizard = function () {

    return {

        initStepWizard: function () {
            var form = $(".shopping-cart");
                form.validate({
                    errorPlacement: function errorPlacement(error, element) { element.before(error); },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        }
                    }
                });
                form.children("div").steps({
                    headerTag: ".header-tags",
                    bodyTag: "section",
                    transitionEffect: "fade",
                    labels: {
                        finish: "Purchase Now",
                    },
                    onStepChanging: function (event, currentIndex, newIndex) {
                        // Allways allow previous action even if the current form is not valid!
                        if (currentIndex > newIndex)
                        {
                            return true;
                        }
                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinishing: function (event, currentIndex) {
                        form.validate().settings.ignore = ":disabled";
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex) {

                        $("#cart-checkout").submit(function(event)
                        {
                            var postData = $(this).serializeArray();
                            var formURL = $(this).attr("action");
                            $.ajax(
                                {
                                    url : formURL,
                                    type: "POST",
                                    data : postData,
                                    success:function(data, textStatus, jqXHR)
                                    {
                                        console.log(data.result);
                                        if(data.result === 1)
                                        {
                                            document.getElementById('molpay-section').innerHTML = '';
                                            document.getElementById('molpay-section').innerHTML = data.html;
                                            document.getElementById('molpay-form').submit();
                                        }
                                        else
                                        {
                                            console.log('Something went wrong...');
                                        }

                                    },
                                    error: function(jqXHR, textStatus, errorThrown)
                                    {
                                        //if fails
                                    }
                                });
                            event.preventDefault(); //STOP default action

                        });

                        $("#cart-checkout").submit(); //Submit  the FORM

                    }
                });
        }, 

    };
}();        