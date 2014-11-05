<?php 

//based on: http://forumsarchive.laravel.io/viewtopic.php?id=11960
//expand as needed

Form::macro('textField', function($name, $label = null, $value = null, $attributes = array()){
  $element = Form::text($name, $value, fieldAttributes($name, $attributes));
	return fieldWrapper($name, $label, $element);
});

Form::macro('passwordField', function($name, $label = null, $attributes = array())
{
    $element = Form::password($name, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('textareaField', function($name, $label = null, $value = null, $attributes = array())
{
    $element = Form::textarea($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $element);
});

Form::macro('radioButtonsField', function($name, $options){
	$element = '<div class = "btn-group" data-toggle = "buttons">';
	foreach($options as $option){
		$active = '';
		$checked = '';
		if(isset($option['checked'])){
			$active = 'active';
			$checked= 'checked';
		}
	$element .= '<label class="btn btn-default '.$active.'">
    <input type="radio" name="'.$name.'" value="'.$option['value'].'" autocomplete="off" '.$checked.'> '.$option['label'].'
  </label>';
	}
	$element .=  fieldErrorMessage($name);
	$element .= '</div>';
	return $element;
});

function fieldLabel($name, $label)
{
    if (is_null($label)) return '';

    $name = str_replace('[]', '', $name);

    $out = '<label for="id-field-' . $name . '" class="control-label">';
    $out .= $label . '</label>';

    return $out;
}

function fieldErrorClass($field)
{
    $error = '';

    if ($errors = Session::get('errors'))
    {
        $error = $errors->first($field) ? ' has-error' : '';
    }

    return $error;
}

function fieldErrorMessage($field){
	$errors = Session::get('errors');
	$errMsg = '';
	if(isset($errors)){
		if($errors->first($field)){
			$errMsg .= '<p class="text-danger">'.$errors->first($field).'</p>';
		}
	}
	return $errMsg;
}

function fieldWrapper($name, $label, $element)
{
    $out = '<div class="form-group';
    $out .= fieldErrorClass($name) . '">';
    $out .= fieldLabel($name, $label);
		$out .= $element;
		$out .= fieldErrorMessage($name);
    $out .= '</div>';

    return $out;
}

function fieldAttributes($name, $attributes = array())
{
    $name = str_replace('[]', '', $name);

    return array_merge(['class' => 'form-control', 'id' => 'id-field-' . $name], $attributes);
}
