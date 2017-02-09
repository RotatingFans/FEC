<!DOCTYPE html>

<html>
<head>
    <title>Activities | FEC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--[if lt IE 9]>
    <script src="Libs\jquery-1.12.4.min.js">
    </script>
    <!-- <![endif]-->
    <!--[if gt IE 8]><!-- -->
    <script src="Libs\jquery-3.1.1.min.js"></script>
    <!-- <![endif]-->
    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/activities.css">

</head>
<body>
<?php include_once "header.php" ?>
<div id="body" class="content">

    <div id="activityContent">
        <div id="header">

            <h2>Activities</h2>




        </div>
        <div id="activities">
            <?php
            require_once "classes/Activities.php";
            $activityHtml = '';

            $activities = Activities::getActivities();
            foreach ($activities as $activity) {
                $activityHtml = '<div id="activity" class="activity" onclick="showPopup(' . $activity['ID'] . ')"><h3>';

                $activityHtml .= $activity['name'] . '</h3>';
                $activityHtml .= '<img id="pageImg" src="' . $activity['imgSrc'] . '"/>';
                $activityHtml .= '<div id="activityDescription">' . $activity['description'] . '</div>';
                $activityHtml .= '</div>';
                echo $activityHtml;
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<?php include_once "footer.php" ?>
<div id="activitypopups" class="modal">
    <?php
    require_once "classes/Activities.php";
    $activityHtml = '';

    $activities = Activities::getActivities();
    foreach ($activities as $activity) {
        $activityHtml .= '<div id="' . $activity['ID'] . '" class="modal-content">' .
            '<div class="popupContent">' .
            '<span class="close" onclick="closeModal()">X</span>' .
            '<h2>';
        $activityHtml .= $activity['name'] . '</h2>';
        $activityHtml .= '<img id="popupImage" src="' . $activity['imgSrc'] . '"/>';
        $activityHtml .= '<div id="activityDescription">' . $activity['description'] . '</div>';
        $activityHtml .= '</div></div>';
        echo $activityHtml;
    }
    ?>

</div>
<script type="text/javascript">
    // Get the modal
    var modal = document.getElementById('activitypopups');

    // Get the button that opens the modal

    // Get the <span> element that closes the modal
    function showPopup(activity) {
        modal.style.display = "block";
        $(".modal > #" + activity).css("display", "block");
    }

    // When the user clicks on <span> (x), close the modal
    function closeModal() {
        modal.style.display = "none";
        $(".modal-content").each(function (index, el) {
            el.style.display = "none";
        });
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
</body>
</html>
