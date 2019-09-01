<?php

define('APPNAMES',['Dreamer','Domino','Bridge','Prev+']);
define('TYPENAMES',['Développement'=>'blue','Anomalie'=>'red',
        'Hors périmètre'=>'orange','Pédagogie'=>'#d8db0a']);


function generateAppSelectInput(){
    $appArr = APPNAMES;

    $selectHtml = ' <select class="col-3 form-control m-2" name="app" id="app" required>
                        <option value="">Choississez une app</option>';
    foreach($appArr as $app){
        $selectHtml .= '<option value="'.$app.'">'.$app.'</option>';
    }
    $selectHtml .= '</select>';

    return $selectHtml;
}

function generateTypeSelectInput(){
    $typeArr =TYPENAMES;

    $selectHtml = ' <select class="col-3 form-control m-2" name="type" id="type" required>
                        <option value="">Choississez un type</option>';
    foreach($typeArr as $type => $color){
        $selectHtml .= '<option value="'.$type.'">'.$type.'</option>';
    }
    $selectHtml .= '</select>';

    return $selectHtml;
}