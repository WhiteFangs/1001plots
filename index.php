<?php

set_time_limit(500);
ini_set('memory_limit', '512M');
require 'markov.php';
require 'titlesTable.php';
require 'titlesBegin.php';
require 'plotsTableLighter.php'; // I used a light version for performance reasons
require 'plotsBeginLighter.php';

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>1001 Plots by WhiteFangs</title>
</head>
<body>
<?php

for($i = 0; $i < 1001; $i++){
    $titleWords = rand(1, 4);
    $title = generate_markov_text($titleWords, $titlesTable, $titlesBegin);
    $title = substr($title, 0, -1);
    $title = str_ireplace(".. ", rand(0, 1) ? ", " : ": ", $title);
    $title = str_ireplace(". ", rand(0, 1) ? ", " : ": ", $title);
    if(substr($title, -1) == "," || substr($title, -1) == ":")
        $title = substr($title, 0, -1);

    echo '<h1>';
    echo $title;
    echo '</h1>';

    echo '<p>';
    echo generate_markov_text(rand(50, 250), $plotsTable, $plotsBegin);
    echo '</p>';
}

?>

</body>
</html>