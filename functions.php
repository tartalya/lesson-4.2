<?php

function taskAction($link, $query)
    {

    mysqli_query($link, $query);
    ?> 
    <meta http-equiv="refresh" content="0; url=index.php">

    <?php
    }
