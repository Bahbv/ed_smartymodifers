<?php
class SmartyModifiersClass {

    /**
     * Formats the text for the formaat buttons.
     *
     * @param [string] $string
     * @return [string] modified $string
     */
    public static function formaatButton($string)
    {
        return strtoupper($string);
    }
}
?>