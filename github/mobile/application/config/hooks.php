<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$hook['pre_controller'] = array(
    'class'    => 'Hooks_class',
    'function' => 'hooks_verification',
    'filename' => 'Hooks_class.php',
    'filepath' => 'hooks'
);
