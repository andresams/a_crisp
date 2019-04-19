<?php
/**
 * Crisp - Free Chat for Prestashop
 *
 * @category    Customer Care
 * @package     Prestafy_Crisp
 * @author      Andresa Martins (andresa@prestafy.com.br)
 * @copyright   Copyright (c) 2019 Prestafy Desenvolvimento e Suporte (https://www.prestafy.com.br)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class A_Crisp extends Module
{
    /**
     * A_Crisp constructor.
     */
    public function __construct()
    {
        $this->name = 'a_crisp';
        $this->displayName = $this->l('Crisp - Chat Gratuíto');
        $this->author = 'Prestafy';
        $this->tab = 'front_office_features';
        $this->version = "2.0";
        $this->bootstrap = true;
        $this->description = $this->l('Permite que seu consumidor entre em contato diretamente com seu atendimento através de um chat flutuante em seu site.') . '<a href="https://www.prestafy.com.br/">Prestafy</a>';

        parent::__construct();
    }

    /**
     * Module installer
     *
     * @return bool
     */
    public function install()
    {
        return (parent::install() && $this->registerHook('displayHeader'));
    }

    /**
     * Uninstall this module
     *
     * @return bool
     */
    public function uninstall()
    {
        return (parent::uninstall() == false);
    }

    /**
     * Add Crisp JS to the header hook.
     * Assign customer name/email if the customer is logged
     *
     * @param Array $params
     * @return string
     */
    public function hookDisplayHeader($params)
    {
        $websiteId = Configuration::get('ACRISP_WEBSITE_ID');
        $this->context->smarty->assign(array(
            'crisp_customer' => $this->context->customer,
            'crisp_website_id' => $websiteId
        ));
        return $this->display(__FILE__, 'crisp.tpl');
    }

    /**
     * Generate admin settings page
     *
     * @return string
     */
    public function getContent()
    {
        $get_website_id = Tools::getValue("crisp_website_id");

        if (isset($get_website_id) && !empty($get_website_id)) {
            Configuration::updateValue("ACRISP_WEBSITE_ID", Tools::getValue("crisp_website_id"));
        }
        $websiteId = Configuration::get('ACRISP_WEBSITE_ID');

        $isCrispConnected = !empty($websiteId);

        $http_callback = "http" . (
            ($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://"
            ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


        $storeUrl = Tools::getHttpHost(true) . __PS_BASE_URI__;

        $this->context->smarty->assign(array(
            'website_id' => $websiteId,
            'crisp_conectado' => $isCrispConnected,
            'http_callback' => $http_callback,
            'caminho_imagens' => $storeUrl . 'modules/a_crisp/views/image/',
        ));

        $this->context->controller->addJS($this->_path . "views/js/base64.js", 'all');
        $this->context->controller->addCSS($this->_path . "views/css/style.css", 'all');

        return $this->moduleHeader() . $this->display(__FILE__, "views/templates/admin/admin.tpl");
    }

    /**
     * Display admin header with information about this module
     *
     * @return string
     */
    private function moduleHeader()
    {
        return $this->display(__FILE__, './views/templates/hook/infos.tpl');
    }
}
