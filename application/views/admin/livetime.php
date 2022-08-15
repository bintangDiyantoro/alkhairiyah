<?php
$hour = (int)date('H');
$day = (int)date('d');

if ($hour <= 16) {
    $hour += 7;
} else {
    $hour -= 17;
    $day++;
}

echo '<div style="font-size: 60px;">'.$hour . date(':i:s')  . "</div><br><small>" . $day . date(' M Y'). "</small>";
