<?php
function progressBarBackgroundColor($typetask)
{
        if($GLOBALS['TYPENAMES']){
            foreach($GLOBALS['TYPENAMES'] as $type=>$color){
                if($type === $typetask){
                    return $color;
                }
            }
        }
}



