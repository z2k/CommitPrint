<?php

require_once 'CommitPrint.php';

$cp = new CommitPrint();

try {
	echo sprintf('<br />Commit: %s', $cp->get());
	echo sprintf('<br />Branch: %s', $cp->getBranch());
}
catch (Exception $e) {
	var_dump($e);
}
