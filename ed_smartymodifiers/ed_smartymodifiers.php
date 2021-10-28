<?php
require_once _PS_MODULE_DIR_ . 'ed_smartymodifiers' . DIRECTORY_SEPARATOR . 'SmartyModifiersClass.php';

class Ed_SmartyModifiers extends Module {
    public function __construct()
    {
        $this->name = 'ed_smartymodifiers';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Bob Vrijland';
		
        parent::__construct() ;

        $this->displayName = $this->l('Smarty modifiers');
        $this->description = $this->l('Contains smarty plugins.');
    }

    public function install()
    {
        return parent::install() && $this->registerHook('actionDispatcher');
    }

    public function hookActionDispatcher()
    {
        /* 
           We register the plugin everytime a controller is instantiated

           'modifier'                          - modifier type of plugin
           'testToUpper'                       - plugin tag name to be used in templates,
           array('TestClass', 'toUpperMethod') - execute toUpperMethod() from class TestClass when using modifier tag name
        */
        $this->context->smarty->registerPlugin('modifier', 'formaatButton', array('SmartyModifiersClass', 'formaatButton'));
    }
}

?>