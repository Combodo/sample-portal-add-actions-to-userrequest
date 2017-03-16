<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'sample-portal-add-actions-to-userrequest/1.0.0',
	array(
		// Identification
		//
		'label' => 'Sample Portal (add action buttons to UserRequest)',
	'category' => 'business',

		// Setup
		//
		'dependencies' => array(
            'itop-portal-base/1.1.0',
			'itop-portal/1.0.0',
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'main.sample-portal-add-actions-to-userrequest.php',
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
		),
	)
);


?>
