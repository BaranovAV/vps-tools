<?php
	namespace vps\tools\components;

	/**
	 * Class SettingManager
	 * @package vps\tools\components
	 * @property-read Setting[] $all
	 * @property-write string   $modelClass
	 */
	class SettingManager extends \yii\base\Object
	{
		/**
		 * @var string
		 */
		private $_modelClass = '\common\models\Setting';

		/**
		 * @var Setting[] Category tree.
		 */
		private $_data;

		/**
		 * @inheritdoc
		 * Loads all settings from database.
		 */
		public function init ()
		{
			$class = $this->_modelClass;
			$this->_data = $class::find()->all();
		}

		/**
		 * Gets specific setting by its name. Return default value if not found.
		 * @param string $name
		 * @param mixed  $default
		 * @return null
		 */
		public function get ($name, $default = null)
		{
			foreach ($this->_data as $d)
			{
				if ($d->name === $name)
					return $d->value;
			}

			return $default;
		}

		/**
		 * Returns all data.
		 * @return Setting[]
		 */
		public function getAll ()
		{
			return $this->_data;
		}

		/**
		 * Setting for model class.
		 * @param $class
		 * @throws \yii\base\InvalidConfigException
		 */
		public function setModelClass ($class)
		{
			if (!class_exists($class))
				throw new \yii\base\InvalidConfigException('Given model class not found.');
			$this->_modelClass = $class;
		}
	}
