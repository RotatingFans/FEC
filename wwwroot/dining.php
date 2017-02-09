<!DOCTYPE html>
<html>
<head>
    <title>Dining | FEC</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/common.css">
    <link rel="stylesheet" href="Styles/dining.css">

</head>
<body>
<?php include_once "header.php" ?>

<div id="body" class="content">

    <div id="diningContent">
        <h1 id="Dtitle">Our Menu:</h1>
        <?php
        require_once "classes/Dining.php";
        $sectionhtml = '';

        $sections = Dining::getSections();
        foreach ($sections as $section) {
            $sectionhtml = '<table class="section"><caption class="Sectiontitle">';

            $menuItems = Dining::getMenuItems($section['ID']);
            $sectionhtml .= $section['name'] . '</caption>';
            foreach ($menuItems as $item) {
                $sectionhtml .= '<tr class="menuItem">
                    <td class="ItemName">' .
                        $item["name"] . ': </td>
                    <td class="ItemPrice"> $' .
                        $item["cost"] . '</div>' .
                 '</tr>';
            }
            $sectionhtml .= '</table>';
            echo $sectionhtml;

        }
        ?>

    </div>

</div>
<?php include_once "footer.php" ?>

</body>
</html>
