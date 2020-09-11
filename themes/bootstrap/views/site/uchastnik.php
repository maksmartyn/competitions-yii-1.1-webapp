<?php
    $this->pageTitle=Yii::app()->name . ' - Участник';
    $this->breadcrumbs=array(
        'Соревнование: ' . $name => Yii::app()->createUrl("site/sorevnovanie", array("id"=>$id)),
        'Участник',
    );
?>

<h1>Участник № <?php echo $uchastnik->start_nomer?></h1>

<?php 
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$uchastnik,
	'attributes'=>array(
		'uchastniki.familiya',
		'uchastniki.imya',
		'uchastniki.otchestvo',
		'uchastniki.avto.marka',
		'uchastniki.avto.model',
		'uchastniki.rezina.proizvoditel',
		'uchastniki.rezina.nazvanie',
		'uchastniki.avto.privod',
	),
)); ?>