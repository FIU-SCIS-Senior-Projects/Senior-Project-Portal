
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
if(!Yii::app()->user->isGuest)
    $this->redirect('/SeniorPortal/index.php');
$hasher = new PasswordHash();
$myhash = $hasher->encode('girls');
var_dump($myhash);
$mypass = $hasher->decode($myhash);
var_dump($mypass);
?>

<h2>Login</h2>

<p>Please sign in with your FIU Google Account credentials:</p>

<div class="form" style="float: left">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?> 
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
    <a href="http://localhost/SeniorPortal/index.php/site/fiuAuth">Sign In With Google</a>
    
</div><!-- form -->
<br>
<div style="float: right">
    <h4>Feel free to preview a few of our sites:</h4>
<br>
<?php
$this->beginWidget('bootstrap.widgets.TbCarousel', array(
                'items' => array(
                    array('image' => '/SeniorPortal/images/spt_images/vjf.JPG', 'link' => 'http://vjf-dev.cis.fiu.edu/', 'label' => 'Virtual Job Fair', 'caption' => 'Provides an efficient way to make a connection between employers and job seeking students. Provides easy access to job postings, and supplies other reseources such as the ability to upload a video resume.'),
                    array('image' => '/SeniorPortal/images/spt_images/cp.JPG', 'link' => 'http://cp-dev.cis.fiu.edu/', 'label' => 'Collaborative Platform', 'caption' => 'Provides students an effective way to communicate with mentors and project team members.'),
                    array('image' => '/SeniorPortal/images/spt_images/mj.JPG', 'link' => 'http://mj.cis.fiu.edu/#login', 'label' => 'Mobile Judge', 'caption' => 'Mobile application which allows senior project judges to provide student evaluations.'),
                    array('image' => '/SeniorPortal/images/spt_images/spw.JPG', 'link' => 'http://spws.cis.fiu.edu/', 'label' => 'Senior Project Website', 'caption' => 'An important tool allowing users to propose mew projects, and explore/join ongoing projects.'),
                ),
                'htmlOptions' => array('style'=>'width: 800px'),
            ));
            $this->endWidget();
?>
</div>