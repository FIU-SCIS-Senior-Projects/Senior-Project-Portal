<?php 
/* @var $this AdminController */
/* @var $model PortalSites */
/* @var $form TbActiveForm */
if(!User::model()->getCurrentUser()->isAAdmin()){
        $this->redirect('/SeniorPortal/index.php');
    }
 ?>

<script>
    $(document).ready(function()
    {
        $('#buttonStateful').click(function()
        {
            var btn = $(this);
            btn.button('loading'); // call the loading function
            setTimeout(function()
            {
                btn.button('reset'); // call the reset function
            }, 3000);
        });
    })
</script>


<div id="confirmation">
    <?php if($confirmation != '')
          {
    ?>
             <div class="alert alert-success" style='text-align: center;' role="alert"> <strong> <p><?php echo $confirmation ?> </p> </strong></div> 
    <?php } ?>
</div>

<?php
    if($confirmation == '')
    {
?>   
        <h2>Edit List</h2>
    <?php
    }
    ?>

<?php
    if ($confirmation == '')
    {
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form', 'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'well'), ));
    }
?>


<?php
    if($confirmation == '')
    {
?>
        <fieldset>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php
                echo $form->errorSummary($model);
                echo $form->textFieldRow($model, 'name', array('maxlength' => 50, 'class' => 'span3'));
                echo $form->textFieldRow($model, 'url', array('maxlength' => 500, 'class' => 'span3'));
            ?>

        </fieldset>
        <?php
    }
?>

<?php
    if($confirmation == '')
    {
?>
        <div class="form-actions">
            <?php 
                $this->widget('bootstrap.widgets.TbButton', array('type' => 'primary', 'buttonType' => 'submit', 'label' => 'Save')); 
            
                $this->widget('bootstrap.widgets.TbButton', array('label' => 'Cancel',
                            'htmlOptions' => array(
                                'onclick' => 'js:document.location.href="' . Yii::app()->createAbsoluteUrl("admin/admin") . '"'
                                ),
                            )
                );
            ?>
        </div>

<?php
    }
?>
        
<?php
    if($confirmation == '')
        $this->endWidget();
?>
