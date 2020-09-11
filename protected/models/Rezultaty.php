<?php

/**
 * This is the model class for table "{{rezultaty}}".
 *
 * The followings are the available columns in table '{{rezultaty}}':
 * @property integer $id
 * @property integer $id_nomera
 * @property integer $id_zaezda
 */
class Rezultaty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rezultaty}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_nomera, id_zaezda', 'numerical', 'integerOnly'=>true),
            array('id_nomera, id_zaezda', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_nomera, id_zaezda', 'safe', 'on'=>'search'),
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
            'nomera' => array(self::BELONGS_TO,'nomera','id_nomera','with'=>'uchastniki'),
            'zaezdy' => array(self::BELONGS_TO,'zaezdy','id_zaezda'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_nomera' => 'Стартовый номер',
			'id_zaezda' => 'Id Zaezda',
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
	public function search($privod,$id_sorevn)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_nomera',$this->id_nomera);
		$criteria->compare('id_zaezda',$this->id_zaezda);
        $criteria->with = array('nomera');
        $criteria->compare( 'start_nomer', $this->nomera->start_nomer, true );
        $criteria->condition = 'id_sorevn=:id_sorevn AND privod=:privod';
        $criteria->params = array(
            ':privod'=>$privod, 
            ':id_sorevn'=>$id_sorevn
            );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rezultaty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
