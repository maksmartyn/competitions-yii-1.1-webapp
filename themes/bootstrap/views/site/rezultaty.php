<?php
    $this->pageTitle=Yii::app()->name . ' - Результаты';
    $this->breadcrumbs=array(
        'Соревнование: ' . $name => Yii::app()->createUrl("site/sorevnovanie", array("id"=>$id_sorevn)),
        'Результаты',
    );
?>

<h1>Результаты</h1>
<p></p>
<?php echo ('Результаты FWD:');
    $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'fwd-grid',
        'type'=>'striped bordered condensed',
        'dataProvider'=>$rezultaty->search('FWD',$id_sorevn),
        //'filter'=>$rezultaty,
        'columns'=>array(
            array('header'=>'Номер',
                'name'=>'id_nomera',
                'filter'=>CHtml::listData($fwd_nomera,'id','start_nomer'),
                'value'=>'$data->nomera->start_nomer',
                'htmlOptions'=>array('width'=>'48%'),
            ),
            array('header'=>'Время',
                'name'=>'id_zaezda',
                'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
                'value'=>'$data->zaezdy->vremya', 
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{user}',
                'buttons'=>array(
                    'user' => array(
                        'label'=>'Подробнее об участнике',
                        'icon'=>'user white',
                        'url'=>'Yii::app()->createUrl("site/uchastnik", array("id"=>$data->id_nomera))',
                        'options'=>array(
                        'class'=>'btn btn-small btn-inverse'
                        )
                    )
                )
            )
        ),
    )); 
?>
<p></p>
<?php echo ('Результаты RWD:');
    $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'rwd-grid',
        'type'=>'striped bordered condensed',
        'dataProvider'=>$rezultaty->search('RWD',$id_sorevn),
        //'filter'=>$rezultaty,
        'columns'=>array(
            array('header'=>'Номер',
                'name'=>'id_nomera',
                'filter'=>CHtml::listData($rwd_nomera,'id','start_nomer'),
                'value'=>'$data->nomera->start_nomer',
                'htmlOptions'=>array('width'=>'48%'), 
            ),
            array('header'=>'Время',
                'name'=>'id_zaezda',
                'filter'=>'',//'filter'=>CHtml::listData($zaezdy,'id','vremya'),
                'value'=>'$data->zaezdy->vremya', 
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{user}',
                'buttons'=>array(
                    'user' => array(
                        'label'=>'Подробнее об участнике',
                        'icon'=>'user white',
                        'url'=>'Yii::app()->createUrl("site/uchastnik", array("id"=>$data->id_nomera))',
                        'options'=>array(
                        'class'=>'btn btn-small btn-inverse'
                        )
                    )
                )
            )
	   ),
    )); 
?>
<p></p>
<?php echo ('Результаты 4WD:');
    $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'awd-grid',
        'type'=>'striped bordered condensed',
        'dataProvider'=>$rezultaty->search('4WD',$id_sorevn),
        //'filter'=>$rezultaty,
        'columns'=>array(
            array(
                'header'=>'Номер',
                'name'=>'id_nomera',
                'filter'=>CHtml::listData($awd_nomera,'id','start_nomer'),
                'value'=>'$data->nomera->start_nomer',
                'htmlOptions'=>array('width'=>'48%'), 
            ),
            array('header'=>'Время',
                'name'=>'id_zaezda',
                'filter'=>'',//CHtml::listData($zaezdy,'id','vremya'),
                'value'=>'$data->zaezdy->vremya', 
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{user}',
                'buttons'=>array(
                    'user' => array(
                        'label'=>'Подробнее об участнике',
                        'icon'=>'user white',
                        'url'=>'Yii::app()->createUrl("site/uchastnik", array("id"=>$data->id_nomera))',
                        'options'=>array(
                        'class'=>'btn btn-small  btn-inverse'
                        )
                    )
                )
            )
        ),
    )); 
?>