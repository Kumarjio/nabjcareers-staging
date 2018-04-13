<?php

class SJB_Form
{
	var $object_properties	= array();
	var $template_processor = null;
	var $path_to_templates  = null;
	var $form_fields 		= array();
	var $object				= null;
	var $errors				= false;

	function SJB_Form($object = null)
	{
		if (!empty($object)) {
			$object_details = $object->getDetails();
			$this->object_properties = $object_details->getProperties();
			$this->object_properties = $this->object_properties?$this->object_properties:array();
			foreach ($this->object_properties as $object_property) {
				$form_field['caption'] 		= $object_property->getCaption();
				$form_field['is_system'] 	= $object_property->isSystem();
				$form_field['id']           = $object_property->getID();
				$form_field['is_required'] 	= $object_property->isRequired();
				$form_field['disabled'] 	= false;
				$form_field['order'] 		= $object_property->getOrder();
				$form_field['comment'] 		= $object_property->getComment();
				$form_field['type'] 		= $object_property->getType();
				$form_field['instructions']	= $object_property->getInstructions();

				$this->form_fields[$object_property->getID()] = $form_field;
			}
			$this->object = $object;
		}

		$this->path_to_templates = '../field_types/';
	}

	function registerTemplateProcessor($template_processor)
	{
		$this->template_processor = $template_processor;
	}

	function registerTags(&$template_processor)
	{
		$template_processor->register_function('input', array(&$this, 'tpl_input'));
		$template_processor->register_function('display', array(&$this, 'tpl_display'));
		$this->registerTemplateProcessor($template_processor);
	}

	function makeDisabled($property_id)
	{
		$this->form_fields[$property_id]['disabled'] 	 = true;
		$this->form_fields[$property_id]['is_required']  = false;
	}

	function makeNotRequired($property_id) 
	{
		$this->form_fields[$property_id]['is_required'] = false;
	}

	function getFormFieldsInfo()
	{
		return $this->form_fields;
	}

	function isDataValid(&$errors, $addValidParam = false)
	{
		$errors = array();

		foreach ($this->object_properties as $object_property) {
			$is_valid = $object_property->isValid($addValidParam);

			if ($is_valid !== true) {
				if (is_array($is_valid))
					$errors = array_merge($errors, $is_valid);
				else
					$errors[$object_property->getCaption()] = $is_valid;
			}
		}

		if (!empty($errors)) {
			$this->errors = true;
			return false;
		}
		return true;
	}

	function objectHasProperty($property_name)
	{
		return isset($this->object_properties[$property_name]);
	}

	function getObjectProperty($property_name)
	{
		return $this->object_properties[$property_name];
	}

	function tpl_property($view_type, $params)
	{
		$params['view_type'] = $view_type;
		$this->assignTemplateVariables($params);
		$complexParent = '';
		if (!empty($params['complexParent']))
			$complexParent = $params['complexParent'];
		$template = isset($params['template']) ? $params['template'] : $this->getDefaultTemplateByFieldName($params['property'], $complexParent);
		$template_path = $this->path_to_templates . $view_type . '/' . $template;
		return $this->template_processor->fetch($template_path);
	}

	function assignTemplateVariables($params)
	{
		$variables_to_assign = array();

		if ($this->objectHasProperty($params['property'])) {
			$object_property = $this->getObjectProperty($params['property']);
			$variables_to_assign = $object_property->getPropertyVariablesToAssign();
		}

		if (!empty($params['complexParent'])) {
			$complexParent = $params['complexParent'];
			$object = $this->object_properties[$complexParent]->type->complex;
			$object_properties = $object->getProperties();
			if (isset($object_properties[$params['property']])) {
				$variables_to_assign = $object_properties[$params['property']]->getPropertyVariablesToAssign();
            }

            if (isset($params['complexStep']) && !empty($this->object_properties[$complexParent]->value)) {
                if (is_string($this->object_properties[$complexParent]->value))
                    $complexValue = unserialize($this->object_properties[$complexParent]->value);
                else
                    $complexValue = $this->object_properties[$complexParent]->value;
                $variables_to_assign['value'] = '';
                if (isset($complexValue[$params['property']]) && isset($complexValue[$params['property']][$params['complexStep']])) {
                    if ($object_properties[$params['property']]->getType() === 'date' && $object_properties[$params['property']]->type->getConvertToDBDate())
                        $variables_to_assign['value'] = SJB_I18N::getInstance()->getInput('date', $complexValue[$params['property']][$params['complexStep']]);
                    else
                        $variables_to_assign['value'] = $complexValue[$params['property']][$params['complexStep']];
                }
            }
		}

        if (isset($params['complexStep'])) {
            $variables_to_assign['complexStep'] = $params['complexStep'];
        }

		if (isset($params['parameters']))
			$variables_to_assign = array_merge($variables_to_assign, array('parameters'=>$params['parameters']));

		$variables_to_assign = array_merge($variables_to_assign, $this->getVariablesToAssign($params));
		if (!$this->object->getSID() && $variables_to_assign['value'] == '' && $this->errors === false) {
			if ($variables_to_assign['default_value'] != '') {
				if (is_array($variables_to_assign['default_value']))
					$variables_to_assign['default_value']['currency'] = $variables_to_assign['default_value']['add_parameter'];
				$variables_to_assign['value'] = $variables_to_assign['default_value'];
			}
			elseif ($variables_to_assign['profile_field_as_dv'] != '') {
				$variables_to_assign['value'] = $variables_to_assign['profile_field_as_dv'];
			}
		}

		// заглушка для email - когда в value попадает массив из одного элемента [original]
		if ( $variables_to_assign['id'] == 'email') {
			if (is_array($variables_to_assign['value']) ) {
				$variables_to_assign['value'] = array_pop($variables_to_assign['value']);
			}
		}
		
		foreach ($variables_to_assign as $variable_name => $variable_value)
			$this->template_processor->filterThenAssign($variable_name, $variable_value);
	}

	function getVariablesToAssign($params)
	{
		if ($this->objectHasProperty($params['property'])) {
			$object_property = $this->getObjectProperty($params['property']);
			return $object_property->getPropertyVariablesToAssign();
		}

		return array();
	}

	function tpl_input($params)
	{
		$oldObject = false;
		if (!empty($params['object'])) {
			$oldObject = $this->object; 
			$this->SJB_Form($params['object']);
		}
		if ($this->form_fields[$params['property']]['disabled'])
			$result = $this->tpl_property('display', $params);
		else
			$result = $this->tpl_property('input', $params);
		if ($oldObject !== false)
			$this->SJB_Form($oldObject);
		return $result;
	}

	function tpl_search($params)
	{
		$oldObject = false;
		if (!empty($params['object'])) {
			$oldObject = $this->object;
			$this->SJB_Form($params['object']);
		}
		$this->template_processor->filterThenAssign('templateParams', $params);
		if ($this->form_fields[$params['property']]['disabled'])
			$result = $this->tpl_property('display', $params);
		else
			$result = $this->tpl_property('search', $params);
		if ($oldObject !== false)
			$this->SJB_Form($oldObject);
		return $result;
	}

	function tpl_display($params)
	{
		$oldObject = false;
		if (!empty($params['object'])) {
			$oldObject = $this->object;
			$this->SJB_Form($params['object']);
		}
    	if (isset($params['assign'])) {
			$this->template_processor->filterThenAssign($params['assign'], trim($this->tpl_property('display', $params)));
			$result = '';
    	}
		else {
			$result = trim($this->tpl_property('display', $params));
		}
		if ($oldObject !== false)
			$this->SJB_Form($oldObject);
		return $result;
	}

	function getDefaultTemplateByFieldName($property_name, $complexParent = '')
	{
		if ($this->objectHasProperty($property_name))
			return $this->object_properties[$property_name]->getDefaultTemplate();
		if (!empty($complexParent)) {
			$object = $this->object_properties[$complexParent]->type->complex;
			$object_properties = $object->getProperties();
			if (isset($object_properties[$property_name]))
				return $object_properties[$property_name]->getDefaultTemplate();
		}
		return 'string.tpl';
	}

		/**
		 *
		 * @param string $property_name
		 * @param string $newTemplate
		 */
		function setDefaultTemplateByFieldName($property_name, $newTemplate)
		{
			if ($this->objectHasProperty($property_name)) {
				$this->object_properties[$property_name]->setDefaultTemplate($newTemplate);
			}
		}
}

