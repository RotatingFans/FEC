<div class="header">
    <div id="infoHeader">
        <!--        <img id="logo" src="Images/ic_menu_black_24px.png" alt="Image goes here">
        --> <h1 id="Headtitle">Family Tymes</h1>

    </div>
    <div id="navParent">
        <ul id="navbar" class="navbar list">
            <li class="title"><h1 id="title">Family Tymes</h1><img id="ham" class="mobile"
                                                                   src="Images/ic_menu_black_24px.png"
                                                                   onclick="buttonclick()"></li>
            <li class="ham">
            </li>
            <li class="navLi"><a id="HomeLink" href="index.php">Home</a></li>
            <li class="navLi"><a id="ActivityLink" href="activities.php">Activities</a></li>
            <li class="navLi"><a id="DiningLink" href="dining.php">Dining</a></li>
            <li class="navLi"><a id="EntertainmentLink" href="entertainment.php">Entertainment</a></li>
            <li class="navLi"><a id="reservationLink" href="reservations.php">Reservations</a></li>
            <!--            <li class="navLi"><a href="services.php">Services</a></li>-->
            <li class="navLi"><a id="ContactLink" href="contact.php">Contact Us</a></li>
        </ul>

    </div>
</div>
<script type="text/javascript">
    function buttonclick() {
        var x = document.getElementById("navbar");
        if (x.className === "navbar list") {
            x.className += " responsive";
        } else {
            x.className = "navbar list";
        }
    }
</script>
