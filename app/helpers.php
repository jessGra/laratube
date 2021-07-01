<?php
    function setActive($routeName){
        return request()->routeIs($routeName) ? 'active' : '' ;
    }

    function isSelected($value){
        if ($value == request()->filter) {
            return 'selected';
        }else{
            return '';
        }
        
        
    }
?>