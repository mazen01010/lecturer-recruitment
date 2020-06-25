<?php
$capabilities = array(
    'local/lecrec:manager' => array(
        'riskbitmask'  => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_CONFIG,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'   => array(
            'manager'          => CAP_ALLOW
        )
    ),
    'local/lecrec:teacher' => array(
        'riskbitmask'  => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_CONFIG,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'   => array(
            'editingteacher' => CAP_ALLOW,
        )
    ),
    // Add more capabilities here ...
);