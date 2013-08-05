-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: guerrku1_cms
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.13.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `daddy_id` int(11) DEFAULT NULL,
  `header` longtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `footer` longtext COLLATE utf8_unicode_ci,
  `postTypeId` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FAB8C3B3989D9B62` (`slug`),
  KEY `IDX_FAB8C3B3F8A43BA0` (`post_type_id`),
  KEY `IDX_FAB8C3B3A76ED395` (`user_id`),
  KEY `IDX_FAB8C3B36CA2598C` (`daddy_id`),
  CONSTRAINT `FK_FAB8C3B36CA2598C` FOREIGN KEY (`daddy_id`) REFERENCES `Post` (`id`),
  CONSTRAINT `FK_FAB8C3B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_FAB8C3B3F8A43BA0` FOREIGN KEY (`post_type_id`) REFERENCES `PostType` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (1,1,1,NULL,NULL,'Quem Somos','<p>Depois de perder mais uma final para os vermes (Copa do&nbsp;<span id=\"span_dynabox\"><label>Brasil</label></span>&nbsp;2006); depois de ver a torcida Vasca&iacute;na n&atilde;o comparecer em mais uma final contra a mulambada, um grupo de amigos, atrav&eacute;s de conversas via Internet, resolveu dar um basta nisso. Usando do site de relacionamentos&nbsp;<span id=\"span_dynabox\"><label>Orkut</label></span>, como&nbsp;<span id=\"span_dynabox\"><label>ferramenta</label></span>&nbsp;para divulgar e alavancar o n&uacute;mero de interessados, criaram um novo Movimento. Um Movimento totalmente diferente das tradicionais torcidas organizadas. Seria uma torcida nos moldes das demais sul-americanas, ou seja, das famosas Barras Bravas.<br /><br />Yuri Kebian e Bernardo Reis foram os idealizadores desse Movimento, que nem nome tinha (afinal o nome n&atilde;o importava). Discutiram sobre a possibilidade de criar a torcida com amigos, recebendo apoio de alguns, como Rodrigo Melo. A partir da&iacute;, escolheram um nome no &ldquo;improviso&rdquo;, criaram a comunidade no orkut e convocaram os Vasca&iacute;nos a entrarem nesta barca. Marcaram a primeira reuni&atilde;o para o dia 04/08 e apenas 9 Guerreiros compareceram (Yuri, Bernardo, Juca, Diego, Leonardo Luz, Dudu Luz, Renata Neris, Mondragon e Renan). Com uma discreta propaganda, por volta de 15 loucos Vasca&iacute;nos fizeram a estr&eacute;ia dos Guerreiros do Almirante, no dia 16/08. Uma estr&eacute;ia t&iacute;mida em n&uacute;mero de componentes, mas enorme em disposi&ccedil;&atilde;o e vibra&ccedil;&atilde;o. Apenas com bandeiras do&nbsp;<span id=\"span_dynabox\"><label>Vasco</label></span>, estes 15 loucos j&aacute; foram notados pelo restante dos torcedores presentes em S&atilde;o Janu&aacute;rio. A partir do terceiro&nbsp;<span id=\"span_dynabox\"><label>jogo</label></span>, j&aacute; estreamos nossas famosas &ldquo;barras&rdquo; (faixas verticais) e nossos primeiros instrumentos. Da&iacute; pra frente, todo mundo j&aacute; sabe o que aconteceu: festas, festas e mais festas.<br /><br /><br /><br />Surgia a Barra mais Louca, tamb&eacute;m conhecida como&nbsp;<strong>Guerreiros do Almirante</strong>.</p>',NULL,NULL,'2013-07-22 17:03:22','2013-08-02 19:42:52','quem-somos',1),(2,1,1,NULL,NULL,'Manifesto','<p><span id=\"span_dynabox\"><label>Rio de Janeiro</label></span>, 16 de agosto de 2009<br /><br /><br />Vasca&iacute;nos espalhados pelos quatro cantos do mundo, saibam que este pequeno documento tem como objetivo prim&aacute;rio, fazer saber a todos voc&ecirc;s que formam a Comunidade Cruzmaltina - a saber, seus s&oacute;cios, sua imensa torcida bem feliz, seus atletas e ex-atletas, funcion&aacute;rios, al&eacute;m de dirigentes, sejam os atuais, os que j&aacute; passaram e principalmente os que ainda vir&atilde;o - o que vem a ser esse movimento que transformou parte da torcida Vasca&iacute;na desde 2006 e que com certeza, muito ter&aacute; ainda para oferecer ao Club de Regatas&nbsp;<span id=\"span_dynabox\"><label>Vasco</label></span>&nbsp;da Gama.<br /><br />Outra meta que queremos atingir &eacute; a de divulgar nossas id&eacute;ias al&eacute;m da Massa Vasca&iacute;na, fazendo chegar ao p&uacute;blico em geral, &agrave;s autoridades legalmente estabelecidas e em particular &agrave; m&iacute;dia, quem somos, o que somos e o que pensamos: antes e acima de qualquer coisa UM grupo de Vasca&iacute;nos que se uniu para amar o clube, sem nenhum interesse financeiro ou pol&iacute;tico-partid&aacute;rio!<br /><br />&Eacute; sabido que h&aacute; mais de cem anos, apaixonados torcedores do Club de Regatas Vasco da Gama t&ecirc;m unido esfor&ccedil;os para transformar o clube do almirante no Gigante que &eacute; hoje. Foi com esse amor incondicional, que lutamos contra preconceitos, quebramos barreiras, constru&iacute;mos o mais belo est&aacute;dio do&nbsp;<span id=\"span_dynabox\"><label>Brasil</label></span>&nbsp;e mudamos a Hist&oacute;ria do&nbsp;<span id=\"span_dynabox\"><label>futebol</label></span>brasileiro.<br /><br />Tamb&eacute;m foi com esse mesmo esp&iacute;rito que no dia 16 de Agosto de 2006, quinze &lsquo;loucos&rsquo; se encontraram em S&atilde;o Janu&aacute;rio, bem ali, na sa&iacute;da 3. Com o decorrer do&nbsp;<span id=\"span_dynabox\"><label>tempo</label></span>, cada vez mais Guerreiros se uniram. A &lsquo;loucura&rsquo; aumentou e o reconhecimento foi conquistado, n&atilde;o apenas como mais um movimento, mas, principalmente, pelo fato de que demonstramos que o nosso lema &lsquo;o Vasco merece muito mais do que podemos oferecer&rsquo; n&atilde;o &eacute; apenas uma&nbsp;<span id=\"span_dynabox\"><label>figura</label></span>&nbsp;de ret&oacute;rica.<br /><br />Os Guerreiros do Almirante foram criados com a finalidade de UNIR toda a Massa Vasca&iacute;na em torno de uma s&oacute; causa: APOIAR O VASCO ACIMA DE TUDO!!! Para isso buscamos inspira&ccedil;&atilde;o no apoio incondicional das Barras Sul-Americanas, na consci&ecirc;ncia pol&iacute;tica dos ULTRAS da Europa, estilos diferentes de torcer das nossas tradicionais Torcidas Organizadas (T.Os), onde &eacute; obrigat&oacute;rio cantar durante todo o&nbsp;<span id=\"span_dynabox\"><label>jogo</label></span>, n&atilde;o importando o placar da partida e onde buscamos levar o torcedor a se associar &agrave; sua paix&atilde;o, com o objetivo de participar mais ativamente dos destinos do seu clube.<br /><br />Mas n&atilde;o somos uma &lsquo;c&oacute;pia pura e simples&rsquo; de nada estrangeiro: nos consideramos um passo al&eacute;m!<br />Juntamos o apoio &lsquo;enlouquecido&rsquo; latino, a atividade pol&iacute;tica, sem ser partid&aacute;ria, dos europeus, com a ginga e o bom humor t&iacute;pico dos cariocas. Isto sintetiza o Movimento Guerreiros do Almirante!<br /><br />N&atilde;o cobramos nada para que as pessoas se juntem aos Guerreiros, apenas que ame o Vasco como n&oacute;s amamos!<br /><br />Gostou do espet&aacute;culo que viu na arquibancada?<br />Gosta de ir aos est&aacute;dios para torcer?<br />Quer fazer parte?<br />Acha que tem disposi&ccedil;&atilde;o para cantar e pular o tempo todo e ama o Vasco de paix&atilde;o?<br />Ent&atilde;o, seu lugar &eacute; aqui!<br /><br />Pegue uma camisa oficial ou licenciada do nosso amado Vasc&atilde;o, e fique no meio das nossas &lsquo;barras&rsquo;, aquelas faixas verticais que v&atilde;o do alto at&eacute; embaixo das nossas arquibancadas, pulando e cantando at&eacute; a vit&oacute;ria final.<br /><br />Procuraremos nos manter totalmente apartid&aacute;rios dentro da pol&iacute;tica interna do Club de Regatas Vasco da Gama, pois abrigamos torcedores do clube e n&atilde;o dos dirigentes. N&atilde;o existe nenhum tipo de liga&ccedil;&atilde;o com qualquer grupo pol&iacute;tico do C.R.V.G., seja ele oposi&ccedil;&atilde;o ou situa&ccedil;&atilde;o.<br /><br />Acreditamos que quem ama o Vasco quer seu crescimento. Por essa raz&atilde;o, n&atilde;o receberemos ingressos gratuitos, seja qual for a diretoria do CRVG. Guerreiro que &eacute; Guerreiro mesmo, PAGA O SEU INGRESSO E AJUDA AO CLUBE!<br /><br />N&atilde;o cantaremos m&uacute;sicas que exaltem apenas o nome do Movimento Guerreiros do Almirante ou que sejam exclusivamente contra os advers&aacute;rios, por&eacute;m, s&oacute; e somente, aquelas que engrande&ccedil;am ainda mais o nosso amado clube e empolguem a nossa Massa. Cita&ccedil;&otilde;es aos advers&aacute;rios e ao nosso Movimento s&atilde;o aceitas nas letras das nossas m&uacute;sicas. NUNCA vaiaremos o time durante uma partida, pois entendemos que isso n&atilde;o contribui de forma alguma. Mas ap&oacute;s as partidas poderemos, ou n&atilde;o, manifestar nosso rep&uacute;dio a alguma situa&ccedil;&atilde;o desagrad&aacute;vel ao clube.<br /><br />N&atilde;o teremos nenhum tipo de uniforme (camisa, cal&ccedil;a ou casaco escrito GdA), pois entendemos que Vasca&iacute;no de verdade usa material OFICIAL OU LICENCIADO DO C.R.V.G, que &eacute;&nbsp;<span id=\"span_dynabox\"><label>fonte</label></span>&nbsp;de recursos para o clube. N&oacute;s n&atilde;o somos concorrentes de quem amamos. O MEMBRO QUE FIZER PARA SEU USO OU PARA VENDA, MATERIAL ALUSIVO A QUALQUER S&Iacute;MBOLOGIA DOS GUERREIROS DO ALMIRANTE EST&Aacute; PASS&Iacute;VEL DE PENALIZA&Ccedil;&Atilde;O POR PARTE DOS CAPPOS.<br /><br />Para n&oacute;s &eacute; fundamental que cada integrante do Movimento se torne s&oacute;cio do clube, pois entendemos que muito mais alto que o brado das arquibancadas &eacute; a voz das urnas. Queremos opinar sobre os destinos do nosso amor e achamos que temos boas id&eacute;ias que venham a ajudar o clube a alavancar sua entrada no s&eacute;culo XXI. Apoiamos a campanha &lsquo;O VASCO &Eacute; MEU&rsquo; e qualquer outra que o Vasco venha a lan&ccedil;ar para captar mais s&oacute;cios.<br /><br />Somos um Movimento de arquibancadas. Evitamos envolvimentos em rixas contra advers&aacute;rios, na medida em que entendemos que nosso maior patrim&ocirc;nio &eacute; o NOSSO COMPONENTE e a sua vida, bem como a sua integridade f&iacute;sica &eacute; nossa preocupa&ccedil;&atilde;o principal.<br /><br />Apesar de uma origem an&aacute;rquica, no sentido popular da palavra, hoje os Guerreiros do Almirante t&ecirc;m um sistema de organiza&ccedil;&atilde;o pr&oacute;prio, voltado para administrar a festa que fazemos nos est&aacute;dios onde o Vasco da Gama joga, e que &eacute; bem diverso do que &eacute; comumente adotado pelas T.Os.<br /><br />Sempre que o Movimento Guerreiros do Almirante for convidado para qualquer reuni&atilde;o, de qualquer grupo pol&iacute;tico do Club de Regatas Vasco da Gama, torcidas organizadas, associa&ccedil;&otilde;es e movimentos se far&aacute; representar por suas lideran&ccedil;as, no papel de ouvintes interessados, pois entendemos que o debate pol&iacute;tico &eacute; inerente do ser humano, ainda mais porque a torcida do Vasco &eacute; a mais politizada do Brasil. Estarmos representados nessas reuni&otilde;es N&Atilde;O NOS LIGA A NENHUM GRUPO POL&Iacute;TICO DO VASCO DA GAMA, pois reafirmamos aqui o car&aacute;ter APARTID&Aacute;RIO E PLURAL do Movimento, uma de suas bandeiras desde sua funda&ccedil;&atilde;o, em 2006.<br /><br />O fato de sermos APARTID&Aacute;RIOS, pois temos membros de todas as correntes pol&iacute;ticas do clube, n&atilde;o pro&iacute;be de mantermos sempre abertos ao di&aacute;logo, com qualquer corrente pol&iacute;tica do C.R.V.G, pois esta &eacute; a &uacute;nica forma que entendemos ser capaz de propiciar o avan&ccedil;o da &ldquo;Massa Vasca&iacute;na&rdquo;.<br /><br />N&oacute;s n&atilde;o temos um presidente, temos v&aacute;rios l&iacute;deres, que chamamos de &lsquo;Cappos&rsquo;, que s&atilde;o as pessoas que tomam as decis&otilde;es mais importantes e tamb&eacute;m, S&Atilde;O AUTORIZADOS A FALAR EM NOME DOS GUERREIROS DO ALMIRANTE. Os Cappos dos Guerreiros do Almirante t&ecirc;m o DEVER de sempre prestar contas do fluxo de capital do Movimento, cujo balan&ccedil;o mensal &eacute; publicado na internet para consulta de todos.<br /><br />Al&eacute;m dos Cappos, existem os Conselheiros, que s&atilde;o formados por pessoas que t&ecirc;m anos de arquibancada e que, na medida do poss&iacute;vel, de uma forma ou de outra, acabaram sempre nos ajudando. O Conselho servir&aacute; para blindar o GdA de qualquer problema interno e at&eacute; mesmo ajudar os cappos quando for solicitado. &Eacute; dever do Conselho fiscalizar o trabalho dos Cappos, mostrar alternativas para as quest&otilde;es internas e externas do Movimento. Tamb&eacute;m, quando necess&aacute;rio, ser a &lsquo;voz&rsquo; dos Guerreiros do Almirante.<br /><br />Esses dois grupos se re&uacute;nem periodicamente para analisar os rumos do Movimento. Tamb&eacute;m s&atilde;o lideran&ccedil;as importantes os respons&aacute;veis pelos &lsquo;bairros&rsquo; - forma que os Guerreiros se aglutinam em todo estado do Rio de Janeiro - e os que comandam nossos Consulados, como chamamos os Guerreiros fora do estado do Rio de Janeiro, pois j&aacute; temos c&eacute;lulas como essas espalhadas de norte a sul &ndash; &lsquo;norte sul, norte sul desse pa&iacute;s&rsquo;!<br /><br />Essas Lideran&ccedil;as devem seguir as determina&ccedil;&otilde;es contidas em um documento especificamente redigido por elas e para elas, visando padronizar atitudes e posturas, divulgando nossa ideologia de amor incondicional ao Vasco da Gama. Para se abrir uma &ldquo;nova unidade&rdquo; do GdA, &eacute; preciso que se saiba exatamente o que somos, assegurando que as pessoas tenham firmeza de que realmente querem participar do nosso Movimento. Para finalizar, existem tamb&eacute;m lideran&ccedil;as espec&iacute;ficas para &aacute;reas como RELA&Ccedil;&Otilde;ES P&Uacute;BLICAS, CARAVANAS, MATERIAL, BANDA e PROJETOS SOCIAIS , entre outros, como constam no nosso organograma.&nbsp;<br /><br />Com esse conciso documento esperamos ter atingido os objetivos por n&oacute;s propostos logo no come&ccedil;o da sua elabora&ccedil;&atilde;o: informar &agrave; comunidade Vasca&iacute;na quem s&atilde;o, o que pensam e o que querem os ANTIGOS LOUCOS DA SA&Iacute;DA 3!<br /><br />COM OS GUERREIROS DO ALMIRANTE O SENTIMENTO NUNCA VAI PARAR!!!<br /><br />Sauda&ccedil;&otilde;es Verdadeiramente Vasca&iacute;nas!<br /><br /><br /><br />Capos:<br /><br />Diego Dias \"Dix\"<br />Renan Figueira<br />Davidson de Mattos<br />Marco T&uacute;lio&nbsp;</p>',NULL,NULL,'2013-07-22 17:04:58','2013-08-02 19:43:03','manifesto',2),(3,1,1,NULL,NULL,'Loja Virtual','<p>Em breve...</p>',NULL,NULL,'2013-07-22 17:05:45','2013-08-04 17:18:16','loja-virtual',3),(6,1,1,NULL,NULL,'Links','<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><strong>| GUERREIROS DO ALMIRANTE |</strong></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/gdavg\">Facebook - P&aacute;gina</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/groups/gda2011/\" target=\"_blank\">Facebook - Grupo</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/groups/guerreirasvascainas/\" target=\"_blank\">Guerreiras Vasca&iacute;nas</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com/Community.aspx?cmm=20190492\" target=\"_blank\">Orkut - Comunidade</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.twitter.com/gdavg\">Twitter</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.myspace.com/gdavg\" target=\"_blank\">Myspace</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.youtube.com/gdamultimidia\" target=\"_blank\">Youtube</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.formspring.me/gdavg\" target=\"_blank\">Formspring</a></p>\r\n<p><span style=\"color: #666666; font-family: verdana; font-size: 11px;\">-&nbsp;</span><a style=\"font-weight: bold; color: #666666; font-family: verdana; font-size: 11px;\" href=\"http://gplus.to/gdavg\" target=\"_blank\">Google +</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">&nbsp;</p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><strong>| BAIRROS |</strong></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">BAIXADA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=93778259\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"https://www.facebook.com/groups/134256046648858\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">M&Eacute;IER -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=52659360\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"https://www.facebook.com/groups/224800260898296\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">JABARECREIO (Jacarep&aacute;gua, Barra e Recreio) -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=99398226\" target=\"_parent\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"https://www.facebook.com/groups/115526035214684\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">VILA DA PENHA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?rl=cpp&amp;cmm=114350353\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/profile.php?id=100002423677810\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">ZONA OESTE -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=36412357\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/groups/gda.zo\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">ZONA SUL -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=33574400\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/groups/106464896102196\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">RAMOS -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=96464016\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">VILA VALQUEIRE -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=65960977\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">JARDIM AM&Eacute;RICA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=57177905\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">ILHA DO GOVERNADOR -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=49090254\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">IRAJ&Aacute; -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=50230237\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">S&Atilde;O CRISTOV&Atilde;O -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=98299417\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">LEOPOLDINA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=49955394\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">TIJUCA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=24804642\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://pt-br.facebook.com/groups/211721778862994\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><strong>| CONSULADOS RJ |</strong></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">NITER&Oacute;I/S&Atilde;O GON&Ccedil;ALO -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=106695229\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.facebook.com/groups/201645856535862\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">SUL DO ESTADO -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=27566530\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"https://www.facebook.com/groups/273932505958411/?ref=ts\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">REGI&Atilde;O SERRANA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=27720058\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">CAMPOS/RJ -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=39882512\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">MACA&Eacute; -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=55756568\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">REGI&Atilde;O DOS LAGOS -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=90042933\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">PETR&Oacute;POLIS -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=95907192\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\"><strong>| CONSULADOS OFF-RIO |</strong></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">ESP&Iacute;RITO SANTO -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=49310598\" target=\"_blank\">Orkut</a>&nbsp;-&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://pt-br.facebook.com/groups/gdaes/\" target=\"_blank\">Facebook</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">DISTRITO FEDERAL -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=29128526\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">SANTA CATARINA -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=50458297\" target=\"_blank\">Orkut</a></p>\r\n<p style=\"color: #666666; font-family: verdana; font-size: 11px;\">PERNAMBUCO -&nbsp;<a style=\"font-weight: bold; color: #666666;\" href=\"http://www.orkut.com.br/Main#Community?cmm=112280475\" target=\"_blank\">Orkut</a></p>',NULL,NULL,'2013-07-22 17:12:10','2013-07-22 17:12:10','links',6),(7,1,1,NULL,NULL,'Contato','<p>Em breve...</p>',NULL,NULL,'2013-07-22 17:13:59','2013-08-04 17:17:50','contato',8),(8,1,1,NULL,NULL,'Multimídia','<p>Em breve..</p>',NULL,NULL,'2013-08-01 09:23:35','2013-08-01 09:23:46','multimidia',4),(12,5,1,NULL,NULL,'Novo site','<p>Fala galera, aqui quem fala &eacute; o Victor, sou o programador respons&aacute;vel pela cria&ccedil;&atilde;o do novo site da Guerreiros do Almirante.</p>\r\n<p>Sou realmente grato ao movimento por me prover tantas alegrias, por isso tomei a iniciativa de fazer esse agrado, pois estavamos precisando.</p>\r\n<p>A sess&atilde;o multim&iacute;dia (fotos e v&iacute;deos), deve ser disponibilizada em breve, assim como a loja virtual e o sistema de pagamento integrado ao PagSeguro, assim que esse sistema for implementado, todos os pagamentos poder&atilde;o ser realizados por cart&atilde;o de cr&eacute;dito (caravanas, caixinhas, contribui&ccedil;&otilde;es, etc.).</p>\r\n<p>Partindo de hoje, o site ser&aacute; atualizado pelo Luciano, <em>vulgo Tio Chico</em>.</p>\r\n<p>Grande abra&ccedil;o a todos!</p>\r\n<p><strong>SV!</strong></p>',NULL,NULL,'2013-08-01 09:37:23','2013-08-04 17:13:47','estreia-do-site',1),(13,4,1,NULL,NULL,'Cruzeiro x Vasco','<p>A partida ser&aacute; realizada no est&aacute;dio do Mineir&atilde;o (minas arena), o valor do ingresso deve ser R$ 80/R$ 40. Os dados da caravana seguem abaixo:</p>\r\n<p>Data: 01/09/2013</p>\r\n<p>Valor: R$ 65,00 (sem ingresso)</p>\r\n<p>Em breve abriremos as inscri&ccedil;&otilde;es no grupo da GDA no facebook.</p>',NULL,NULL,'2013-08-02 16:34:01','2013-08-04 17:12:00','cruzeiroxvasco',2),(15,3,2,NULL,NULL,'Ê da-lhe ô','<p>Autor: Desconhecido.</p>\r\n<p>Ano: 2006.</p>\r\n<p>Letra:</p>\r\n<p>E d&aacute;-lhe eo e d&aacute;-lhe eo... D&aacute;-lhe Vasco, d&aacute;-lhe eo</p>\r\n<p>E d&aacute;-lhe eo e d&aacute;-lhe eo... D&aacute;-lhe Vasco, d&aacute;-lhe eo</p>\r\n<p><a title=\"Download da m&uacute;sica\" href=\"http://www.4shared.com/audio/3qcIkuBc/GDA_-_12_-_Da-lhe_Vasco_da-lhe.html\" target=\"_blank\">Download</a></p>',NULL,NULL,'2013-08-04 17:27:16','2013-08-04 17:28:28','dalheo',1),(16,3,2,NULL,NULL,'Eu sou Boêmio, sim senhor!','<p>Autor: Yuri Kebian.</p>\r\n<p>Ano: 2007.</p>\r\n<p>Letra:</p>\r\n<p>Eu sou bo&ecirc;mio sim senhor!<br />E bebo todas que vier!<br />Bebo pelo meu Vascooo!<br />O meu &uacute;nico amor!</p>\r\n<p>E d&aacute;-lhe, d&aacute;&aacute;&aacute;&aacute;&aacute;&aacute;-lhe meu Vasco!<br />E d&aacute;-lhe, d&aacute;&aacute;&aacute;&aacute;&aacute;&aacute;-lhe meu Vasco!<br />E d&aacute;-lhe, d&aacute;-lhe meu Vasco!!!</p>\r\n<p><a href=\"http://www.4shared.com/audio/Ieh-2KBn/GDA_-_27_-_Eu_sou_boemio_sim_s.html\" target=\"_blank\">Download</a></p>',NULL,NULL,'2013-08-04 17:32:17','2013-08-04 17:32:17','souboemio',2);
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostAttachment`
--

DROP TABLE IF EXISTS `PostAttachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostAttachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_17947D594B89032C` (`post_id`),
  CONSTRAINT `FK_17947D594B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostAttachment`
--

LOCK TABLES `PostAttachment` WRITE;
/*!40000 ALTER TABLE `PostAttachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostAttachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostType`
--

DROP TABLE IF EXISTS `PostType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` tinyint(1) DEFAULT '0',
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C1B60EC8989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostType`
--

LOCK TABLES `PostType` WRITE;
/*!40000 ALTER TABLE `PostType` DISABLE KEYS */;
INSERT INTO `PostType` VALUES (1,'page','<p>Tipo de post referente as p&aacute;ginas</p>',1,'page',-1,1),(3,'Músicas','<p>Aqui entram as m&uacute;sicas da torcida.</p>',1,'musicas',5,1),(4,'Caravanas','<p>Aqui entram as caravanas</p>',1,'caravanas',7,1),(5,'Notícias','<p>Not&iacute;cias do site</p>',0,'noticias',100,1),(6,'Fotos','<p>Fotos.</p>',0,'fotos',101,1),(7,'Vídeos','<p>V&iacute;deos</p>',0,'videos',102,1);
/*!40000 ALTER TABLE `PostType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Taxonomy`
--

DROP TABLE IF EXISTS `Taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `postTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_464DA6B989D9B62` (`slug`),
  KEY `IDX_464DA6B3E64074F` (`postTypes_id`),
  CONSTRAINT `FK_464DA6B3E64074F` FOREIGN KEY (`postTypes_id`) REFERENCES `PostType` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Taxonomy`
--

LOCK TABLES `Taxonomy` WRITE;
/*!40000 ALTER TABLE `Taxonomy` DISABLE KEYS */;
INSERT INTO `Taxonomy` VALUES (1,'Tipo de Multimidia','<p>Qual tipo de multim&iacute;dia.</p>','tipo-multimidia',NULL),(2,'Teste','<p>teste</p>','teste',NULL),(3,'Tipo de Notícia','<p>Tipo de not&iacute;cia</p>','tipo-de-noticia',NULL),(4,'Galeria','<p>Galeria de fotos.</p>','galeria',NULL);
/*!40000 ALTER TABLE `Taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Term`
--

DROP TABLE IF EXISTS `Term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daddy_id` int(11) DEFAULT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `taxonomy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_53D48B3989D9B62` (`slug`),
  KEY `IDX_53D48B36CA2598C` (`daddy_id`),
  KEY `IDX_53D48B3D5E258C5` (`posts_id`),
  KEY `IDX_53D48B39557E6F6` (`taxonomy_id`),
  CONSTRAINT `FK_53D48B36CA2598C` FOREIGN KEY (`daddy_id`) REFERENCES `Term` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_53D48B39557E6F6` FOREIGN KEY (`taxonomy_id`) REFERENCES `Taxonomy` (`id`),
  CONSTRAINT `FK_53D48B3D5E258C5` FOREIGN KEY (`posts_id`) REFERENCES `Post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Term`
--

LOCK TABLES `Term` WRITE;
/*!40000 ALTER TABLE `Term` DISABLE KEYS */;
/*!40000 ALTER TABLE `Term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'admin','admin','admin','admin',1,'ctlcotw3dzk80oo84g0kw8kc0sskgc8','9wYxXJOUBASJ/lC7xvrsuJ8jCwP2z/LkyEGYOz8BcTLfiRS1V584sn3TEqSNzEnmg+7aoJKnWgDUWnf6oOfiSg==','2013-08-02 16:32:36',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL,NULL),(2,'chico','chico','tiochico@guerreirosdoalmirante.com.br','tiochico@guerreirosdoalmirante.com.br',1,'pziv2p22ksg4g484ogc0css4s08oow0','t784ASJRCvdrRTo44LDCxb7mlHA3RCqtug3ZLIhKLqvenkDinf3nq6Qaut91i9KDmX2rxJMrOudZtRVhvpowAA==','2013-08-04 17:04:09',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserPermission`
--

DROP TABLE IF EXISTS `UserPermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserPermission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `permissions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2F0CC55BA76ED395` (`user_id`),
  CONSTRAINT `FK_2F0CC55BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserPermission`
--

LOCK TABLES `UserPermission` WRITE;
/*!40000 ALTER TABLE `UserPermission` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserPermission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-05  2:38:56
