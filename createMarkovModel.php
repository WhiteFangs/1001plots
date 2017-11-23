<?php

require 'markov.php';

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>WikiPlot PHP Markov chain text generator by WhiteFangs</title>
</head>
<body>
<?php

set_time_limit(3600);
ini_set('memory_limit', '2048M');

$titlesTable = generate_markov_table(file_get_contents("titles.txt"), array());
file_put_contents("titlesTable.php", '<?php $titlesTable = ' . var_export($titlesTable, true) . ';');
$titlesBegin = array_keys(array_filter($titlesTable, "sentenceBegin", ARRAY_FILTER_USE_KEY));
file_put_contents("titlesBegin.php", '<?php $titlesBegin = ' . var_export($titlesBegin, true) . ';');
$plotsTable = array();
for($i = 0; $i < 20; $i++){ // adjust number of iterations for precision, beware of time and RAM consumption
    $plotsTable = generate_markov_table(file_get_contents("./plots/plots" . $i . ".txt"), $plotsTable);
}
file_put_contents("plotsTable.php", '<?php $plotsTable = ' . var_export($plotsTable, true) . ';');
$plotsBegin = array_keys(array_filter($plotsTable, "sentenceBegin", ARRAY_FILTER_USE_KEY));
file_put_contents("plotsBegin.php", '<?php $plotsBegin = ' . var_export($plotsBegin, true) . ';');
echo "<h1>DONE!</h1>";

?>

</body>
</html>