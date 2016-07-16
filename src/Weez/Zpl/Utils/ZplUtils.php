<?php

namespace Weez\Zpl\Utils;

use Exception;
use Weez\Zpl\Constant\ZebraFont;
use Weez\Zpl\Constant\ZebraPPP;

/**
 * Common method used to manipulate ZPL
 * 
 * @author ttropard
 * 
 */
class ZplUtils
{

    /**
     * Fonction called by zplCommand to cast variable $object and ajust for zpl code
     *
     * @param $object
     */
    private static function variableObjectToZplCode($object)
    {
        if (!is_null($object)) {
            if (is_numeric($object)) {
                return ((int) $object);
            } else if (is_bool($object)) {
                
                if (((bool) $object)) {
                    return "Y";
                } else {
                    return "N";
                }
            } else {
                return $object;
            }
        } else {
            return "";
        }
    }

    /**
     * Method to quickly generate zpl code with command and variable
     * 
     * @param command
     *            Command (without ^)
     * @param variables
     *            list variable
     * @return
     */
    public static function zplCommand($command, $variables = null)
    {
        $zpl          = '';
        $zpl .= "^";
        $zpl .= $command;
        $cv  = count($variables);
        if ($cv > 1) {
            $zpl .= self::variableObjectToZplCode($variables[0]);
            for ($i = 1; $i < $cv; $i++) {
                $zpl .= ",";
                $zpl .= self::variableObjectToZplCode($variables[$i]);
            }
        } else if ($cv == 1) {
//Only one element in variables
            $zpl .= self::variableObjectToZplCode($variables[0]);
        }
        return $zpl;
    }

    /**
     * Method to quickly generate zpl code with command and variable
     *
     * @param command
     *            Command (without ^)
     * @param variables
     *            list variable
     * @return
     */
    public static function zplCommandSautLigne($command, $variables = null)
    {
        $zpl = self::zplCommand($command, $variables);
        $zpl .= "\n";
        return $zpl;
    }

    /**
     * Extract from font, fontSize and PPP the height and width in dots.
     *
     * Fonts and PPP are not all supported.
     * Please complete this method or use dot in yous params
     *
     * @param zebraFont
     * @param fontSize
     * @param zebraPPP
     * @return array[height,width] in dots
     */
    public static function extractDotsFromFont($zebraFont, $fontSize, $zebraPPP)
    {
        $tab = [];

        if (ZebraFont::ZEBRA_ZERO == $zebraFont->getLetter() && ZebraPPP::DPI_300 == $zebraPPP) {
//We use ratio to converted (based on ratio used by Zebra Designer Tools)
            $tab[0] = round($fontSize * 4.16); //Heigth
            $tab[1] = round($fontSize * 4.06); //With
        } else {
            throw new Exception("This PPP and this font are not yet supported. Please use ZebraAFontElement.");
        }
        return $tab;
    }

    /**
     * Convert point(pt) in pixel(px)
     * 
     * @param point
     * @return
     */
    public static function convertPointInPixel($point)
    {
        return round($point * 1.33);
    }

    /**
     * Function used to converted ASCII >127 in \hexaCode accepted by ZPL language
     * 
     * @param str
     *            str
     * @return string with charactere remove
     */
    public static function convertAccentToZplAsciiHexa($str)
    {
        if ($str != null) {
            $str = str_replace("é", "\\82", $str);
            $str = str_replace("à", "\\85", $str);
            $str = str_replace("è", "\\8A", $str);
        }
        return $str;
    }

}
