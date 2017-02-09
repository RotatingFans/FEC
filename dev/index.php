<!DOCTYPE html>
<html>
<head>
    <title>Home | FEC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!--[if lt IE 9]>
    <script src="Libs\jquery-1.12.4.min.js">
    </script>
    <!-- <![endif]-->
    <!--[if gt IE 8]><!-- -->
    <script src="Libs\jquery-3.1.1.min.js"></script>
    <!-- <![endif]-->

    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/index.css">
    <script type="text/javascript">
        window.setInterval(rotateImage, 5000);
        function rotateImage() {
            var imgs = $("#indexGallery").find("img");
            var nextElm;
            imgs.each(function (index, el) {
                if (index + 1 >= $("#indexGallery").find("img").length) {
                    nextElm = $("#indexGallery > #1")[0];
                }
                else {
                    nextElm = $(el).next()[0];
                }
                if (el.className == "active") {
                    nextElm.className = "sliding";
                    el.className = "slidingout";

                    $(nextElm).animate({
                        left: $(nextElm).parent().width() / 2 - $(nextElm).width() / 2
                    }, 1000, function () {
                        $(nextElm).css("left", "");
                        nextElm.className = "active";

                    });
                    $(el).animate({
                        left: "-3000px"
                    }, 1000, function () {
                        $(el).css("left", "");
                        el.className = "inactive";

                    });


                    return false;
                }
            });
        }
    </script>
</head>
<body>
<?php include_once "./header.php" ?>
<div id="indexContent" class="content">
    <div id="indexGallery" class="carousel">
        <?php
        require_once "classes/MainInfo.php";
        $carouselHtml = '';
        $active = true;
        $images = MainInfo::getImgs();
        foreach ($images as $image) {
            if ($active) {
                $carouselHtml = '<img id="' . $image['imgID'] . '" class="active" src="' . $image['src'] . '">';
                $active = false;
            } else {
                $carouselHtml = '<img id="' . $image['imgID'] . '" class="inactive" src="' . $image['src'] . '">';

            }
            echo $carouselHtml;
        }
        ?>

    </div>
    <div id="genInfo" class="col">
        <div id="descript">
            <?php
            require_once "classes/MainInfo.php";

            echo MainInfo::getDescription()['val'];

            ?>

        </div>
        <div id="hours">
            <h3>
                Hours:
            </h3>
            <table class="hours">

                <tr>
                    <th>Day of Week</th>
                    <th>Open</th>
                    <th>Close</th>
                </tr>
                <?php
                require_once "classes/MainInfo.php";
                $updatesHtml = '';

                $updates = MainInfo::getHours();
                foreach ($updates as $update) {

                    $updatesHtml = '<tr>' .
                        '<td>' . jddayofweek($update['dWeek'] - 1, 1) . '</td>' .
                        '<td>' . date('g:i A', strtotime($update['oTime'])) . '</td>' .
                        '<td>' . date('g:i A', strtotime($update['eTime'])) . '</td>' .
                        '</tr>';
                    echo $updatesHtml;
                }
                ?>

            </table>
        </div>
    </div>

    <div id="rss" class="col">
        Updates:
        <div id="updateFeed" class="rss">
            <?php
            require_once "classes/MainInfo.php";
            $updatesHtml = '';

            $updates = MainInfo::getUpdates();
            $updateCount = 0;

            foreach ($updates as $update) {
                $updatesHtml = '<div id="1" class="feedItem">' .
                    '<h5>' . $update['title'] . '</h5>' .
                    '<div id="uContent">' . $update['content'] . '</div>' .
                    '</div>';
                $updateCount++;
                echo $updatesHtml;

            }
            if ($updateCount == 0) {
                echo '<div id="1" class="feedItem">No updates at this time.</div>';
            }
            ?>


        </div>
    </div>
</div>

<?php include_once "./footer.php" ?>

</body>
</html>
