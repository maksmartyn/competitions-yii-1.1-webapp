<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Добро пожаловать!',
    'headingOptions' => array(
        'align' => 'center',
        ),
    'htmlOptions' => array(
        'align' => 'center',
        ),
)); ?>

<p>На данной странице показаны соревнования по ледовым ралли-спринтам.</p>

<?php $this->endWidget(); 
    $empt = array();
?>

<h3>Предстоящие:</h3>
<?php if($future == $empt)
        echo 'В ближайшее время не планируется ни одного соревнования';
    else 
        $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'future-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$sorevnovaniya->search(1),
            //'filter'=>$sorevnovaniya,
            'columns'=>array(
                array(
                    'name'=>'data',
                    'htmlOptions'=>array('width'=>'20%'),
                ), 
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}',
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Подробнее',
                            'icon'=>'list white',
                            'url'=>'Yii::app()->createUrl("site/sorevnovanie", array("id"=>$data->id))',
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
            //'filter'=>$sorevnovaniya,
            'columns'=>array(
                array(
                    'name'=>'data',
                    'htmlOptions'=>array('width'=>'20%'),
                ), 
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}',
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Подробнее',
                            'icon'=>'list white',
                            'url'=>'Yii::app()->createUrl("site/sorevnovanie", array("id"=>$data->id))',
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
            //'filter'=>$sorevnovaniya,
            'columns'=>array(
                array(
                    'name'=>'data',
                    'htmlOptions'=>array('width'=>'20%'),
                ), 
                'nazvanie',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}',
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Подробнее',
                            'icon'=>'list white',
                            'url'=>'Yii::app()->createUrl("site/sorevnovanie", array("id"=>$data->id))',
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
