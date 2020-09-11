<?php
    $this->pageTitle=Yii::app()->name . ' - Место проведения';
    $this->breadcrumbs=array(
        'Соревнование: ' . $name => Yii::app()->createUrl("site/sorevnovanie", array("id"=>$id)),
        'Место проведения',
    );
?>

<h1>Место проведения соревнования</h1>
<p></p>

отмечено на карте:
<p></p>
<?php  
    $this->widget(YandexMap, array(
        'id'=>'map',
        'width'=>600,
        'height'=>400,
        'center'=>array($koordinaty->latitude,$koordinaty->longitude),
        'controls' => array(
            'zoomControl' => true,
            'typeSelector' => true,
            'mapTools' => false,
            'smallZoomControl' => false,
            'miniMap' => true,
            'scaleLine' => true,
            'searchControl' => false,
            'trafficControl' => false
        ),
        'placemark' => array(
            array(
                'lat'=>$koordinaty->latitude,
                'lon'=>$koordinaty->longitude,
                'properties'=>array(
                    'balloonContentHeader'=>$name,
                    'balloonContent'=>'Место проведения:',
                    'balloonContentFooter'=>$koordinaty->title,
                ),
                'options'=>array(
                    'draggable'=>false
                )
            )
        ),
    ))
?>