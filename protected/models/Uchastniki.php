<?php

/**
 * This is the model class for table "{{uchastniki}}".
 *
 * The followings are the available columns in table '{{uchastniki}}':
 * @property integer $id
 * @property string $familiya
 * @property string $imya
 * @property string $otchestvo
 * @property integer $id_avto
 * @property integer $id_rezin
 */
class Uchastniki extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{uchastniki}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_avto, id_rezin', 'numerical', 'integerOnly'=>true),
			array('familiya, imya, otchestvo', 'length', 'max'=>255),
            array('familiya, imya, otchestvo', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, familiya, imya, otchestvo, id_avto, id_rezin', 'safe', 'on'=>'search'),
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
            'nomera' => array(self::HAS_MANY,'nomera','id_uchast'),
            'avto' => array(self::BELONGS_TO,'avto','id_avto'),
            'rezina' => array(self::BELONGS_TO,'rezina','id_rezin'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'familiya' => 'Familiya',
			'imya' => 'Imya',
			'otchestvo' => 'Otchestvo',
			'id_avto' => 'Id Avto',
			'id_rezin' => 'Id Rezin',
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
		$criteria->compare('familiya',$this->familiya,true);
		$criteria->compare('imya',$this->imya,true);
		$criteria->compare('otchestvo',$this->otchestvo,true);
		$criteria->compare('id_avto',$this->id_avto);
		$criteria->compare('id_rezin',$this->id_rezin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Uchastniki the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
