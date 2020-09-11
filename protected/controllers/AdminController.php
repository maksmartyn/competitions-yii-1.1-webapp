<?php 

class adminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    
    
        
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('index','admin_zayavki','view_zayavki','approve','create_sorevnovaniya','admin_sorevnovaniya','admin_sorevnovanie','stop_sorevnovanie','start_sorevnovanie','delete_sorevnovanie','new_zaezd'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
    
    /**
    * Главная страница "Админки"
    */
    public function actionIndex()
	{
		$this->render('index');
	}
    
    /**
    * Создание нового соревнования
    */
	public function actionCreate_sorevnovaniya()
	{
		$sorevnovaniya = new Sorevnovaniya;
        $koordinaty = new Koordinaty;
        $sorevnovaniya->status = 1;
       
        if(isset($_POST['Sorevnovaniya']))
        {
            $koordinaty->title = $_POST['Koordinaty']['title'];
            $koordinaty->latitude = $_POST['Koordinaty']['latitude'];
            $koordinaty->longitude = $_POST['Koordinaty']['longitude'];
            $sorevnovaniya->attributes = $_POST['Sorevnovaniya'];
            if($koordinaty->save() && $sorevnovaniya->save())
            {
                $sorevnovaniya->mesto = $koordinaty->id;
                $sorevnovaniya->save();
                $this->redirect('index'); 
            }        
        }
        $this->render('form_sorevnovaniya',array(
            'sorevnovaniya'=>$sorevnovaniya,
            'koordinaty'=>$koordinaty
        ));
	}
    
    /**
    * Просмотр списка соревнований и выбор соревнования для управления
    */
    public function actionAdmin_sorevnovaniya()
    {
        $future = Sorevnovaniya::model()->findAll(array(
            'condition'=>'status=:status',
            'params'=>array(':status'=>1),
        ));        
        $present = Sorevnovaniya::model()->findAll(array(
            'condition'=>'status=:status',
            'params'=>array(':status'=>3),
        ));
        $past = Sorevnovaniya::model()->findAll(array(
            'condition'=>'status=:status',
            'params'=>array(':status'=>2),
        ));
        $sorevnovaniya = new Sorevnovaniya('search');
        $sorevnovaniya->unsetAttributes();  // clear any default values
		if(isset($_GET['Sorevnovaniya']))
			$sorevnovaniya->attributes=$_GET['Sorevnovaniya'];		
        $this->render('admin_sorevnovaniya', array(
            'sorevnovaniya' => $sorevnovaniya,
            'future' => $future,
            'present' => $present,
            'past' => $past
        ));
    }
    
    /**
    * Управление выбраным соревнованием
    */
    public function actionAdmin_sorevnovanie($id)
    {
        $fwd_nomera = Nomera::model()->with('uchastniki')->findAll(array(
            'condition'=>'id_sorevn=:id_sorevn AND privod=:privod',
            'params'=>array(
                ':id_sorevn'=>$id, 
                ':privod'=>'FWD'
                ),
        ));
        $rwd_nomera = Nomera::model()->with('uchastniki')->findAll(array(
            'condition'=>'id_sorevn=:id_sorevn AND privod=:privod',
            'params'=>array(
                ':id_sorevn'=>$id, 
                ':privod'=>'RWD'
                ),
        ));
        $awd_nomera = Nomera::model()->with('uchastniki')->findAll(array(
            'condition'=>'id_sorevn=:id_sorevn AND privod=:privod',
            'params'=>array(
                ':id_sorevn'=>$id, 
                ':privod'=>'4WD'
                ),
        ));
        $rezultaty = new Rezultaty('search');
        $status = Sorevnovaniya::model()->findByPk($id)->status;
        $name = Sorevnovaniya::model()->findByPk($id)->nazvanie;
        $rezultaty->unsetAttributes();  // clear any default values
		if(isset($_GET['Rezultaty']))
			$rezultaty->attributes=$_GET['Rezultaty'];
        $this->render('admin_sorevnovanie',array(
			'id_sorevn'=>$id,
            'fwd_nomera'=>$fwd_nomera,
            'rwd_nomera'=>$rwd_nomera,
            'awd_nomera'=>$awd_nomera,
            'rezultaty'=>$rezultaty,
            'status'=>$status,
            'name'=>$name
            )
        );
    }
    
    /**
    * Запуск выбраного соревнования
    */
    public function actionStart_sorevnovanie($id)
	{
        $sorevnovaniya = Sorevnovaniya::model()->find(array(
            'condition'=>'status=:status',
            'params'=>array(':status'=>3)));
        $sorevnovanie = Sorevnovaniya::model()->findByPk($id);
        if(!Yii::app()->request->isPostRequest){
            if(isset($sorevnovaniya))
                $this->render('form_status',array('id' => $id));
            else {
                $sorevnovanie = Sorevnovaniya::model()->findByPk($id);
                $sorevnovanie->status = 3;
                $sorevnovanie->save();
                if(!isset($_GET['ajax']))
                    $this->redirect(array('admin_sorevnovanie','id'=>$id));
            }
        }
        else {
            if(isset($sorevnovaniya)){
                $sorevnovaniya->status = 2;
                $sorevnovaniya->save();
                $sorevnovanie->status = 3;
                $sorevnovanie->save();
                if(!isset($_GET['ajax']))
                    $this->redirect(array('admin_sorevnovanie','id'=>$id));
            }
            else
                throw new CHttpException(400,'Неверный запрос. Пожалуйста не выполняйте этот запрос еще раз - это ни к чему не приведет.');
        }    
    }
    
    /**
    * Прекращение выбраного соревнования
    */
    public function actionStop_sorevnovanie($id)
	{
        $sorevnovaniya = Sorevnovaniya::model()->findByPk($id);
        $sorevnovaniya->status = 2;
        $sorevnovaniya->save();
        $zayavki = new Zayavki('search');
        $zayavki->deleteAll(array(
            'condition'=>'id_sorevnovaniya=:id_sorevnovaniya',
            'params'=>array(':id_sorevnovaniya'=>$id)
        ));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(Yii::app()->request->urlReferrer);
    }
	
    /**
    * Удаление выбраного соревнования
    */
	public function actionDelete_sorevnovanie($id)
	{
		$sorevnovaniya = Sorevnovaniya::model()->findByPk($id);
        if(isset($sorevnovaniya))
		{
			$nomera = Nomera::model()->findAllByAttributes(array('id_sorevn'=>$id));
            foreach($nomera as $nomer){
                if(isset($nomer)){
                    $uchastniki = Uchastniki::model()->findByPk($nomer->id_uchast);
                    if(isset($uchastniki)){
                        $avto = Avto::model()->findByPk($uchastniki->id_avto);
                        $rezina = Rezina::model()->findByPk($uchastniki->id_rezin);
                        $rezina->delete();
                        $avto->delete();
                        $uchastniki->delete();
                    }
                    $rezultaty = Rezultaty::model()->findAllByAttributes(array('id_nomera'=>$nomer->id));
                    foreach($rezultaty as $rezultat){
                        if(isset($rezultat)){
                            $zaezdy = Zaezdy::model()->findByPk($rezultat->id_zaezda);
                            $zaezdy->delete();
                            $rezultat->delete();
                        }
                    }
                    $nomer->delete();
                }
            }
            $zayavki = Zayavki::model()->findAllByAttributes(array('id_sorevnovaniya'=>$id));
            if(isset($zayavki))
                foreach($zayavki as $zayavka)
                    $zayavka->delete();
            $koordinaty = Koordinaty::model()->findByPk($sorevnovaniya->mesto);
            if(isset($koordinaty))
                $koordinaty->delete();
            $sorevnovaniya->delete();
            
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin_sorevnovaniya'));
		}
		else
			throw new CHttpException(400,'Неверный запрос. Пожалуйста не выполняйте этот запрос еще раз - это ни к чему не приведет.');
	}
    
    /**
    * Создание нового заезда
    */	
    public function actionNew_zaezd($id)
	{
		if(!Yii::app()->request->isPostRequest){
            $nomera = Nomera::model()->findAll(array(
                'condition'=>'id_sorevn=:id_sorevn',
                'params'=>array(':id_sorevn'=>$id)));
            $rezultaty = new Rezultaty;
            $zaezdy = new Zaezdy;
            $this->render('form_zaezd', array(
                'id' => $id,
                'zaezdy' => $zaezdy,
                'nomera' => $nomera,
                'rezultaty' => $rezultaty                        
            ));
        } 
        else { 
            if(empty($_POST['Zaezdy']['vremya'])) {
                Yii::app()->user->setFlash('success','<span class="required">Поле «время круга» должно быть заполнено!</span>');
                $this->refresh();       
            }
            $rezultaty = Rezultaty::model()->find(array(
                'condition'=>'id_nomera=:id_nomera',
                'params'=>array(':id_nomera'=>$_POST['Rezultaty']['id_nomera'])));
            if(isset($rezultaty)){
                $zaezdy = Zaezdy::model()->findByPk($rezultaty->id_zaezda);
                if($zaezdy->vremya > $_POST['Zaezdy']['vremya']){
                    $zaezdy->vremya=$_POST['Zaezdy']['vremya'];
                    $zaezdy->save();
                    if($zaezdy->validate() && $zaezdy->save()){
                        Yii::app()->user->setFlash('success','Результат заезда успешно обновлен.');
				        $this->refresh();
                    }
                }
                else {
                    Yii::app()->user->setFlash('success','<span class="required">Результат заезда хуже чем предыдущий. Результат не сохранен.</span>');
                    $this->refresh();
                }
            }
            else {
                $rezultaty = new Rezultaty;
                $zaezdy = new Zaezdy;
                $zaezdy->vremya=$_POST['Zaezdy']['vremya'];
                $zaezdy->save();
                $rezultaty->id_nomera = $_POST['Rezultaty']['id_nomera'];
                $rezultaty->id_zaezda = $zaezdy->id;
                $rezultaty->save();        
                if($zaezdy->validate() && $rezultaty->save()){
                    Yii::app()->user->setFlash('success','Результат заезда успешно сохранен.');
				    $this->refresh();
                }
            }
        }
	}
    
    /**
    * Управление заявками
    */
	public function actionAdmin_zayavki()
	{
		$zayavki= new Zayavki('search');
        $nomera= new Nomera('search');
		$zayavki->unsetAttributes();  // clear any default values
		if(isset($_GET['Zayavki']))
			$zayavki->attributes=$_GET['Zayavki'];
        $sorevnovaniya = Sorevnovaniya::model()->findAll();
        $this->render('admin_zayavki',array(
			'zayavki'=>$zayavki,
            'sorevnovaniya'=>$sorevnovaniya,
            'nomera'=>$nomera
		));
	}

	/**
    * Детальный просмотр конкретной заявки
    */
	public function actionView_zayavki($id)
	{
		$this->render('view_zayavki',array(
			'zayavki'=>$this->loadModel($id),
		));
	}
    
    /**
    * Одобрение выбраной заявки
    */
    public function actionApprove($id)
	{
        if(!Yii::app()->request->isPostRequest){
            $nomer = new Nomera;
            $this->render('form_nomera', array(
                'nomera' => $nomer                        
            ));} 
        else {
            if(empty($_POST['Nomera']['start_nomer'])) {
                Yii::app()->user->setFlash('success','<span class="required">Поле «стартовый номер» должно быть заполнено!</span>');
                $this->refresh();       
            }
            $zayavki=$this->loadModel($id);
            $nomer = Nomera::model()->find(array(
                'condition'=>'start_nomer=:start_nomer AND id_sorevn=:id_sorevn',
                'params'=>array(
                    ':start_nomer'=>$_POST['Nomera']['start_nomer'],
                    ':id_sorevn'=>$zayavki->id_sorevnovaniya
                    )
                ));
            if(isset($nomer)){
                Yii::app()->user->setFlash('success','<span class="required">Этот стартовый номер уже занят! Введите пожалуйста другой номер.</span>');
                $this->refresh();
            }
            else {
                $zayavki=$this->loadModel($id);
                $rezina=new Rezina;
                $avto=new Avto;
                $uchastniki=new Uchastniki;
                $nomera=new Nomera;
                $rezina->proizvoditel=$zayavki->proizvoditel_reziny;
                $rezina->nazvanie=$zayavki->nazvanie_reziny;
                $rezina->save();
                $avto->marka=$zayavki->marka_avto;
                $avto->model=$zayavki->model_avto;
                $avto->privod=$zayavki->privod;
                $avto->save();        
                $uchastniki->familiya=$zayavki->familiya;
                $uchastniki->imya=$zayavki->imya;
                $uchastniki->otchestvo=$zayavki->otchestvo;
                $uchastniki->id_avto=$avto->id;
                $uchastniki->id_rezin=$rezina->id;
                $uchastniki->save();
                $nomera->id_sorevn=$zayavki->id_sorevnovaniya;
                $nomera->id_uchast=$uchastniki->id;
                $nomera->start_nomer=(int)$_POST['Nomera']['start_nomer'];
                $nomera->save();
                $this->loadModel($id)->delete();
                if($nomera->save())
				    $this->redirect(array('admin_zayavki'));
            }
        }      
	}
    
    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$zayavki=Zayavki::model()->findByPk($id);
        if($zayavki===null)
			throw new CHttpException(404,'Запрошенная страница не существует');
		return $zayavki;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($zayavki)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='zayavki-form')
		{
			echo CActiveForm::validate($zayavki);
			Yii::app()->end();
		}
	}
}
