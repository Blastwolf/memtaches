<?php
function progressBarBackgroundColor(string $typetask)
{
        if($GLOBALS['TYPENAMES']){
            foreach($GLOBALS['TYPENAMES'] as $type=>$color){
                if($type === $typetask){
                    return $color;
                }
            }
        }
}



