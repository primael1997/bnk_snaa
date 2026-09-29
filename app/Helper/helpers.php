<?php

    /** Set Sidebar item active */

    function setActive(array $route){
        if(is_array($route)){
            foreach($route as $r){
                if(request()->routeIs($r)){
                    return 'active';
                }
            }
        }
    }


    function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return round($bytes / 1073741824, 2) . ' Go';
        }

        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' Mo';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' Ko';
        }

        return $bytes . ' octets';
    }

