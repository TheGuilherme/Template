<?php

require_once './Template.php';

$template = new Template('home.tpl');
$template->assign('name', 'Guilherme');
$template->assign('age', '22');
$template->display();