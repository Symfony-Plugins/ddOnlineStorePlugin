<?php

/**
 * sfWidgetFormDoctrineChoiceCategory represents a choice widget for the category.
 * This widget will sort and format the choices according to the NestedSet behavior.
 */
class sfWidgetFormDoctrineChoiceCateogory extends sfWidgetFormDoctrineChoice
{

	/**
	 * Constructor.
	 *
	 * Available options:
	 *
	 *  * shift_level:        Shift level of nested set
	 *  * strong_levels:      Make strong the levels passed in a array
	 *
	 * @see sfWidgetFormSelect
	 */
	protected function configure($options = array(), $attributes = array())
	{
		$this->addOption('shift_level', 0);
		$this->addOption('strong_levels', array());

		parent::configure($options, $attributes);
	}
	/**
	 * Returns the choices associated with the model. Sorts and formats the choices according to
	 * the NestedSet behavior by indenting each node's children.
	 *
	 * @return array An array of choices
	 */
	public function getChoices()
	{
		$choices = array();
		if (false !== $this->getOption('add_empty'))
		{
			$choices[''] = true === $this->getOption('add_empty') ? '' : $this->getOption('add_empty');
		}

		if (null === $this->getOption('table_method'))
		{
			$query = null === $this->getOption('query') ? Doctrine_Core::getTable($this->getOption('model'))->createQuery() : $this->getOption('query');
			// force manual sorting according to root_id then by lft
			$query->addOrderBy('root_id asc')
			->addOrderBy('lft asc');
			$objects = $query->execute();
		}
		else
		{
			$tableMethod = $this->getOption('table_method');
			$results = Doctrine_Core::getTable($this->getOption('model'))->$tableMethod();

			if ($results instanceof Doctrine_Query)
			{
				$objects = $results->execute();
			}
			else if ($results instanceof Doctrine_Collection)
			{
				$objects = $results;
			}
			else if ($results instanceof Doctrine_Record)
			{
				$objects = new Doctrine_Collection($this->getOption('model'));
				$objects[] = $results;
			}
			else
			{
				$objects = array();
			}
		}

		$method = $this->getOption('method');
		$keyMethod = $this->getOption('key_method');

		$strongLevels = $this->getOption('strong_levels');
		$currentStrong = null;
		foreach ($objects as $object)
		{
			if(in_array($object['level'], $strongLevels))
			{
				$currentStrong = $object->$keyMethod();
				$choices[$currentStrong] = array(
				    'label'   => $object->$method(),
				    'choices' => array()
				);
			}else
			{
				$choice = str_repeat('&nbsp;', (($object['level'] - $this->getOption('shift_level')) * 4)) . $object->$method();
				
				if($currentStrong != null)
				{
					$choices[$currentStrong]['choices'][$object->$keyMethod()] = $choice;
				}else 
				{
					$choices[$object->$keyMethod()] = $choice;
				}
			}
		}

		return $choices;
	}
}