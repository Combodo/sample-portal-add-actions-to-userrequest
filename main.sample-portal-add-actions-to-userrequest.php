<?php

use Combodo\iTop\Portal\Helper\ContextManipulatorHelper;

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
				if ($oObj instanceof Ticket)
                {
					// Example: Creating new object from this one
                    $sState = $oObj->GetState();
                    if($sState === 'closed')
                    {
						// Creating action rule token so we can pass them via the URL
                        $sARToken = ContextManipulatorHelper::PrepareAndEncodeRulesToken(
							// IDs of action rules to apply
							// Note: This AR doesn't exist, use your own...
                            array('ticket-data-to-a-new-one'),
							// Sources objects used by the action rules
                            array('Ticket' => $oObj)
                        );
						
						// Adding AR token to object creation URL
                        $sCreateURL = utils::GetAbsoluteUrlAppRoot() . 'pages/exec.php/object/create/'.get_class($oObj).'?exec_module=itop-portal-base&exec_page=index.php&portal_id='.$sPortalId.'&ar_token='.$sARToken;

                        $oCopyURLButton = new URLButtonItem(
                            'create-ticket-from-this-one',	// Put a unique ID for the button
                            'Créer un ticket similaire',	// Use Dict::S('Some:Dictionary:String') for a dictionary entry
                            $sCreateURL,					// URL of the button
                            '_parent'						// URL target ("_blank" for new tab, "_parent" for current tab)
                        );

                        $aResult[] = $oCopyURLButton;
                    }
					
					// Example to make a link to an object in a portal
                    $oUrlToSelfButton = new URLButtonItem(
                        'self_url',				// Put a unique ID for the button
                        'Open me in a tab',		// Use Dict::S('Some:Dictionary:String') for a dictionary entry
	                    iTopPortalViewUrlMaker::MakeObjectUrl(get_class($oObj), $oObj->GetKey()),	// Note: Change this class to the one used in your portal instance
                        '_blank'				// URL target ("_blank" for new tab, "_parent" for current tab)
                    );
					
					// Example to make a button to an external URL
                    $oUrlButton = new URLButtonItem(
                        'test_url',
                        'Google URL',
                        'http://www.google.fr',	// Target URL
                        '_blank'
                    );
					// - This is an example of how to add a CSS class to the button. For example if you want to change its color
					//   Take a look at this page for BS example: https://getbootstrap.com/docs/3.3/css/#buttons-options
                    $oUrlButton->AddCssClass('btn-success');
					
					// Example to run a javascript snippet on click
                    $oJSButton = new JSButtonItem(
                        'test_js',
                        'Alert JS',
                        'alert("The button has triggered some JS snippet and load an external JS file.");',	// JS code to be executed on click
                        array(																				// Array of js files to be included into the web page
                            //'https://code.jquery.com/jquery-1.12.4.min.js',
                        )
                    );
					
					// Don't forget to add the buttons to the result !
                    $aResult = $aResult + array($oUrlToSelfButton, $oUrlButton, $oJSButton);
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
