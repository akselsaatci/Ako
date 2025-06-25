<?php

namespace Framework\Http;


/** @package Framework\Http */
interface LayoutInterface
{
    /**
     * @param array $arguments 
     * @return mixed 
     */
    public static function getLayout(array $arguments);
}


