<?php

namespace Weez\Zpl\Constant;

/**
 *
 * @author teddy
 */
class ZebraPrintMode
{

    const TEAR_OFF          = "T";
    const REWIND            = "R";
    const PEEL_OFF_SELECT   = true;
    const PEEL_OFF_NOSELECT = false;
    const CUTTER            = "C";

    //TEAR_OFF("T"), REWIND("R"), PEEL_OFF_SELECT("P", true), PEEL_OFF_NOSELECT("P", false), CUTTER("C");
    private $desiredMode;
    private $prePeelSelect = '';
    /**
     *
     * @param string $desiredMode
     * @param string|null $prePeelSelectB
     */
    public function __construct($desiredMode, $prePeelSelectB = null)
    {
        $this->desiredMode = $desiredMode;
        if (!is_null($prePeelSelectB)) {
            if ($prePeelSelectB) {
                $this->prePeelSelect = ",Y";
            } else {
                $this->prePeelSelect = ",N";
            }
        }
    }

    /**
     * @return string
     */
    public function getDesiredMode()
    {
        return $this->desiredMode;
    }

    /**
     * @return string
     */
    public function getPrePeelSelect()
    {
        return $this->prePeelSelect;
    }

    /**
     * Function which return ^MM command
     *
     * @return string
     */
    public function getZplCode()
    {
        return "^MM" . $this->desiredMode . $this->prePeelSelect . "\n";
    }

}
