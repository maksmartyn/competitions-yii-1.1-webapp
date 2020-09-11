<?php
    $this->pageTitle=Yii::app()->name . ' - Подача заявки';
    $this->breadcrumbs=array(
        'Соревнование: ' . $name => Yii::app()->createUrl("site/sorevnovanie", array("id"=>$id)),
        'Подача заявки',
    );
?>

<h1>Создание заявки</h1>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'zayavki-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Заполните форму. Поля отмеченые <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($zayavki); ?>

	<?php echo $form->textFieldRow($zayavki,'familiya',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'imya',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'otchestvo',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'marka_avto',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'model_avto',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'proizvoditel_reziny',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'nazvanie_reziny',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->labelEx($zayavki,'privod'); ?>
    <?php echo $form->dropDownList($zayavki,'privod',array(null, 'FWD', 'RWD', '4WD'),array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->error($zayavki,'privod'); ?>
    
    <?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($zayavki,'verifyCode',array(
            'hint'=>'Введите текст с изображения.<br/>Регистр букв не важен.',
        )); ?>
	<?php endif; ?>
    
	<div align="center" class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'inverse',
            'icon'=>'ok white',
			'label'=>$zayavki->isNewRecord ? 'Готово' : 'Save',
		)); 
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'remove white',
			'label'=>'Отмена',
            'url'=>Yii::app()->createUrl("site/sorevnovanie", array("id"=>$id))
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->