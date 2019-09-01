<?php
function progressBarBackgroundColor(string $typetask)
{
        if(defined('TYPENAMES')){
            foreach(TYPENAMES as $type=>$color){
                if($type === $typetask){
                    return $color;
                }
            }
        }
}



