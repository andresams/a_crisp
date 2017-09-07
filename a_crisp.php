<?php

class A_Crisp extends Module
{

    public function __construct()
    {
        $this->name = 'a_crisp';
        $this->displayName = $this->l('Crisp - Chat Gratuíto');
        $this->author = 'Prestafy';
        $this->tab = 'front_office_features';
        $this->version = "1.0";
        $this->bootstrap = true;
        $this->description = $this->l('Permite que seu consumidor entre em contato diretamente com seu atendimento através de um chat flutuante em seu site.').'<a href="https://www.prestafy.com.br/">Prestafy</a>';

        parent::__construct();
    }
	
	private function info_modulo()
    {
        return $this->display(__FILE__, './views/templates/hook/infos.tpl');
    }

    public function install()
    {
        return (parent::install() && $this->registerHook('displayHeader'));
    }

    public function uninstall()
    {
        return(parent::uninstall() == false);
    }

    public function hookDisplayHeader($params)
    {
        $website_id = Configuration::get('ACRISP_WEBSITE_ID');
        $this->context->smarty->assign(array(
            'crisp_customer' => $this->context->customer,
            'crisp_website_id' => $website_id
        ));
        return $this->display(__FILE__, 'crisp.tpl');
    }

    public function getContent()
    {
        $get_website_id = Tools::getValue("crisp_website_id");

        if (isset($get_website_id) && !empty($get_website_id)) {
            Configuration::updateValue("ACRISP_WEBSITE_ID", Tools::getValue("crisp_website_id"));
        }
        $website_id =  Configuration::get('ACRISP_WEBSITE_ID');
        
        $crisp_conectado = !empty($website_id);

        $http_callback = "http" . (
            ($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://"
        ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		
		$url_loja = Tools::getHttpHost(true).__PS_BASE_URI__;

        $this->context->smarty->assign(array(
          'website_id' => $website_id,
          'crisp_conectado' => $crisp_conectado,
          'http_callback' => $http_callback,
		  'caminho_imagens' => $url_loja.'modules/a_crisp/views/image/',
        ));

        $this->context->controller->addJS($this->_path."views/js/base64.js", 'all');
        $this->context->controller->addCSS($this->_path."views/css/style.css", 'all');
        return $this->info_modulo().$this->display(__FILE__, "views/templates/admin/admin.tpl");
    }
}
