<!DOCTYPE html>
<html>
<head>
    <title>Entertainment | FEC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/entertainment.css">
    <!--[if lt IE 9]>
    <script src="Libs\jquery-1.12.4.min.js"></script>
    <!-- <![endif]-->
    <!--[if gt IE 8]><!-- -->
    <script src="Libs\jquery-3.1.1.min.js"></script>
    <!-- <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
</head>
<body>
<?php include_once "header.php" ?>

<div id="body" class="content">

    <h1>Upcoming Events:</h1>
    <div id="entertainmentContent">
        <?php
        require_once "classes/Events.php";
        $eventHtml = '';

        $events = Events::getEvents();
        foreach ($events as $event) {
            $date = DateTime::createFromFormat('Y-m-d', $event['date']);
            $output = $date->format('n/j/Y');
            $eventHtml .= '<div id="' . $event['eID'] . '" class="performance">' .
                '<div class="mainInfo">' .
                '<h2>';
            $eventHtml .= $event['name'] . '</h2>';
            $eventHtml .= '<img class="eventImg" src="' . $event['imgSrc'] . '"/>' .
                '</div>';
            $eventHtml .= '<div id="description">' . $event['description'] . '</div>';
            $eventHtml .= '<div id="reserveInfo">' .
                '<div id="date">Date: ' . $output . '</div>' .
                '<div id="time">Time: ' . date('g:i A', strtotime($event['sTime'])) . ' - ' . date('g:i A', strtotime($event['eTime'])) . '</div>' .
                '<div id="cost">Cost: ' . $event['cost'] . ' per ' . $event['uItem'] . '</div>' .
                '<input type="button" id="reserveButton" value="RESERVE NOW" onclick="addReservation(' . $event['eID'] . ',\'' . $event['date'] . '\',\'' . date('G:i A', strtotime($event['sTime'])) . '\',\'' . date('G:i A', strtotime($event['eTime'])) . '\',' . $event['cost'] . ')">' .
                '</div>';
            $eventHtml .= '</div>';
            echo $eventHtml;
        }
        ?>

    </div>
    <div id="Respopups" class="modal">

        <div id="ReserveModal" class="modal-content">
            <div class="popupContent">
                <span class="close" onclick="closeModal()">X</span>

                <h1>Reserve an Event</h1>
                <form id="ReserveForm" action="" method="post">

                    <div id="indexGallery" class="carousel">
                        <div id="rPage" class="active">

                            <div id="Number" class="formRow field">
                                <h3>Approxomate Number of Guests:</h3>
                                <input name="guests" id="numPpl" type="number" class="required">
                            </div>
                            <div id="Name" class="formRow field">
                                <h3>Name:</h3>
                                <input name="cName" id="ReserveName" type="text" class="required">
                            </div>
                            <div id="Email" class="formRow field">
                                <h3>Email:</h3>
                                <input name="cEmail" id="ReserveEmail" type="email" class="required">
                            </div>
                            <div id="Phone" class="formRow field">
                                <h3>Phone:</h3>
                                <input name="cPhone" id="ReservePhone" type="tel" class="required">
                            </div>
                            <input id="rDate" type="hidden" name="rDate" value="0">
                            <input id="sTime" type="hidden" name="rStart" value="0">
                            <input id="eTime" type="hidden" name="rEnd" value="0">
                            <input id="uCost" type="hidden" name="cost" value="0">
                            <input id="eID" type="hidden" name="eID" value="0">

                            <input type="hidden" name="action" value="eventAdd">
                            <input id="rTotal" type="hidden" name="rTotal" value="0.0">
                        </div>
                        <div id="page2" class="inactive">
                            <div id="totalCost">

                            </div>
                            <div id="emailNotice">
                                If you click submit, your reservation will be requested and an email confirmation will
                                be
                                sent.
                            </div>
                        </div>
                    </div>

                    <div id="buttons" class="formRow">
                        <input id="prev" disabled="disabled" class="navB" type="button" value="Previous"
                               onclick="backPage()">

                        <input id="next" class="navB" type="button" value="Next" onclick="advancePage()">

                        <input id="Submit" disabled="disabled" class="navB" type="submit" value="Submit">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Get the modal
    var modal = document.getElementById('Respopups');

    // Get the button that opens the modal

    // Get the <span> element that closes the modal
    function expand(reserveText, startTime, endTime) {
        modal.style.display = "block";
        document.getElementById("reserveText").innerHTML = reserveText;

        document.getElementById("start").innerHTML = startTime;
        document.getElementById("end").innerHTML = endTime;

    }
    function addReservation(id, date, sTime, eTime, uCost) {
        document.getElementById("ReserveForm").reset();
        document.getElementById("eID").setAttribute("value", id);

        document.getElementById("rDate").setAttribute("value", date);
        document.getElementById("sTime").setAttribute("value", sTime);
        document.getElementById("eTime").setAttribute("value", eTime);
        document.getElementById("uCost").setAttribute("value", uCost);


        modal.style.display = "block";
        document.getElementById("ReserveModal").style.display = "block";

    }

    // When the user clicks on <span> (x), close the modal
    function closeModal() {
        modal.style.display = "none";
        document.getElementById("ReserveModal").style.display = "none";
        backPage();
        document.getElementById("ReserveForm").reset();

    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
<script type="text/javascript">
    $('#ReserveForm').on('submit', function (e) {

        e.preventDefault(); //prevent to reload the page

        //noinspection JSUnusedGlobalSymbols
        $.ajax({
            type: 'POST', //hide url
            url: 'forms/reserve.php', //your form validation url
            data: $('#ReserveForm').serialize(),
            success: function () {

                closeModal();
                backPage();
                document.getElementById("ReserveForm").reset();
            }
        });

    });
</script>
<script type="text/javascript">


    function writeError(obj, error) {
        $(obj).before('<div class="error">' + error + '</div>');
    }
    function validateForm() {
        //loop through all input elements
        var ret = true;
        $('.error').remove();
        $('#ReserveForm').find(':input').each(function () {
            var val = $(this).val();
            if (val == null && $(this).hasClass("required")) {
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
    function advancePage() {
        if (validateForm()) {
            var submitButton = document.getElementById("Submit");
            var nextButton = document.getElementById("next");
            var prevButton = document.getElementById("prev");
            var CostDiv = document.getElementById("totalCost");
            var guests = parseInt($('#numPpl')[0].value);
            var rForm = $("#rPage")[0];
            var page2 = $("#page2")[0];
            var uCost = $('#uCost').val();
            var tCost = 0.0;


            page2.className = "sliding";
            rForm.className = "slidingout";

            $(page2).animate({
                left: $(page2).parent().width() / 2 - $(page2).width() / 2
            }, 1000, function () {
                $(page2).css("left", "");
                page2.className = "active";

            });
            $(rForm).animate({
                left: "-3000px"
            }, 1000, function () {
                $(rForm).css("left", "");
                rForm.className = "inactive";

            });

            submitButton.disabled = false;
            nextButton.disabled = true;
            prevButton.disabled = false;


            tCost = guests * uCost;
            CostDiv.innerText = "Your Total Cost is: " + tCost;
            $('#rTotal').value = tCost;
        }
    }

    function backPage() {
        var submitButton = document.getElementById("Submit");
        var nextButton = document.getElementById("next");
        var prevButton = document.getElementById("prev");

        var rForm = $("#rPage")[0];
        var page2 = $("#page2")[0];
        rForm.className = "sliding";
        page2.className = "slidingout";

        $(rForm).animate({
            right: $(rForm).parent().width() / 2 - $(rForm).width() / 2
        }, 1000, function () {
            $(rForm).css("right", "");
            rForm.className = "active";

        });
        $(page2).animate({
            right: "-3000px"
        }, 1000, function () {
            $(page2).css("right", "");
            page2.className = "inactive";

        });
        submitButton.disabled = true;
        nextButton.disabled = false;
        prevButton.disabled = true;
    }

</script>
<?php include_once "footer.php" ?>
</body>
</html>
