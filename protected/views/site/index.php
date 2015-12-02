<?php

if(Yii::app()->user->isGuest) {
    $this->redirect('/SeniorPortal/index.php/site/login');
}
else if(User::model()->getCurrentUser()->isAAdmin()) {
    $this->redirect('/SeniorPortal/index.php/admin/admin');
}
else if(User::model()->getCurrentUser()->isADefaultUser()) {
    $this->redirect('/SeniorPortal/index.php/site/home');
}
echo Yii::app()->user->name;
?>

<h1>This is the index</h1>