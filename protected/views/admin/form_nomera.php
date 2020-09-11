<?php

$this->pageTitle=Yii::app()->name . ' - Одобрение заявки';
$this->breadcrumbs=array(
	'Админка'=>array('index'),
    'Управление заявками'=>array('admin_zayavki'),
	'Одобрение заявки'
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
    array('label'=>'Управление соревнованиями','url'=>array('admin_sorevnovaniya')),
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

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'nomera-form',
    'enableAjaxValidation'=>false,
    ));?>
    
    <p class="help-block">Присвоить номер:</p>
    
    <?php echo $form->textField($nomera, 'start_nomer');?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'inverse',
            'icon'=>'ok white',
			'label'=>'Одобрить',
            
		)); 
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'remove white',
			'label'=>'Отмена',
            'url'=>isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin_zayavki')
		)); 
        ?>
	</div>
    
 <?php $this->endWidget();?>
 
 </div><!-- form -->