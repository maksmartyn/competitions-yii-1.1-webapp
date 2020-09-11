<?php 
    $this->pageTitle=Yii::app()->name . ' - Cоревнование: ' . $name;
    $this->breadcrumbs=array(
	   'Соревнование: ' . $name
    );
?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="form-actions">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1><?php echo $name ?></h1>

<?php if($status == 3){
?>
<p>
Соревнование проходит прямо сейчас. Чтобы принять участие в соревновании необходимо подать заявку. 
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Подать заявку на участие',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'file white',
    'url'=>Yii::app()->createUrl('site/zayavka', array('id'=>$id))
));?>
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Место проведения',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'map-marker white',
    'url'=>Yii::app()->createUrl('site/mesto', array('id'=>$id))
));?>
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Результаты',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'time white',
    'url'=>Yii::app()->createUrl('site/rezultaty', array('id'=>$id))
));
} 
?>

<?php if($status == 2){?>

<p>
Соревнование уже прошло.
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Место проведения',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'map-marker white',
    'url'=>Yii::app()->createUrl('site/mesto', array('id'=>$id))
));?>
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Результаты',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'time white',
    'url'=>Yii::app()->createUrl('site/rezultaty', array('id'=>$id))
));
}
?>

<?php if($status == 1){?>

<p>
Соревнование еще не началось. Чтобы принять участие в соревновании необходимо подать заявку.
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Подать заявку на участие',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'file white',
    'url'=>Yii::app()->createUrl('site/zayavka', array('id'=>$id))
));?>
</p>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Место проведения',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'map-marker white',
    'url'=>Yii::app()->createUrl('site/mesto', array('id'=>$id))
));}?>
</p>
<?php if(!isset($status))
    throw new CHttpException(400,'Неверный запрос. Пожалуйста не выполняйте этот запрос еще раз - это ни к чему не приведет.');
?>
