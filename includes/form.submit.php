<?php
require 'form.libs.php';
function get_errors($form_data,$rules){
// returns an array of errors
$errors=array();
// validate each existing input
foreach($form_data as $name=>$value){
    if(!isset($rules[$name]))continue;
    $hname=htmlspecialchars($name);
    $rule=$rules[$name];
    // make sure that 'required' values are set
    if(isset($rule['required'])
    && $rule['required'] && !$value)
    $errors[]='The <strong>'.$hname.'</strong> field is required.';
    // check for missing inputs
    foreach($rules as $name=>$values){
        if(!isset($values['found']) && isset($values['required']) && $values['required'])
        $errors[]='The <strong> '.htmlspecialchars($name).'</strong> field is required.';
    }
    // return array of errors (or empty array if all is OK)
    return $errors;
}
$errors=get_errors($_POST,$form_rules);
if(!count($errors)){
    // save the data, or post it, or whatever
    echo 'success';
}
else{
    // errors found
    echo '<strong>Errors found in form:</strong><ul><li style="color:red; background-color:auto">';
    echo join('</li><li>',$errors);
    echo '</li></ul>
    //<a href="moj-problem-with-page.php"><p>Please go back and correct your errors.</p></a>';
}
