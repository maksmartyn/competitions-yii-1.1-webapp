<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->label(Sorevnovaniya::model(),'nazvanie')?>
    
    <?php echo $form->dropDownList($zayavki,'id_sorevnovaniya',CHtml::listData($sorevnovaniya, 'id', 'nazvanie'),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($zayavki,'familiya',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'imya',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'otchestvo',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'marka_avto',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'model_avto',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'proizvoditel_reziny',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'nazvanie_reziny',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($zayavki,'privod',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Найти',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
