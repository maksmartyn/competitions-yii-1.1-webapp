<?php

$this->pageTitle=Yii::app()->name . ' - Просмотр заявки';
$this->breadcrumbs=array(
	'Админка'=>array('index'),
    'Управление заявками'=>array('admin_zayavki'),
	$zayavki->id,
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
    array('label'=>'Управление соревнованиями','url'=>array('admin_sorevnovaniya')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
	array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
	//array('label'=>'Delete Zayavki','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$zayavki->id),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h1>Заявка #<?php echo $zayavki->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$zayavki,
	'attributes'=>array(
		'familiya',
		'imya',
		'otchestvo',
		'marka_avto',
		'model_avto',
		'proizvoditel_reziny',
		'nazvanie_reziny',
		'privod',
	),
)); ?>
