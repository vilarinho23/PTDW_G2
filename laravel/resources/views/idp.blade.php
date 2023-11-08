<!DOCTYPE html>
<html>
  	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    	<title>Serviço de Autenticação Web</title>
    	<link rel="stylesheet" type="text/css" href="//static.ua.pt/idp/main.min.css?20170731">
		
  	</head>
  	<body>
	<!--<body onload="getReferrer()">-->
	
		<div id="container">
			<div id="header">
	<img src="https://static.ua.pt/idp/logo/ua.gif" alt="Universidade de Aveiro" />
	<div class="language">
		<a data-lang="pt" href="#">pt</a> 
		<a data-lang="en" href="#">en</a>
	</div>
</div>
			<div class="content">
				
				<div class="margin-bottom">
															<p>
						Está a aceder ao serviço:<br />
						<span class="service-name">wso2-is.ua.pt</span>
											</p>
									</div>
				
				<div class="error">
</div>

				<form id="loginForm">
					
										<div class="row">
						<label for="username">Utilizador</label>
						<input class="form-element form-field" id="username" name="j_username" type="text"
						value="">
					</div>

					<div class="row">
						<label for="password">Palavra-passe</label>
						<input class="form-element form-field" id="password" name="j_password" type="password" value="">
																		<a>Esqueceu-se da palavra-passe?</a>
					</div>

					<div>
						<label class="checkbox"><input type="checkbox" name="donotcache" value="1"> Não guardar autenticação</label>
					</div>
					
					<div class="margin-bottom">
						<label class="checkbox"><input id="_shib_idp_revokeConsent" type="checkbox" name="_shib_idp_revokeConsent" value="true">
						Remover permissões de partilha de informação concedidas previamente.						</label>
					</div>
					
										<div class="row">
								                     <button id="btnLogin" class="form-element form-button" name="_eventId_proceed" type="submit"
		                        onClick="this.childNodes[0].nodeValue='A autenticar, por favor aguarde...'"
		                        >Autenticar</button>
		                					</div>
					
										  					  												<div class="row">
						  <button class="form-element form-button" type="submit" name="_eventId_authn/AutenticacaoGov">
							Chave Móvel Digital | Cartão de Cidadão						  </button>
						</div>
					  								
				</form>

				
												
				<div class="help"><a target="_blank" href="http://www.ua.pt/stic/page/22826">Precisa de ajuda?</a></div>
				<div class="legal"><a href="#">Aviso legal</a></div>
				<div class="clear-both"></div>
			</div>
			
			<div id="footer">
	</div>			
			<div class="funding">
				<a href="http://www.poci-compete2020.pt" target="_blank" class="compete"><img src="https://static.ua.pt/idp/logo/compete.gif" alt="Compete 2020" /></a>
			</div>
			
			<div id="info" class="hidden">
				<div class="close">X</div>
				<div class="title">Aviso legal</div>
				<div class="clear-both"></div>
				<div class="margin-top">
										<a href="https://www.ua.pt/privacypolicy" style="color:#fff;text-decoration:underline" target="_blank">Política de Privacidade</a> (abre uma nova janela)
				</div>
			</div>
	
	    </div>
		<script>
 	</body>
</html>