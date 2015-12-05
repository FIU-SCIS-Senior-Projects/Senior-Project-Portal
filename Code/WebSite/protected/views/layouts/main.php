<?php
    /* @var $this Controller */
    date_default_timezone_set('America/New_York');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

                <?php Yii::app()->bootstrap->register(); ?>

                <style type="text/css">
                    body {
                        padding-top: 60px;
                        padding-bottom: 40px;
                    }
                    .sidebar-nav {
                        padding: 9px 0;
                        width: 260px;
                    }
                </style>

                    </head>

                    <body>

                        <?php              
                            $this->widget('bootstrap.widgets.TbNavbar', array(
                                'type' => 'primary',
                                'brand' => 'Senior Project Portal',
                                'brandUrl' => '/SeniorPortal/index.php',
                                'htmlOptions' => array('role' => 'navigation'),
                                'items' => array(
                                    array(
                                        'class' => 'bootstrap.widgets.TbMenu',
                                        'items' => array('',
                                            array('label' => 'Home', 'url' => array('/')),                                          
                                        ),
                                    ),
                                    
                                    array(
                                        'class' => 'bootstrap.widgets.TbMenu',
                                        'htmlOptions' => array('class' => 'pull-right'),
                                        
                                        // Account options drop down menu.
                                        'items' => array('',
                                            
                                            
                                            array('label' => '(' . Yii::app()->user->name . ')', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                                                    array('label' => 'Home', 'url' => array('/'), 'visible' => !Yii::app()->user->isGuest), 
                                                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                                    array('label' => 'Login', 'url' => array('/'), 'visible' => false),
                                                )
                                            ),
                                        ),
                                    ),
                                ),
                            ));
                        ?>

                    <div class="container-fluid" id="page" style="border-color: white">

                        <?php
                        if(User::model()->getCurrentUser() != null) {
                            if (User::model()->getCurrentUser()->isAAdmin()) //User::model()->getCurrentUser()->isAAdmin()
                            {
                                echo "<div class=\"row-fluid\"><div class=\"span3\">";
                                echo "<div class=\"well sidebar-nav affix\">";
                                $actionid = $this->getUniqueId() . '/' . $this->getAction()->getId();
                                $this->widget('bootstrap.widgets.TbMenu', array(
                                    'type' => 'list',
                                    'items' => array(
                                        array('label' => 'ADMINISTRATION'),
                                        //   array('label' => 'Home', 'icon' => 'home', 'url' => $this->createUrl('Skillset/admin'), 'active' => in_array($actionid, array('home/adminhome', 'site/error'))),
                                        array('label' => 'Sites', 'icon' => 'globe', 'url' => $this->createUrl('/admin/admin'), 'active' => in_array($actionid, array('/admin/admin', '/admin/update', '/admin/admin'))),
                                        array('label' => 'Add Site', 'icon' => 'plus', 'url' => $this->createUrl('/admin/addSite'), 'active' => in_array($actionid, array('/admin/addSite'))),
                                    ),
                                ));
                                echo "</div></div>";

                                echo "<div class=\"span9\">";
                                echo $content;
                                echo "</div>";

                                echo "</div>";
                            }
                            else
                                echo $content;
                        }
                        else
                            echo $content;
                        ?>

                    </div>    

                    </body>
                    <div style="height: 50px"></div>
                    <div style="position:fixed; text-align:center; width:100%; height:20px; background-color:white;border-top: 1px solid rgb(206, 206, 206); padding:5px; bottom:0px; ">

                        <a target="_blank" href="http://fiu.edu">Florida International University</a> | Senior Project Portal - Senior Project - Fall 2015
                    </div>

                    </html>
