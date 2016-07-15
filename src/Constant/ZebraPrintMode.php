<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Zpl\Constant;

/**
 * Description of ZebraPrintMode
 *
 * @author teddy
 */
class ZebraPrintMode {

    const TEAR_OFF          = "T";
    const REWIND            = "R";
    const PEEL_OFF_SELECT   = true;
    const PEEL_OFF_NOSELECT = false;
    const CUTTER            = "C";
//TEAR_OFF("T"), REWIND("R"), PEEL_OFF_SELECT("P", true), PEEL_OFF_NOSELECT("P", false), CUTTER("C");
    private $desiredMode;
    private $prePeelSelect;

    public function __construct($desiredMode, $prePeelSelectB) {
        $this->desiredMode = $desiredMode;
        if ($prePeelSelectB) {
            $this->$prePeelSelect = ",Y";
        } else {
            $this->$prePeelSelect = ",N";
        }
    }

    /**
     * @return the desiredMode
     */
    public function getDesiredMode() {
        return $this->desiredMode;
    }

    /**
     * @return the prePeelSelect
     */
    public function getPrePeelSelect() {
        return $this->prePeelSelect;
    }

    /**
     * Function which return ^MM command
     *
     * @return
     */
    public function getZplCode() {
        return "^MM" + $this->desiredMode + $this->prePeelSelect + "\n";
    }

}
