<?
/*
//// DARGHOS WEBSITE v.ALPHA 
//// 2008, TODOS DIREITOS EST�O RESERVADOS!!
//// Website desenvolvido por Slash, programador PHP da UltraxSoft, equipe que administra o Website Darghos 
//// Website utilizando:
//// OOP Engine
*/

/*
//// Inicia os SESSIONs do sistema ////
*/

session_start();

/*
//// Inicia as Configura��es padr�es do sistema ////
*/

	include "lang/translations.php";
	include "definitions.php";
	include "config.php";

/*
//// Inicia a estrutura "m�e" do sistema, classe Engine ////
*/
	include "classes/engine.php";
	$engine = Engine::getInstance();

/*
//// Carrega a estrutura de Banco de Dados do Servidor
//// Testa se h� conex�o com o Banco de dados 
*/	
	$mySQL = $engine->loadObject('mySQL');
	$g_linkResource['site'] = $mySQL->connect('site');
	$g_linkResource['loginserver'] = $mySQL->connect('loginserver');	
	$g_linkResource['serverI'] = $mySQL->connect('serverI');	
	
	/*echo $g_linkResource['site'];
	echo $g_linkResource['loginserver'];*/
	
	$DB = $engine->loadObject('DB');	

/*
//// Carrega estrutura de ferramentas
*/	
	
	$tools = $engine->loadObject('tools');
	$login = $engine->loadObject('login');

/*
//// Carrega classe de tradu��es do site
*/	
	
	$lang = $engine->loadObject('trans');
	$lang->setLanguage();
	
/*
//// Carrega a estrutura de Elementos HTML
*/
	$eHTML = $engine->loadObject('elementHTML');
	$layoutDir = "newlay";
	$eHTML->layoutDir = $layoutDir;
	
/*
//// L� a variavel SUBTOPIC para carremento dos Modulos ////
*/		
	if($_REQUEST['act'] != "")
	{	
		switch($_REQUEST['act'])
		{
		
/*
//// Separa��o para inicializa��o de modulos de N�TICIAS ////
*/				
			case "lastnews";
				$topic = $GLOBALS['trans_topicPages']['news'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['lastnews'][$GLOBALS['g_language']];
				include "modules/news/main.php";
			break;
			
			case "newfiles";
				$topic = $GLOBALS['trans_topicPages']['news'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['newfiles'][$GLOBALS['g_language']];
				include "modules/news/newsfile.php";
			break;			

/*
//// Separa��o para inicializa��o de modulos GERAIS ////
*/	
			
			case "about";	
				$topic = $GLOBALS['trans_topicPages']['about'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['about'][$GLOBALS['g_language']];
				include "modules/general/about.php";
			break;		

			case "faq";	
				$topic = $GLOBALS['trans_topicPages']['faq'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['faq'][$GLOBALS['g_language']];
				include "modules/general/about.php";
			break;	

			case "downloads";	
				$topic = $GLOBALS['trans_topicPages']['downloads'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['downloads'][$GLOBALS['g_language']];
				include "modules/general/downloads.php";
			break;		

			case "contact";	
				$topic = $GLOBALS['trans_topicPages']['contact'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['contact'][$GLOBALS['g_language']];
				include "modules/general/contact.php";
			break;						

/*
//// Separa��o para inicializa��o de modulos de PREMIUM ACCOUNT ////
*/				
			
			case "contribute";	
				$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['contributions'][$GLOBALS['g_language']];
				include "modules/premium/main.php";
			break;			

/*
//// Separa��o para inicializa��o de modulos BIBLIOTECA (DARGHOP�DIA) ////
*/				
			
			case "library";	
				$topic = "Darghop�dia";
				$subtopic = "Darghop�dia";
				include "modules/library/main.php";
			break;			

/*
//// Separa��o para inicializa��o de modulos ACCOUNT ////
*/				
			
			case "account.main";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.main'][$GLOBALS['g_language']];
				include "modules/account/main.php";
			break;

			case "account.register";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.register'][$GLOBALS['g_language']];
				include "modules/account/register.php";
			break;	

			case "account.login";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.login'][$GLOBALS['g_language']];
				include "modules/account/login.php";
			break;		

			case "account.logout";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.logout'][$GLOBALS['g_language']];
				include "modules/account/logout.php";
			break;
			
			case "account.changepassword";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.changepassword'][$GLOBALS['g_language']];
				include "modules/account/changepassword.php";
			break;		

			case "account.changeinfos";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.changeinfos'][$GLOBALS['g_language']];
				include "modules/account/changeinfos.php";
			break;	

			case "account.changeemail";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.changeemail'][$GLOBALS['g_language']];
				include "modules/account/changeemail.php";
			break;		

			case "account.cancelchangeemail";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.cancelchangeemail'][$GLOBALS['g_language']];
				include "modules/account/cancelchangeemail.php";
			break;		

			case "account.registration";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.registration'][$GLOBALS['g_language']];
				include "modules/account/registration.php";
			break;				
			
			case "account.lost";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
				include "modules/account/lost.php";
			break;		

			case "recovery.password";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
				include "modules/account/recovery.password.php";
			break;	

			case "recovery.account";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
				include "modules/account/recovery.account.php";
			break;			

			case "recovery.both";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
				include "modules/account/recovery.both.php";
			break;					
			
			case "recovery.newpassword";	
				$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
				include "modules/account/newpassword.php";
			break;				

/*
//// Separa��o para inicializa��o de modulos PERSONAGENS ////
*/	

			case "character.create";	
				$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['character.create'][$GLOBALS['g_language']];
				include "modules/character/create.php";
			break;		

			case "character.preferences";	
				$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['character.preferences'][$GLOBALS['g_language']];
				include "modules/character/preferences.php";
			break;		

			case "character.details";	
				$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['character.details'][$GLOBALS['g_language']];
				include "modules/character/details.php";
			break;				

/*
//// Separa��o para inicializa��o de modulos HIGHSCORES ////
*/				
	
			case "highscores";	
				$topic = $GLOBALS['trans_topicPages']['community'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['community.highscores'][$GLOBALS['g_language']];
				include "modules/community/highscores.php";
			break;	
	
/*
//// Separa��o para inicializa��o de modulos ADMINISTRA��O ////
*/	

			case "admin.news";	
				$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['admin.news'][$GLOBALS['g_language']];
				include "modules/admin/news.php";
			break;		

			case "admin.payments";	
				$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['admin.payments'][$GLOBALS['g_language']];
				include "modules/admin/payments.php";
			break;			

			case "admin.payments.new";	
				$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['admin.paymentsnew'][$GLOBALS['g_language']];
				include "modules/admin/payments.new.php";
			break;	

/*
//// Separa��o para inicializa��o de modulos PAGAMENTOS ////
*/	

			case "payment.details";	
				$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['payment.details'][$GLOBALS['g_language']];
				include "modules/payments/detail.php";
			break;		

			case "payment.accept";	
				$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
				$subtopic = $GLOBALS['trans_subTopicPages']['payment.accept'][$GLOBALS['g_language']];
				include "modules/payments/accept.php";
			break;	

/*
//// Separa��o para inicializa��o de modulos SETS ////
*/				
			
			case "set";	
				$topic = "Set";
				$subtopic = "Set";
				include "set.php";
			break;				
		}
	}
	else
	{
/*
//// Inicia o Modulo padr�o (default) para �ltimas N�ticias ////
*/		
	
		$topic = $GLOBALS['trans_topicPages']['home'][$GLOBALS['g_language']];
		$subtopic = $GLOBALS['trans_subTopicPages']['lastnews'][$GLOBALS['g_language']];
		include "modules/news/main.php";		
	}
/*
//// Aplica o Layout ao sistema ////
*/		
	include "$layoutDir/layout.php";
?>