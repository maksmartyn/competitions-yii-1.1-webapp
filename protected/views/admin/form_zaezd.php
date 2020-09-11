<?php

$this->pageTitle=Yii::app()->name . ' - Новый заезд';
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Управление соревнованиями'=>array('admin_sorevnovaniya'),
    'Текущее соревнование'=>Yii::app()->createUrl("admin/admin_sorevnovanie", array("id"=>$id)),
    'Новый заезд'
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
    array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
);
?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="form-actions">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'zaezd-form',
	'enableAjaxValidation'=>false
)); ?>
	
	<?php echo $form->errorSummary($zaezdy); ?>

		<?php echo $form->labelEx($rezultaty,'id_nomera'); ?>
		<?php echo $form->dropDownList($rezultaty,'id_nomera',CHtml::listData($nomera, 'id', 'start_nomer'),array(
                'class'=>'input'
            )); ?>
		<?php echo $form->error($rezultaty,'id_nomera'); ?>

		<?php echo $form->labelEx($zaezdy,'vremya'); ?>
		<?php $this->widget('CMaskedTextField', array(
            'mask' => '59:59.9999',
            'model' => $zaezdy,
            'attribute' => 'vremya',
        ));?>
        
		<?php echo $form->error($zaezdy,'vremya'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'inverse',
            'icon'=>'ok white',
			'label'=>'Сохранить',
            
		)); 
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'remove white',
			'label'=>'Отмена',
            'url'=>Yii::app()->request->urlReferrer
		)); 
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
