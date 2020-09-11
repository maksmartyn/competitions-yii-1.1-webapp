<?php
/* @var $this AdminController */

$this->pageTitle=Yii::app()->name . ' - Cоревнование: ' . $name;
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Управление соревнованиями'=>array('admin_sorevnovaniya'),
    'Соревнование: ' . $name
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
    array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
);
?>

<h1><?php echo $name ?></h1>
<?php if($status == 3){
?>
<p>
Для выполнения действий с данным соревнованием нажмите соответсвующую кнопку.
</p>

<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Закончить соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'stop white',
    'url'=>Yii::app()->createUrl('admin/stop_sorevnovanie', array('id'=>$id_sorevn))
));
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Удалить соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'trash white',
    'url'=>Yii::app()->createUrl('admin/delete_sorevnovanie', array('id'=>$id_sorevn)),
    'htmlOptions'=>array('confirm'=>'При удалении соревнования все связанные данные будут так же удалены. Продолжить?')
));
?>
<p></p>

<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Новый заезд',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'flag white',
    'url'=>Yii::app()->createUrl('admin/new_zaezd', array('id'=>$id_sorevn))
));?>
<p></p>
<?php echo ('Результаты FWD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'fwd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('FWD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($fwd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer', 
            'htmlOptions'=>array('width'=>'50%'),
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
)); 
?>
<p></p>
<?php echo ('Результаты RWD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'rwd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('RWD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($rwd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer',
            'htmlOptions'=>array('width'=>'50%'), 
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
)); 
?>
<p></p>
<?php echo ('Результаты 4WD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'awd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('4WD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($awd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer', 
            'htmlOptions'=>array('width'=>'50%'),
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
));} 
?>
<?php if($status == 2){?>

<p>
Соревнование уже прошло. Если хотите вновь его начать нажмите кнопку ниже.
</p>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Начать соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'play white',
    'url'=>Yii::app()->createUrl('admin/start_sorevnovanie', array('id'=>$id_sorevn))
));
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Удалить соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'trash white',
    'url'=>Yii::app()->createUrl('admin/delete_sorevnovanie', array('id'=>$id_sorevn)),
    'htmlOptions'=>array('confirm'=>'При удалении соревнования все связанные данные будут так же удалены. Продолжить?')
));?>
<p></p>
<?php echo ('Результаты FWD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'fwd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('FWD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($fwd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer', 
            'htmlOptions'=>array('width'=>'50%'),
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
)); 
?>
<p></p>
<?php echo ('Результаты RWD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'rwd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('RWD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($rwd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer',
            'htmlOptions'=>array('width'=>'50%'), 
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
)); 
?>
<p></p>
<?php echo ('Результаты 4WD:');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'awd-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$rezultaty->search('4WD',$id_sorevn),
	'filter'=>$rezultaty,
	'columns'=>array(
		array('header'=>'Номер',
            'name'=>'id_nomera',
            'filter'=>CHtml::listData($awd_nomera,'id','start_nomer'),
            'value'=>'$data->nomera->start_nomer',
            'htmlOptions'=>array('width'=>'50%'), 
            ),
		array('header'=>'Время',
            'name'=>'id_zaezda',
            'filter'=>'',//CHtml::listData($zaezdy,'id','vremya'),
            'value'=>'$data->zaezdy->vremya', 
            ),
		
	),
));}
?>
<?php if($status == 1){?>

<p>
Соревнование еще не началось. Если хотите его начать нажмите кнопку ниже.
</p>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Начать соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'play white',
    'url'=>Yii::app()->createUrl('admin/start_sorevnovanie', array('id'=>$id_sorevn))
));
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Удалить соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'icon'=>'trash white',
    'url'=>Yii::app()->createUrl('admin/delete_sorevnovanie', array('id'=>$id_sorevn)),
    'htmlOptions'=>array('confirm'=>'При удалении соревнования все связанные данные будут так же удалены. Продолжить?')    
));}
if(!isset($status))
    throw new CHttpException(400,'Неверный запрос. Пожалуйста не выполняйте этот запрос еще раз - это ни к чему не приведет.');
?>
