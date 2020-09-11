<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Заглавная страница со списком соревнований.
	 */
	public function actionIndex()
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
        $this->render('index', array(
            'sorevnovaniya' => $sorevnovaniya,
            'future' => $future,
            'present' => $present,
            'past' => $past
        ));
	}
    
    /**
	 * Просмотр выбраного соревнования.
	 */
    public function actionSorevnovanie($id)
    {
        $status = Sorevnovaniya::model()->findByPk($id)->status;
        $name = Sorevnovaniya::model()->findByPk($id)->nazvanie;
        $this->render('sorevnovanie', array(
            'id' => $id,
            'name' => $name,
            'status' => $status,
        ));
    }
    
    /**
	 * Подача заявки.
	 */
    public function actionZayavka($id)
    {
        $zayavki = new Zayavki;
        $zayavki->id_sorevnovaniya = $id;
        $name = Sorevnovaniya::model()->findByPk($id)->nazvanie;
        if(isset($_POST['Zayavki']))
		{
			$zayavki->attributes=$_POST['Zayavki'];
			if($zayavki->privod == '0')
                $zayavki->privod = null;
            if($zayavki->privod == '1')
                $zayavki->privod = 'FWD';
            if($zayavki->privod == '2')
                $zayavki->privod = 'RWD';
            if($zayavki->privod == '3')
                $zayavki->privod = '4WD';
            if($zayavki->save()){
                Yii::app()->user->setFlash('success','Ваша заявка принята.');
                $this->redirect(array('sorevnovanie','id'=>$id));
            }
		}
        $this->render('form_zayavka', array(
            'id' => $id,
            'name' => $name,
            'zayavki' => $zayavki,
        ));
    }
    
    /**
	 * Просмотр места проведения.
	 */
    public function actionMesto($id)
    {
        $sorevnovaniya = Sorevnovaniya::model()->findByPk($id);
        $name = $sorevnovaniya->nazvanie;
        $koordinaty = Koordinaty::model()->findByPk($sorevnovaniya->mesto);
        $this->render('mesto', array(
            'id' => $id,
            'name' => $name,
            'koordinaty' => $koordinaty
        ));
    }
    
    /**
	 * Просмотр результатов заездов.
	 */
    public function actionRezultaty($id)
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
        $rezultaty->unsetAttributes();  // clear any default values
		if(isset($_GET['Rezultaty']))
			$rezultaty->attributes=$_GET['Rezultaty'];
        $name = Sorevnovaniya::model()->findByPk($id)->nazvanie;
        $this->render('rezultaty', array(
            'id_sorevn' => $id,
            'name' => $name,
            'fwd_nomera'=>$fwd_nomera,
            'rwd_nomera'=>$rwd_nomera,
            'awd_nomera'=>$awd_nomera,
            'rezultaty'=>$rezultaty,
        ));
    }
    
    /**
	 * Просмотр информации об участнике.
	 */
    public function actionUchastnik($id)
    {
        $uchastnik = Nomera::model()->with('uchastniki')->findByPk($id);
        $id_sorevn = $uchastnik->id_sorevn;
        $name = Sorevnovaniya::model()->findByPk($id_sorevn)->nazvanie;
        $this->render('uchastnik', array(
            'uchastnik' => $uchastnik,
            'id' => $id_sorevn,
            'name' => $name
        ));
    }

	/**
	 * Страница ошибки.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Страница обратной связи.
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				//$headers="From: $name <{$model->email}>\r\n".
					//"Reply-To: {$model->email}\r\n".
					//"MIME-Version: 1.0\r\n".
					//"Content-Type: text/plain; charset=UTF-8";
                //mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				function waitAnswer($f) 
                {
                    fread($f, 128);
                }
                $f = fsockopen('localhost', 25, $errno, $errstr, 3);
                if ($f) 
                {
                    fwrite($f, "HELO localhost\r\n");
                    waitAnswer($f);
                    fwrite($f, "RCPT TO: <{$model->email}>\r\n");
                    waitAnswer($f);
                    fwrite($f, "DATA\r\n");
                    waitAnswer($f);
                    fwrite($f, "From: $name <{$model->email}>\r\n");
                    fwrite($f, "To: " . Yii::app()->params['adminEmail'] . ".\r\n");
                    fwrite($f, "Subject: $subject .\r\n");
                    fwrite($f, "\r\n");
                    fwrite($f, $model->body . ".\r\n");
                    fwrite($f, ".\r\n");
                    fwrite($f, "MIME-Version: 1.0\r\n");
                    fwrite($f, "Content-Type: text/plain; charset=UTF-8");
                    waitAnswer($f);
                    fwrite($f, "QUIT\r\n");
                    waitAnswer($f);
                }
				Yii::app()->user->setFlash('contact','Обращение принято. Ваше мнение очень важно для нас. Спасибо.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Страница авторизации
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Действие "выход"
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}