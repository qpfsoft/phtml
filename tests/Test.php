<?php
use phtml\html\Head;

include 'boot.php';

$head = new Head();

$head->addContent('abc');

echo $head->end();