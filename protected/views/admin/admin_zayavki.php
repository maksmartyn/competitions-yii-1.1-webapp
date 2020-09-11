<?php
/* @var $this AdminController */

$this->pageTitle=Yii::app()->name . ' - Управление заявками';
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Управление заявками',
);



$this->menu=array(
    array('label'=>'Админка','url'=>array('index')),
	array('label'=>'Управление соревнованиями','url'=>array('admin_sorevnovaniya')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('zayavki-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Заявки на участие</h1>

<p>
Для принятия заявки от участника, нажмите кнопку "<b>+</b>" напротив его фамилии.
</p>


<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'inverse',
    'icon'=>'search white',
    'label'=>'Расширеный поиск',
    'url'=>'#',
    'htmlOptions'=>array(
        'class'=>'search-button'
    )
));?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('search_zayavki',array(
	'zayavki'=>$zayavki,
    'sorevnovaniya'=>$sorevnovaniya,
)); ?>
</div><!-- search-form -->


<?php
//var_dump($this->$sorevnovaniya->getAttributeLabel('nazvanie'));die;
 $this->beginWidget('bootstrap.widgets.TbGridView',array(
	'id'=>'zayavki-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$zayavki->search(),
	'filter'=>$zayavki,
	'columns'=>array(
		//'id',
        array('header'=>'Соревнование',
            'name'=>'id_sorevnovaniya',
            'filter'=>CHtml::listData($sorevnovaniya,'id','nazvanie'),
            'value'=>'$data->sorevnovaniya->nazvanie', 
                      
        ),            
		'familiya',
		'imya',
		'otchestvo',
		/*'marka_avto',
		'model_avto',
		'proizvoditel_reziny',
		'nazvanie_reziny',
		*/
        'privod',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{add} {view} ',
            'buttons'=>array(
                'add' => array(
                    'label'=>'Одобрить заявку',
                    'icon'=>'plus white',
                    'url'=>'Yii::app()->createUrl("admin/approve", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-inverse',
                    ),
                ),
                'view' => array(
                    'label'=>'Просмотреть заявку',
                    'icon'=>'list white',
                    'url'=>'Yii::app()->createUrl("admin/view_zayavki", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-inverse',
                     ),
                ),
            ),
		),
	),
)); 


$this->endWidget('bootstrap.widgets.TbGridView');
?>