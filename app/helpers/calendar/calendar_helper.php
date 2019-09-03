<?php

//define('APPNAMES',['Dreamer','Domino','Bridge','Prev+']);
//define('TYPENAMES',['Développement'=>'blue','Anomalie'=>'red',
//        'Hors périmètre'=>'orange','Pédagogie'=>'purple']);


function generateAppSelectInput()
{
    $appArr = $GLOBALS['APPNAMES'];


    $selectHtml = '<option value="">Choississez une app</option>';
    foreach ($appArr as $app) {
        $selectHtml .= '<option value="' . $app . '">' . $app . '</option>';
    }
    $selectHtml .= '</select>';

    return $selectHtml;
}

function generateTypeSelectInput()
{
    $typeArr = $GLOBALS['TYPENAMES'];

    $selectHtml = '<option value="">Choississez un type</option>';
    foreach ($typeArr as $type => $color) {
        $selectHtml .= '<option value="' . $type . '">' . $type . '</option>';
    }
    $selectHtml .= '</select>';

    return $selectHtml;
}