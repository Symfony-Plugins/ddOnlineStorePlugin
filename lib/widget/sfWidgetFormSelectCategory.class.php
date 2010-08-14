<?php

/**
 * sfWidgetFormSelectCategory represents a select HTML tag for the product categories
 *
 * @package    ddOnlineStore
 * @subpackage widget
 * @author     Diego Damico
 * @version    SVN: $Id: sfWidgetFormSelect.class.php 23994 2009-11-15 22:55:24Z bschussek $
 */
class sfWidgetFormSelectCategory extends sfWidgetFormSelect
{

	/**
	 * Returns an array of option tags for the given choices
	 *
	 * @param  string $value    The selected value
	 * @param  array  $choices  An array of choices
	 *
	 * @return array  An array of option tags
	 */
	protected function getOptionsForSelect($value, $choices)
	{
		$mainAttributes = $this->attributes;
		$this->attributes = array();

		if (!is_array($value))
		{
			$value = array($value);
		}

		$value = array_map('strval', array_values($value));
		$value_set = array_flip($value);

		$options = array();
		foreach ($choices as $key => $option)
		{
			$attributes = array('value' => self::escapeOnce($key));
			if (isset($value_set[strval($key)]))
			{
				$attributes['selected'] = 'selected';
			}

			if (is_array($option))
			{
				$attributes['class'] = "form_select_category";
				$options[] = $this->renderContentTag('option', $option['label'], $attributes);

				foreach($this->getOptionsForSelect($value, $option['choices']) as $o)
				{
					$options[] = $o;
				}
			}else
			{
				$options[] = $this->renderContentTag('option', self::escapeOnce($option), $attributes);
			}

		}

		$this->attributes = $mainAttributes;

		return $options;
	}
}
