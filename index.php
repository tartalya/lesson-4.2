<?php
require_once 'functions.php';

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


if (!empty($_GET['action']) && !empty($_GET['id'])) {

    $id = intval($_GET['id']);

    if ($_GET['action'] == 'done') {

        $query = 'UPDATE tasks SET is_done = 1 WHERE id =' . $id;
    }


    if ($_GET['action'] == 'delete') {

        $query = 'DELETE FROM tasks WHERE id =' . $id;
    }

    if ($_GET['action'] == 'edit') {

        $query = 'SELECT * FROM tasks WHERE id =' . $id;

        $result = mysqli_query($link, $query);
        $result = mysqli_fetch_assoc($result);

        if (empty($_POST['new_description'])) {

            include 'edittemplate.php';
        } else {

            $query = 'UPDATE tasks SET description ="' . $_POST['new_description'] . '" ' . 'WHERE id =' . intval($_GET['id']);
        }
    }

    taskAction($link, $query);
}



$query = 'SELECT * FROM tasks ';


if (!empty($_POST['sort_by'])) {


    $query .= 'ORDER BY ' . mysqli_real_escape_string($link, $_POST['sort_by']);
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
