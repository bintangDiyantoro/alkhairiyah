<?php
$hour = (int)date('H');
$day = (int)date('d');

if ($hour <= 16) {
    $hour += 7;
} else {
    $hour -= 17;
    $day++;
}

echo '<div style="font-size: 60px;">'.$hour . date(':i:s')  . "</div><p class='text-center' style='font-size:14px;margin-top:-5px;margin-bottom:7px'>(Waktu Indonesia Bagian Barat)</p><small>" . $day . date(' M Y'). "</small>";
