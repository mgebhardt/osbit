﻿<?php
/**
 * @version		1.0.0
 * @package		Joomla
 * @subpackage	OSBIT
 * @copyright	(C) 2010 - 2012 Mathias Gebhardt
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * CourseClient Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	OSBIT
 * @since		1.6
 */
class JFormFieldCourseClient extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'CourseClient';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions()
	{
		// Initialize variables.
		$options = array();

		/*
		 * SQL query:
		 * 
		 * SELECT ID AS value, name AS text
		 * FROM #__osbitcourses
		 * ORDER BY name
		 */
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('ID AS value, name AS text');
		$query->from('#__osbitcourses');
		$query->order('name');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		return $options;
	}
}