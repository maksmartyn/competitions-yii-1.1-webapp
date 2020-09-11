<?php
/* @var $this AdminController */

$this->pageTitle=Yii::app()->name . ' - Список соревнований';
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Управление соревнованием',
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
	array('label'=>'Новое соревнование','url'=>array('create_sorevnovaniya')),
    array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
);
$empt = array();
?>

<h1>Соревнования</h1>

<p>
Для выполнения действий с конкретным соревнованием нажмите соответсвующую кнопку в таблице ниже.
</p>

<h3>Предстоящие:</h3>
<?php if($future == $empt)
        echo 'В ближайшее время не планируется ни одного соревнования';
    else 
        $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'future-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$sorevnovaniya->search(1),
            'filter'=>$sorevnovaniya,
            'columns'=>array(
                'data',
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{admin}',
                    'buttons'=>array(
                        'admin' => array(
                            'label'=>'Управление',
                            'icon'=>'wrench white',
                            'url'=>'Yii::app()->createUrl("admin/admin_sorevnovanie", array("id"=>$data->id))',
                            'options'=>array(
                            'class'=>'btn btn-small btn-inverse'
                            )
                        )
                    )
                )
            )
        )
    );
?>
<h3>Идущие сейчас:</h3>
<?php if($present == $empt)
        echo 'На данный момент не идет ни одного соревнования';
    else 
        $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'present-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$sorevnovaniya->search(3),
            'filter'=>$sorevnovaniya,
            'columns'=>array(
                'data',
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{admin}',
                    'buttons'=>array(
                        'admin' => array(
                            'label'=>'Управление',
                            'icon'=>'wrench white',
                            'url'=>'Yii::app()->createUrl("admin/admin_sorevnovanie", array("id"=>$data->id))',
                            'options'=>array(
                            'class'=>'btn btn-small btn-inverse'
                            )
                        )
                    )
                )
            )
        )
    );
?>
<h3>Прошедшие:</h3>
<?php if($past == $empt)
        echo 'На данный момент еще не прошло ни одного соревнования';
    else 
        $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'past-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$sorevnovaniya->search(2),
            'filter'=>$sorevnovaniya,
            'columns'=>array(
                'data',
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{admin}',
                    'buttons'=>array(
                        'admin' => array(
                            'label'=>'Управление',
                            'icon'=>'wrench white',
                            'url'=>'Yii::app()->createUrl("admin/admin_sorevnovanie", array("id"=>$data->id))',
                            'options'=>array(
                            'class'=>'btn btn-small btn-inverse'
                            )
                        )
                    )
                )
            )
        )
    );
?>


