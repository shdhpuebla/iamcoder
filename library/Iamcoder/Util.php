<?php
/* util methods */
class Iamcoder_Util {
    public static function generateUrl($string) {
        //@todo remove accents
        
        $clean = pregi_replace('|[^0-9a-z_-]+|U', '', $string);
        $clean = strtolower($clean);
        $clean = trim($clean);
        return $clean;
    }
}