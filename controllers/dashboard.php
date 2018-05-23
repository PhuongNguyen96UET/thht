<?php if (!defined('IN_SITE')) die ('The request not found');
function getDashBoard()
{
    if (!is_logged()){
        redirect(base_url(), array('controller' => 'login', 'action' => 'logout'));
    }
    include_once('views/base/header.php');
    include_once('views/base/footer.php');
}
?>