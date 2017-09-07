<script>
	function conectar_crisp () 
	{
		var add_to_crisp_link = "https://app.crisp.im/initiate/plugin/be40c894-22bb-408c-8fdc-aafb5e6b1985?payload=";
		add_to_crisp_link += Base64.encode("{$http_callback|escape:'javascript':'UTF-8'}")
		window.open(add_to_crisp_link,"_self")
	}
</script>

{if $crisp_conectado == true}
	<div class="panel">
		<div class="panel-heading">
			<i class="icon-gear"></i> Configurações
		</div>
		<div class="wrap crisp-wrap">
		    <div class="crisp-modal">
		     	<h2>Parabéns! Sua loja já está conectada com o Crisp.</h2>
                <P>Você completou com sucesso a instalação do Crisp em sua loja Prestashop e o chat já deve estar visível aos seus visitantes. Caso o chat ainda não apareça, limpe o cache do Prestashop, indo no menu "Parâmetros Avançados - Desempenho", e clicando no botão "Limpar Cache".</P>
                <P>Você também pode configurar a aparência do seu chat ou conectar uma outra conta nessa loja</P>
                
		     	<P>
                <a href="https://app.crisp.chat/website/" class="btn btn-success" role="button">Ver minhas mensagens</a>
                <a href="#" class="btn btn-warning" role="button" onclick="conectar_crisp()">Conectar outra conta</a>
                <a href="https://app.crisp.chat/settings/" class="btn btn-danger" role="button" target="_blank">Configurações</a>
                </P>
                
                <h2>Aplicativos para celular</h2>
                <P>Você também pode acessar o Crisp e atender seus clientes diretamente do seu smartphone Android ou iOS. Para isso, instale um dos aplicativos abaixo:</P>
                <P><a class="btn btn-default" href="https://itunes.apple.com/fr/app/crisp/id1085770229" target="_blank">
     <img src="{$caminho_imagens}app_store.png"  />
</a>
<a class="btn btn-default" href="https://play.google.com/store/apps/details?id=im.crisp.app" target="_blank">
     <img src="{$caminho_imagens}google_play.png"  />
</a>

</P>
		    </div>
	  	</div>
	</div>
{else}
	<div class="panel">
		<div class="panel-heading">
			<i class="icon-gear"></i> Configurações
		</div>
		<div class="wrap crisp-wrap">
		    <div class="crisp-modal">
            <h2>Etapa 1. Criar uma conta gratuíta no Crisp</h2>
            <P>Para utilizar este chat na sua loja, é necessário que você tenha uma conta do Crisp.im. Essa conta é gratuíta e você não pagará nada por ela. Se você já tiver criado uma conta, por favor, ignore esta etapa e prossiga para a etapa 2.</P>
            
            <P><a href="https://app.crisp.chat/initiate/signup/" class="btn btn-success" role="button" target="_blank">Criar Conta</a></P>
		      <h2>Etapa 2. Conectar com sua loja Prestashop</h2>
              <P>Se você já criou sua conta com o Crisp, agora é necessário dar permissões para que esta loja Prestashop tenha acesso aos seus dados. Para fazer isso, por favor, clique no botão abaixo.</P>
              
             <P><a href="#" class="btn btn-warning" role="button" onclick="conectar_crisp()">Conectar minha loja</a></P>
             <h2>Etapa 3. Configurar opções do Crisp</h2>		      
             <P>O Crisp possui uma vasta gama de opções configuráveis. Você poderá configurar diversas opções como cores, posição do chat, mensagens automáticas, notificações e diversos plugins. Para fazer isso, clique no botão abaixo. Uma nova janela será aberta no site do Crisp.</P> 
             <P><a href="https://app.crisp.chat/settings/" class="btn btn-danger" role="button" target="_blank">Configurações</a></P>
		    </div>
	  	</div>
	</div>
{/if}