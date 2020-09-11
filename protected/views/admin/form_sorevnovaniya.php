<?php

$this->pageTitle=Yii::app()->name . ' - Создание соревнования';
$this->breadcrumbs=array(
    'Админка'=>array('index'),
	'Создание соревнования',
);

$this->menu=array(
	array('label'=>'Админка','url'=>array('index')),
    array('label'=>'Управление соревнованиями','url'=>array('admin_sorevnovaniya')),
	array('label'=>'Управление заявками','url'=>array('admin_zayavki')),
);
?>

<h1>Новое соревнование</h1>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sorevnovaniya-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($sorevnovaniya); ?>
    
    <?php echo $form->errorSummary($koordinaty); ?>
    
    <?php echo $form->labelEx($sorevnovaniya,'data'); ?>
        
    <?php $date=$this->Widget('TDatePicker', array(
        'model'=>$sorevnovaniya,
        'attribute'=>'data',    
        'options'=> array(
            'format' => 'yyyy-M-dd',
            'weekStart'=>1,
            'autoclose'=>true,
            'todayBtn'=>true                                                
            ),    
    )); ?>
    
    <?php echo $form->error($sorevnovaniya,'data'); ?>

	<?php echo $form->textAreaRow($sorevnovaniya,'nazvanie',array('rows'=>3, 'cols'=>50, 'class'=>'span')); ?>

	<?php echo $form->textAreaRow($koordinaty,'title',array('rows'=>3, 'cols'=>50, 'class'=>'span')); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'map-marker white',
			'label'=>'Показать на карте',
            'url'=>'',
            'htmlOptions'=>array(
                'class'=>'dotted-link',
                'style'=>'margin-left:10px;',
                'onclick'=>"
                    var map=document.getElementById('map');
                    if(map.style.display=='none')
                    {
                        map.style.display='block';
                        this.innerHTML='Скрыть карту';
                    } else
                    {
                        map.style.display='none';
                        this.innerHTML='Показать на карте';
                    }
                    "
            )
		)); ?>
        
        <div id="map" style="width:500px;height:500px;display: none;"></div>
        
    <?php 
        $js = <<<EQF

ymaps.ready(function(){
	map = new ymaps.Map(
        'map',
        {
            center:[ymaps.geolocation.latitude,ymaps.geolocation.longitude],
            zoom:10
        },
        {}
    );
	map.controls.add('zoomControl').add('typeSelector').add('miniMap').add('scaleLine').add('searchControl');
    var placemark = new ymaps.Placemark(
        [ymaps.geolocation.latitude,ymaps.geolocation.longitude],
        {},
        {'draggable':true}
    );
    map.geoObjects.add(placemark);
    placemark.events.add('dragend',function(){
        $("#Koordinaty_latitude").val(placemark.geometry.getCoordinates()[0]);
    });
    placemark.events.add('dragend',function(){
        $("#Koordinaty_longitude").val(placemark.geometry.getCoordinates()[1]);
    });
});

EQF;
        Yii::app()->clientScript->registerScript('map',$js,CClientScript::POS_END);
        echo $form->hiddenField($koordinaty,'latitude');
        echo $form->hiddenField($koordinaty,'longitude');
    ?>
    

	<div align="center" class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'inverse',
            'icon'=>'ok white',
			'label'=>$sorevnovaniya->isNewRecord ? 'Создать' : 'Save',
		)); 
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'inverse',
            'icon'=>'remove white',
			'label'=>'Отмена',
            'url'=>Yii::app()->request->urlReferrer
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->