<?php
require "Marker.class.php";

$content = <<<TEST
1
<!-- TEST_ONE -->
some content
<!-- / TEST_ONE -->

2
<!-- TEST_TWO -->
some content TEST_TWO
<!-- /TEST_TWO -->

3
<!--TEST_THREE-->
some content
<!--/TEST_THREE-->

4
<!-- TEST_FOUR -->
some content
<!-- / TEST_FOUR -->
we already closed this marker on line above this one
<!-- / TEST_FOUR -->

5
<!-- TEST_FIVE -->
some content
<!-- / TEST_FIVE -->

6
<!-- TEST_SIX / -->

7
<!--TEST_SEVEN/-->
------------------------------------------------------------

TEST;

echo "1. Example - singe marker" . PHP_EOL;
echo "------------------------------------------------------------" . PHP_EOL;
echo Marker::replace($content, 'TEST_ONE', NULL);

echo "2. Example - arrays of markers and replacements" . PHP_EOL;
echo "------------------------------------------------------------" . PHP_EOL;
$markers = array();
$replace = array();

$markers[] = 'TEST_ONE';
$replace[] = 'Test one content';

$markers[] = 'TEST_TWO';
$replace[] = 'Test two content';

$markers[] = 'TEST_THREE';
$replace[] = 'Test three content';

$markers[] = 'TEST_FOUR';
$replace[] = 'Test four content';
echo Marker::replace($content, $markers, $replace);

echo "3. Example - cleanup" . PHP_EOL;
echo "------------------------------------------------------------" . PHP_EOL;
echo Marker::cleanup($content);

