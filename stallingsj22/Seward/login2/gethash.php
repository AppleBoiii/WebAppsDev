<?php
$options = [
    'cost' => 12,
];
$phash=password_hash($_GET['pword'], PASSWORD_BCRYPT, $options);
echo $phash;

echo "<br>";
echo password_verify($_GET['pword'],$phash);

?>
