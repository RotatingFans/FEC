<!DOCTYPE html>

<html>
<head>
    <title>Reservations | FEC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/Reservations.css">
    <!--[if lt IE 9]>
    <script src="Libs\jquery-1.12.4.min.js">
    </script>
    <!-- <![endif]-->
    <!--[if gt IE 8]><!-- -->

    <script src="Libs\jquery-3.1.1.min.js"></script>
    <!-- <![endif]-->

</head>
<body>
<?php include_once "header.php" ?>

<div id="body" class="content">

    <div id="reserveContent">
        <input type="button" id="prevMonth" onclick="prevMonth()" value="<-">

        <h2 id="monthHead"></h2>
        <input type="button" id="prevMonth" onclick="nextMonth()" value="->">

        <div class="calandar">

        </div>

    </div>

</div>
<?php include_once "footer.php" ?>
<div id="Respopups" class="modal">
    <div id="ReservationModal" class="modal-content">
        <div class="popupContent">
            <span class="close" onclick="closeModal()">X</span>
            <h2 id="reserveText"></h2>
            <div id="Info">
                <div>
                    <h4>
                        Start:
                    </h4>
                    <div id="start">

                    </div>
                </div>
                <div>
                    <h4>
                        End:
                    </h4>
                    <div id="end">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="ReserveModal" class="modal-content">
        <div class="popupContent">
            <span class="close" onclick="closeModal()">X</span>

            <h1>Reserve an Event</h1>
            <form id="ReserveForm" action="" method="post">

                <div id="indexGallery" class="carousel">
                    <div id="rPage" class="active">
                        <div id="event" class="formRow">
                            <h3>Choose your Event:</h3>
                            <select id="package" name="pID" onchange="updateFields()" class="required">
                                <option selected disabled hidden style='display: none' value=''></option>

                                <?php
                                require_once 'classes/Packages.php';
                                $Reservations = Packages::getPackages();
                                foreach ($Reservations as $Reservation) {
                                    echo '<option value="' . $Reservation["pID"] .
                                        '" data-cost="' . $Reservation["cost"] .
                                        '" data-unitItem="' . $Reservation["unitItem"] . '">'
                                        . $Reservation["name"] . '</option>';

                                }
                                ?>

                            </select>
                        </div>
                        <div id="rate">

                        </div>
                        <div id="Date" class="formRow field">
                            <h3>Date:</h3>
                            <input name="rDate" id="ReserveDate" type="date" onchange="updateTimeField()"
                                   class="required">
                            <div id="error"></div>
                        </div>
                        <div id="TimeStart" class="formRow field">
                            <h3>Start Time:</h3>
                            <select name="rStart" id="startTime" class="required"></select>
                        </div>
                        <div id="TimeEnd" class="formRow field">
                            <h3>End Time:</h3>
                            <select name="rEnd" id="endTime" class="required"></select>
                        </div>
                        <div id="Number" class="formRow field">
                            <h3>Approxomate Number of Guests:</h3>
                            <input name="guests" id="numPpl" type="number" class="required" value="1" min="0">
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
                        <div id="food" class="formRow field">
                            <!--<label for="foodCheck">Would you like to add food to your purchase?</label>

                            <input type="checkbox" name="food" value="food" id="foodCheck" onchange="expandFood()">-->
                            <div id="chooseFood">
                                <h3>What food would you like to add?</h3>
                                <select id="foodChoice" name="foodChoice" onchange="expandFood()">
                                    <option selected value='0'>I would not like food to be added.</option>

                                    <?php
                                    require_once 'classes/Dining.php';
                                    $Reservations = Dining::getPackageMenuItems('Food');
                                    foreach ($Reservations as $Reservation) {
                                        echo '<option value="' . $Reservation["ID"] .
                                            '" data-cost="' . $Reservation["cost"] . '">'
                                            . $Reservation["name"] . ' [+$' . $Reservation["cost"] . ']</option>';

                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="QuantityFood" class="inactive">
                                <h3>How much would you like to purchase</h3>
                                <input type="number" name="numberFood" id="numberFood" value="1" min="0">
                            </div>
                            <div id="drink">
                                <h3>Select your drink(with unlimited refills)?</h3>
                                <select id="drinkChoice" name="drinkChoice">
                                    <option selected value=''>No Drinks</option>

                                    <?php

                                    require_once 'classes/Dining.php';
                                    $Reservations = Dining::getPackageMenuItems('Drink');
                                    foreach ($Reservations as $Reservation) {
                                        $cost = $Reservation['cost'] - $Reservation['pDiscount'];
                                        echo '<option value="' . $Reservation["ID"] .
                                            '" data-cost="' . $cost . '">'
                                            . $Reservation["name"] . ' [+$' . $cost . ']</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="add">
                        <input id="rTotal" type="hidden" name="rTotal" value="0.0">
                    </div>
                    <div id="page2" class="inactive">
                        <div id="totalCost">

                        </div>
                        <div id="emailNotice">
                            If you click submit, your reservation will be requested and an email confirmation will be
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
<script type="text/javascript">
    var d = new Date();
    var month = [];
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";
    window.onload = function () {
        $('#monthHead').html(month[d.getMonth()] + ' ' + d.getFullYear());
        $.get("forms/Calandar.php", {'time': d.toISOString()})
            .done(function (data) {
                $(".calandar").html(data);
            });
    };
    function nextMonth() {
        d.setMonth(d.getMonth() + 1);
        $('#monthHead').html(month[d.getMonth()] + ' ' + d.getFullYear());

        $.get( "forms/Calandar.php", {'time': d.toISOString() })
            .done(function( data ) {
                $( ".calandar" ).html( data );
            });
    }
    function prevMonth() {
        d.setMonth(d.getMonth() - 1);
        $('#monthHead').html(month[d.getMonth()] + ' ' + d.getFullYear());

        $.get("forms/Calandar.php", {'time': d.toISOString()})
            .done(function (data) {
                $(".calandar").html(data);
            });
    }
</script>
<script type="text/javascript">
    // Get the modal
    var modal = document.getElementById('Respopups');

    // Get the button that opens the modal

    // Get the <span> element that closes the modal
    function expand(reserveText, startTime, endTime) {
        modal.style.display = "block";
        document.getElementById("ReservationModal").style.display = "block";
        document.getElementById("reserveText").innerHTML = reserveText;

        document.getElementById("start").innerHTML = startTime;
        document.getElementById("end").innerHTML = endTime;

    }
    function addReservation(date) {
        document.getElementById("ReserveDate").setAttribute("value", date);

        updateTimeField();

        modal.style.display = "block";
        document.getElementById("ReserveModal").style.display = "block";

    }

    // When the user clicks on <span> (x), close the modal
    function closeModal() {
        modal.style.display = "none";
        document.getElementById("ReserveModal").style.display = "none";
        document.getElementById("ReservationModal").style.display = "none";
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

    function expandFood() {
        var value = document.getElementById("foodChoice").value;
        var foodSection = document.getElementById("QuantityFood");
        if (value!=0) {
            foodSection.className = "active"
        }
        else {
            foodSection.className = "inactive"

        }

    }

    // Get the modal
    function updateTimeField() {
        var sTime = $('#startTime');
        var eTime = $('#endTime');
        var date = $('#ReserveDate')[0].value;
        var error = $('#Date').find('> #error')[0];
        sTime.empty();
        eTime.empty();
        $.ajax({
            method: "POST",
            url: "classes/hours.php",
            data: {date: date},
            dataType: "json"
        })
            .done(function (msg) {
                if (msg[0] == "error") {
                    error.innerHTML("date did not read correctly. Try inputting a valid date in the format mm/dd/YYYY");

                }
                else {
                    var optionStart = "";
                    var optionEnd = "";

                    for (var i = 0, len = msg.times; i < len; i++) {
                        var val = msg.Val[i];
                        var Loc = msg.Loc[i];
                        optionStart = '<option value="' + val + '">' + Loc + '</option>';
                        sTime.append(optionStart);

                        optionEnd = '<option value="' + val + '">' + Loc + '</option>';
                        if (i > 0) {
                            eTime.append(optionEnd);
                        }
                    }

                }
            });
    }
    function updateFields() {
        var select = document.getElementById("package");
        var sPackage = select.options[select.selectedIndex];
        var rateDiv = document.getElementById("rate");
        var uCost = sPackage.getAttribute('data-cost');
        var uItem = sPackage.getAttribute('data-unitItem');
        rateDiv.innerText = "NOTE: Cost is $" + uCost + " per " + uItem;


    }
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
                    else if (val < 0) {
                        writeError(this, 'Input must be at least 0!');
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
            var sTime = $('#startTime')[0].value;
            var eTime = $('#endTime')[0].value;
            if (eTime < sTime) {
                writeError($('#endTime'), 'End time must be greater than start time.');
                return;
            }
            var submitButton = document.getElementById("Submit");
            var nextButton = document.getElementById("next");
            var prevButton = document.getElementById("prev");
            var CostDiv = document.getElementById("totalCost");
            var guests = parseInt($('#numPpl')[0].value);

            var rForm = $("#rPage")[0];
            var page2 = $("#page2")[0];
            var selected = $("#package").find(':selected');
            var uCost = selected.data('cost');
            var tCost = 0.0;
            var hours = 0.0;
            var foodSelect = document.getElementById("foodChoice");
            var foodCost = foodSelect.options[foodSelect.selectedIndex].getAttribute('data-cost');
            var foodPurchase = document.getElementById("numberFood").value;
            var drinkSelect = document.getElementById("drinkChoice");
            var drinkCost = drinkSelect.options[drinkSelect.selectedIndex].getAttribute('data-cost') * 1.0;

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
            var t1 = sTime.split(':');
            var t2 = eTime.split(':');
            var d1 = new Date(0, 0, 0, t1[0], t1[1]);
            var d2 = new Date(0, 0, 0, t2[0], t2[1]);
            var diff = d2 - d1;
            hours = diff / 3600000;


            switch (selected.data('unititem')) {
                case "Hour":
                    tCost = hours * uCost;
                    break;
                case "Person":
                    tCost = guests * uCost;
                    break;
                case "Hour/Person":
                    tCost = hours * guests * uCost;

                    break;
            }
            tCost += foodCost * foodPurchase;
            tCost += drinkCost;
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
</body>
</html>
