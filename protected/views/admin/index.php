<?php

$this->pageTitle=Yii::app()->name . ' - Админка';
$this->breadcrumbs=array(
	'Админка',
);?>

<h1>Администрирование мероприятий</h1>
<br />
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Создать соревнование',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'icon'=>'file white',
    'block'=>true,
    'url'=>array('create_sorevnovaniya'),
));

?>
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Управление соревнованиями',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'icon'=>'wrench white',
    'block'=>true,
    'url'=>array('admin_sorevnovaniya'),
));

?>
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Одобрение заявок',
    'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'icon'=>'plus white',
    'block'=>true,
    'url'=>array('admin_zayavki'),
));

?>
