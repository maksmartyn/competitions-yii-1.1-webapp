<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?load=package.full&amp;lang=ru-RU"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'type'=>'inverse', // null or 'inverse'
        'brand'=> CHtml::image('/images/logo.gif',"Drag-team", array('style' => 'height: 23px')),
        'brandUrl'=>array('/site/index'),
        'collapse'=>true, // requires bootstrap-responsive.css
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'О Нас', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Обратная связь', 'url'=>array('/site/contact')),
                    array('label'=>'Админка', 'url'=>array('/admin/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Авторизация', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    )
                ),
            '<form class="navbar-search pull-right" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
            )
        )
    )
    ?>
    
<div class="container" id="page">

	<div id="header">
		
	</div><!-- header -->

	<div id="mainmenu">
		
        
        
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	
    <?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		АНО "КСТК Дрег-тим" &copy; <?php echo date('Y'); ?>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
    
    
</div><!-- page -->

</body>
</html>
