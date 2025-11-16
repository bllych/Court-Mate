<?php
require_once 'db.php';

echo "Courts:<br>";
$courts = getAllCourts();
foreach ($courts as $court) {
    echo $court['court_name'] . ' - ' . $court['location'] . '<br>';
}
?>