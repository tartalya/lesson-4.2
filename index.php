<?php
$dbHost = 'kalopsia.ru';
$dbUser = 'netology';
$dbName = 'lesson42';
$dbPassword = "gfintn";

$arr = array();

$link = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
mysqli_set_charset($link, "utf8");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    die();
}


if (!empty($_GET['action'])) {

    if ($_GET['action'] == 'done' && !empty($_GET['id'])) {

        $query = 'UPDATE tasks SET is_done = 1 WHERE id =' . intval($_GET['id']);

        mysqli_query($link, $query);
        ?><meta http-equiv="refresh" content="0; url=index.php"><?php
    }


    if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {

        $query = 'DELETE FROM tasks WHERE id =' . intval($_GET['id']);


        mysqli_query($link, $query);
        ?> 
        <meta http-equiv="refresh" content="0; url=index.php">

        <?php
    }

    if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {

        $query = 'SELECT * FROM tasks WHERE id =' . intval($_GET['id']);

        $result = mysqli_query($link, $query);
        $result = mysqli_fetch_assoc($result);

        if (empty($_POST['new_description'])) {

            include 'edittemplate.php';
        } else {

            $query = 'UPDATE tasks SET description ="' . $_POST['new_description'] . '" ' . 'WHERE id =' . intval($_GET['id']);

            mysqli_query($link, $query);
            ?><meta http-equiv="refresh" content="0; url=index.php"><?php
        }
    }
}



$query = 'SELECT * FROM tasks ';

if (!empty($_POST['sort_by'])) {

    if ($_POST['sort_by'] == 'date_created') {

        $query .= 'ORDER BY date_added';
    }

    if ($_POST['sort_by'] == 'is_done') {

        $query .= 'ORDER BY is_done';
    }

    if ($_POST['sort_by'] == 'description') {

        $query .= 'ORDER BY description';
    }
}

$result = mysqli_query($link, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}


if (!empty($_POST['add_description'])) {

    $query = 'INSERT INTO tasks (`description`, `date_added`) VALUES ("' . $_POST['add_description'] . '", CURRENT_TIMESTAMP)';

    mysqli_query($link, $query);
    ?><meta http-equiv="refresh" content="0; url=index.php"><?php
}

include 'template.php';
