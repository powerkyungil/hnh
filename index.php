<?php
include_once $_SERVER['DOCUMENT_ROOT']."/chickendoc/application/default.php";
include_once $_SERVER['DOCUMENT_ROOT']."/chickendoc/application/function/default_func.php";

$menu = $_GET['menu']?? "";


// index.php
function includeHeader($menu)
{
    include "view/layout/header.php";
}

includeHeader($menu);


if ($menu == 'PDF') {
    include "view/item/transPDF.php";
} elseif ($menu == 'check') {
    include "view/item/textCheck.php";
} elseif ($menu == 'portfolio') {
    include "view/item/portfolio.php";
} elseif ($menu == 'hnh') {
    include "view/item/herenothere/main.php";
} else {
    include "view/item/list.php";
}

?>
