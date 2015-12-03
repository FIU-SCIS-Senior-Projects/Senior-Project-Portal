<?php
// Redirect user appropriately when they access the site index
if(Yii::app()->user->isGuest) {
    $this->redirect('/SeniorPortal/index.php/site/login');
}
else if(User::model()->getCurrentUser() != null && User::model()->getCurrentUser()->isAAdmin()) {
    $this->redirect('/SeniorPortal/index.php/admin/admin');
}
else if(User::model()->getCurrentUser() != null && User::model()->getCurrentUser()->isADefaultUser()) {
    $this->redirect('/SeniorPortal/index.php/site/home');
}
else {
    $this->redirect('/SeniorPortal/index.php');
}
?>

<h1>Index</h1>