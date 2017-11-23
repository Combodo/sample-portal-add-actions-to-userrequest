<?php

class SamplePortalButtonsExtension implements iPopupMenuExtension
{
    public static function EnumItems($iMenuId, $param)
    {
        switch($iMenuId)
        {
            case iPopupMenuExtension::PORTAL_OBJDETAILS_ACTIONS:
                // $param is an array containing portal id and a DBObject
                $aResult = array();
                $sPortalId = $param['portal_id'];
                $oObj = $param['object'];

				// -----------------------------------------------------------------------------
				// START EDITING HERE
				// -----------------------------------------------------------------------------
				//
				// Do you test here to know if the current $oObj is eligible to an action button
                if ($oObj instanceof UserRequest)
                {
					// Example to make a link to a portal object
                    $oUrlToSelfButton = new URLButtonItem(
                        'self_url',
                        'Open me in a tab',
	                    iTopPortalViewUrlMaker::MakeObjectUrl(get_class($oObj), $oObj->GetKey()),
                        '_blank'
                    );
					
					// Example to make a button to an external URL
                    $oUrlButton = new URLButtonItem(
                        'test_url',
                        'Google URL',
                        'http://www.google.fr',
                        '_blank'
                    );
                    $oUrlButton->AddCssClass('testclass');
					
					// Example to run a javascript snippet on click
                    $oJSButton = new JSButtonItem(
                        'test_js',
                        'Alert JS',
                        'alert("The button has triggered some JS snippet and load an external JS file.");',
                        array(
                            //'https://code.jquery.com/jquery-1.12.4.min.js',
                        )
                    );
					
					// Don't forget to add the buttons to the result !
                    $aResult = array($oUrlToSelfButton, $oUrlButton, $oJSButton);
                }
				// -----------------------------------------------------------------------------
				// STOP EDITING HERE
				// -----------------------------------------------------------------------------
                break;

            default:
                // Unknown type of menu, do nothing
                $aResult = array();
                break;
        }
        return $aResult;
    }
}
