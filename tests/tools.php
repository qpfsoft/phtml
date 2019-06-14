<?php
$str = <<<TPL
<base>, <link>, <meta>, <script>, <style>, 以及 <title>。
TPL;

echo str_replace(['<', '>'], '', $str);