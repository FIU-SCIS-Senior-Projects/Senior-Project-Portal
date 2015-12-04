<?php 
/* @var $this AdminController */
/* @var $model PortalSites */

 if(!User::model()->getCurrentUser()->isAAdmin()) {
     $this->redirect('/SeniorPortal/index.php/');
 }
 ?>

<h2>Manage Site List</h2>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed well',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'template'=>"{summary}{items}\n{pager}",
    'summaryText'=>"Displaying {start} - {end} of {count}",
    'columns'=>array(

        array (
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->name)',
            'filter' => CHtml::textField('PortalSites[name]', '', array('placeholder'=>'Search for Site Name', 'maxlength'=>'45', 'style' => 'width: 90%' )),
        ),

        array (
            'name' => 'url',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->url)',
            'filter' => CHtml::textField('PortalSites[url]', '', array('placeholder'=>'Search for Site URL', 'maxlength'=>'45', 'style' => 'width: 90%' )),
        ),

       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); 
?>


