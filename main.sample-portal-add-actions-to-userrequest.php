<?php

class SamplePortalButtonsExtension implements iPopupMenuExtension
{
    public static function EnumItems($iMenuId, $param)
    {
        switch($iMenuId)
        {
            case iPopupMenuExtension::PORTAL_OBJDETAILS_ACTION:
                // $param is a DBObject
                $aResult = array();
                $oObj = $param;

                if ($oObj instanceof UserRequest)
                {
                    $oUrlButton = new URLButtonItem(
                        'test_url',
                        'Google URL',
                        'http://www.google.fr',
                        '_blank'
                    );
                    $oJSButton = new JSButtonItem(
                        'test_js',
                        'Alert JS',
                        'alert("The button has triggered some JS snippet and load an external JS file.");',
                        array(
                            //'https://code.jquery.com/jquery-1.12.4.min.js',
                        )
                    );
                    $aResult = array($oUrlButton, $oJSButton);
                }
                break;

            default:
                // Unknown type of menu, do nothing
                $aResult = array();
                break;
        }
        return $aResult;
    }
}
