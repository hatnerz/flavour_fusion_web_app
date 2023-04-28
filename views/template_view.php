<!DOCTYPE html>
<html lang="en">

<?php

$choosen_page = null;
$user = null;
$notification_text = null;
$page_title = "Flavour Fusion";

if(isset($data['page_title']))
    $page_title = $data['page_title'];
if(isset($data['choosen_page']))
    $choosen_page = $data['choosen_page'];
if(isset($data['user']))
    $user = $data['user'];
if(isset($data['notification_text']))
    $notification_text = $data['notification_text'];

include "page_structure_view.php";
PageTemplate::head($page_title);
?>
<body>
    <?php
        PageTemplate::header($user);
        PageTemplate::nav($choosen_page);
        PageTemplate::main($content_view, $data);
        PageTemplate::footer();
        if($notification_text != null)
            PageTemplate::notification($notification_text);
    ?>
</body>