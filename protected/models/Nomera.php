<?php

/**
 * This is the model class for table "{{nomera}}".
 *
 * The followings are the available columns in table '{{nomera}}':
 * @property integer $id
 * @property integer $id_sorevn
 * @property integer $id_uchast
 * @property integer $start_nomer
 */
class Nomera extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{nomera}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sorevn, id_uchast, start_nomer', 'numerical', 'integerOnly'=>true),
            array('id_sorevn, id_uchast, start_nomer', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_sorevn, id_uchast, start_nomer', 'safe', 'on'=>'search'),
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
            'sorevnovaniya' => array(self::BELONGS_TO,'sorevnovaniya','id_sorevn'),
            'uchastniki' => array(self::BELONGS_TO,'uchastniki','id_uchast','with'=>array('avto','rezina')),
            'rezultaty' => array(self::HAS_MANY,'rezultaty','id_nomera'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_sorevn' => 'Id Sorevn',
			'id_uchast' => 'Id Uchast',
			'start_nomer' => 'Start Nomer',
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
		$criteria->compare('id_sorevn',$this->id_sorevn);
		$criteria->compare('id_uchast',$this->id_uchast);
		$criteria->compare('start_nomer',$this->start_nomer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nomera the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
