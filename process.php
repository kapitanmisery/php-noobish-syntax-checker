<?php
require_once("utils.php");
require_once("SyntaxChecker.php");

$code = $_REQUEST['code'];
echo "<p><a href='index.php'>Go back to form.</a> </p>";
echo "<p><strong>Here's the code you're trying to to analyse the syntax:</strong></p>";
echo generate_displayable_php_code($code);


$parser = SyntaxChecker::createInstance()
    ->setCode($code)
    ->analyzeAndDisplay();
