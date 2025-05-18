<?php


function set_active($route)
{
    return request()->routeIs($route) ? 'active' : '';
}

?>