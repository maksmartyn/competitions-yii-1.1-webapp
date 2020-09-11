<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Вход';
$this->breadcrumbs=array(
	'Авторизация',
);
?>

<h1>Авторизация</h1>

<p>Для входа введите Ваши учетные данные:</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля обозначеные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password',array(
        'hint'=>'Авторизация необходима только организаторам.',
    )); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Войти',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
