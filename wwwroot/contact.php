<!DOCTYPE html>

<html>
<head>
    <title>Contact | FEC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/Contact.css">
    <!--[if lt IE 9]><!-- -->
    <script src="Libs\jquery-1.12.4.min.js">
    </script>
    <!-- <![endif]-->
    <!--[if gt IE 8]>
    <script src="Libs\jquery-3.1.1.min.js"></script>
    <!-- <![endif]-->
</head>
<body>
<?php include_once "header.php" ?>

<div id="body" class="content">

    <div id="ContactContent">
        <h1>Contact Us</h1>
        <div id="status"></div>
        <form id="ContactForm" action="" method="post">


            <div id="Name" class="formRow">
                <h3>Name:</h3>
                <input name="Name" id="ContactName" type="text" class="required">
            </div>
            <div id="Email" class="formRow">
                <h3>Email:</h3>
                <input name="Email" id="ContactEmail" type="email" class="required">
            </div>
            <div id="Phone" class="formRow">
                <h3>Phone:</h3>
                <input name="Phone" id="ContactPhone" type="tel" class="required">
            </div>
            <div id="Text" class="formRow">
                <h3>Message:</h3>
                <textarea name="message" id="ContactMessage" class="required" rows="20"></textarea>
            </div>
            <div id="Submit" class="formRow">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

</div>
<script type="text/javascript">
    $('#ContactForm').on('submit', function (e) {

        e.preventDefault(); //prevent to reload the page
        if (validateForm()) {
            $.ajax({
                type: 'POST', //hide url
                url: 'forms/sendContact.php', //your form validation url
                data: $('#ContactForm').serialize(),
                complete: function (e, settings) {
                    if (e.status === 200) {
                        document.getElementById('status').innerText = 'Email Successfully sent. Please wait 1-2 business days for a response.';
                    }
                    else {
                        document.getElementById('status').innerText = 'There was an error sending the email. Try again later or contacting support.';

                    }
                }

            });
        }

    });
    function writeError(obj, error) {
        $(obj).before('<div class="error">' + error + '</div>');
    }
    function validateForm() {
        //loop through all input elements
        var ret = true;
        $('.error').remove();
        $('#ContactForm').find(':input').each(function () {
            var val = $(this).val();
            if (!val && $(this).hasClass("required")) {
                writeError(this, 'Field cannot be empty');
                ret = false;

            }
            switch ($(this).data("type")) {
                case 'number':
                    if (isNaN(val)) {
                        writeError(this, 'Input must be number!');
                        ret = false;

                    }
                    break;
                case 'email':
                    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(val))) {
                        writeError(this, 'Input must be valid email address! ex: joe@example.com');
                        ret = false;

                    }
                    break;
                case 'phone':

                    if (isNaN(val)) {
                        if (val.match(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/)) {
                            break;

                        }
                        else if (val.match(/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/)) {
                            break;

                        }
                        else {
                            writeError(this, 'Input must be a valid Phone #! ex: (555)-555-5555');
                            ret = false;

                        }
                    }
                    else if (!val.match(/^\d{10}$/)) {
                        writeError(this, 'Input must be a valid Phone #! ex: (555)-555-5555');
                        ret = false;

                    }
                    break;
                case 'time':
                    if (!val.match(/^\(?[0-1]?[0-9]\)?[:]?([0-5][0-9])[ ]?([AP][M])/)) {
                        writeError(this, 'Input must be a valid Time! ex: 10:32 AM');
                        ret = false;

                    }
                    break;
                case 'date':

                    break;
            }
        });
        return ret;
    }
</script>
<?php include_once "footer.php" ?>
</body>

</html>
