<?php

if (!is_active_sidebar('mainpagesidebar')) {
    return;
}
?>

<?php dynamic_sidebar('mainpagesidebar'); ?>