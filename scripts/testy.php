<?php

require_once "../includes/autoloader.inc.php";

$test = new Utilities();

echo $test->get_today();
echo "<br>";
echo $test->get_estimated();

echo "<br>";
echo "<select>";
echo $test->get_reservations();
echo "</select>";

echo "<br>";
echo "<select>";
echo $test->get_users();
echo "</select>";

echo "<br>";
echo "<select>";
echo $test->get_publishers();
echo "</select>";