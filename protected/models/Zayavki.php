<?php

/**
 * This is the model class for table "{{zayavki}}".
 *
 * The followings are the available columns in table '{{zayavki}}':
 * @property integer $id
 * @property integer $id_sorevnovaniya
 * @property string $familiya
 * @property string $imya
 * @property string $otchestvo
 * @property string $marka_avto
 * @property string $model_avto
 * @property string $proizvoditel_reziny
 * @property string $nazvanie_reziny
 * @property string $privod
 */
class Zayavki extends CActiveRecord
{
	public $verifyCode;
    
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{zayavki}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sorevnovaniya', 'numerical', 'integerOnly'=>true),
			array('familiya, imya, otchestvo, marka_avto, model_avto, proizvoditel_reziny, nazvanie_reziny, privod', 'length', 'max'=>255),
            array('id_sorevnovaniya, familiya, imya, otchestvo, marka_avto, model_avto, proizvoditel_reziny, nazvanie_reziny, privod', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_sorevnovaniya, familiya, imya, otchestvo, marka_avto, model_avto, proizvoditel_reziny, nazvanie_reziny, privod', 'safe', 'on'=>'search'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements())
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'sorevnovaniya' => array(self::BELONGS_TO,'sorevnovaniya','id_sorevnovaniya')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_sorevnovaniya' => 'Id Sorevnovaniya',
			'familiya' => 'Фамилия',
			'imya' => 'Имя',
			'otchestvo' => 'Отчество',
			'marka_avto' => 'Марка автомобиля',
			'model_avto' => 'Модель автомобиля',
			'proizvoditel_reziny' => 'Производитель резины',
			'nazvanie_reziny' => 'Название резины',
			'privod' => 'Привод',
            'verifyCode'=>'Код проверки',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
        
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_sorevnovaniya',$this->id_sorevnovaniya);
		$criteria->compare('familiya',$this->familiya,true);
		$criteria->compare('imya',$this->imya,true);
		$criteria->compare('otchestvo',$this->otchestvo,true);
		$criteria->compare('marka_avto',$this->marka_avto,true);
		$criteria->compare('model_avto',$this->model_avto,true);
		$criteria->compare('proizvoditel_reziny',$this->proizvoditel_reziny,true);
		$criteria->compare('nazvanie_reziny',$this->nazvanie_reziny,true);
		$criteria->compare('privod',$this->privod,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            /*'sort'=>array(
                'attributes'=>array(
                    'sorevnovaniya'=>array(
                        'asc' => $expr = 'sorevnovaniya.nazvanie',
                        'desc' => $expr.' DESC',
                    ))),
            */
		));
	}
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zayavki the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
