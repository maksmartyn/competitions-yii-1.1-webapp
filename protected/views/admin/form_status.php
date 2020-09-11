<?php

$this->pageTitle=Yii::app()->name . ' - Начать соревнование';
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Управление соревнованиями'=>array('admin_sorevnovaniya'),
    'Текущее соревнование'=>Yii::app()->createUrl("admin/admin_sorevnovanie", array("id"=>$id)),
    'Начать соревнование'
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
    array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
);
?>
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'status-form',
	'enableAjaxValidation'=>false,
)); ?>

<div align="center" class="form-actions">
    <p class="help-block">
        <span class="required">
        На данный момент идет другое соревнование. Хотите закончить его и начать данное соревнование?
        </span>
    </p>   
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'inverse',
            'icon'=>'ok white',
			'label'=>'Да',
                       
		)); 
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'remove white',
			'label'=>'Нет',
            'url'=>Yii::app()->request->urlReferrer//'javascript:history.go(-1)'
		)); 
        ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->