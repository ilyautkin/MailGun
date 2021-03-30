<?php

if ($object->xpdo) {
	/* @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
            $settings = array();
            
            $tmp = array(
            	'mail_smtp_auth' => '1',
            	'mail_smtp_helo' => '',
            	'mail_smtp_hosts' => $options['server'],
            	'mail_smtp_port' => '587',
            	'mail_smtp_prefix' => '',
            	'mail_smtp_single_to' => '1',
            	'mail_use_smtp' => '1',
            	'mail_smtp_user' => $options['email'],
            	/* 'emailsender' => $options['email'], */
            	'mail_smtp_pass' => $options['password'],
            );
            
            foreach ($tmp as $k => $v) {
            	/* @var modSystemSetting $setting */
                if(!empty($v)) {
                    $setting = $modx->getObject('modSystemSetting', ['key' => $k]);
                    $setting->set('value', $v);
                    $setting->save();
                }
            }
            
            unset($tmp);
			break;
		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;