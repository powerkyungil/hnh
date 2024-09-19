<?php
    $menu = $_GET['menu']?? "";
?>

<div class="title">
    <?php if ($menu == 'portfolio') { ?>
    <h1 class="title-text">PORTPOLIO</h1>
    <?php } elseif ($menu == 'hnh') { ?>
    <h1 class="title-text">출석체크</h1>
    <?php } else { ?>
    <h1 class="title-text">메인 타이틀</h1>
    <?php } ?>
</div>