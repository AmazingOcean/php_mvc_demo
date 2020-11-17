<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php echo $title ?>
        </title>
    </head>

    <body>
        <ul>
        <?php 
            foreach ($result as $row) {
                ?><li><?php echo $row->uname ?></li><?php
            }
        ?>
        </ul>

    </body>

</html>