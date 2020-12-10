-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 01:04 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zenith`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(50) DEFAULT NULL,
  `account_type` varchar(50) NOT NULL,
  `account_balance` double(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_number`, `account_type`, `account_balance`) VALUES
(46, '000', 'savings', 0.00),
(47, '0046', 'savings', 1480.00),
(48, '0047312465', 'savings', 0.00),
(49, '0048312465', 'savings', 0.00),
(50, '0049312465', 'savings', 0.00),
(51, '0050312465', 'savings', 0.00),
(52, '0051312465', 'savings', 0.00),
(53, '0052312465', 'savings', 0.00),
(54, '0053312465', 'savings', 0.00),
(55, '0054312465', 'savings', 0.00),
(56, '0055312465', 'savings', 0.00),
(57, '0056312465', 'savings', 0.00),
(58, '0057312465', 'savings', 0.00),
(59, '0058312465', 'savings', 0.00),
(60, '0059312465', 'savings', 0.00),
(61, '0060412465', 'savings', 0.00),
(62, '0061412465', 'savings', 0.00),
(63, '0062612465', 'savings', 0.00),
(64, '0063612465', 'savings', 0.00),
(65, '0064612465', 'savings', 0.00),
(66, '0065612465', 'savings', 0.00),
(67, '0066612465', 'savings', 0.00),
(68, '0067612465', 'savings', 0.00),
(69, '0068612465', 'savings', 0.00),
(70, '0069612465', 'savings', 0.00),
(71, '0070612465', 'savings', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `account_stats` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `gender`, `password`, `user_role`, `account_stats`) VALUES
(1, 'israel', 'male', '12345', 'Super Admin', 'Active'),
(2, 'john', 'male', '12345', 'Teller', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL,
  `middle_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `dob` varchar(40) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `bio_data` varchar(255) NOT NULL,
  `tpt` varbinary(8000) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending Completion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `address`, `email`, `phone`, `dob`, `account_number`, `passport`, `bio_data`, `tpt`, `status`) VALUES
(2, 'Sunny', 'fafafa', 'Emmanuel', 'male', '1209,v dmdls', 'duff_israel@yahoo.com', '08032433543', '0000-00-00', '0046', '../upload/profile/0046.png', 'eastern region', '', 'Pending Completion'),
(3, '', '', '', 'gender', '', '', '', '', '0059312465', '../upload/profile/0059312465.png', '', '\0ø~È*ãs\\ÀA7	«q0³U’=jÊlìĞSù÷6À§åyx¹‰…z\\°Ó¡ôy¡¿Tª:0Fíe¸2©Ë@¼v¤ù=çÑùõp\\:À3Î™ñŞ?Z´8	Ñd"¼¦ï¤æÊè=”Qß¼*LV;¥‰xŒ‡eÄÇ—l¥ÈÈ0à:Áß4ä½I]”.©,|]ƒ.€>k¥	bj3>m*?cUu9ËU%’£#ä$¡ÑŸ™5W]¨K^ùXíÚã\\b¿„„-\\]T&&wH5ÊüÆîNÌJ²kºSˆŠµwÁí(ğN+âFÜ&^¨åÕÔ¼>[Ï­urª]Œ<]ˆZ]+Ö)¨u"ÊXÀ?$wƒŸ4mñË éROZÅ­zaÈônKÙ³yÑ|í2Ñ{®¹¾.ÏD5–Ó^Ç\\ö	iBº±Æ4·U0m„å\rÓ……£g‰3).ìûKÛrÔi"Úıëjî6”…<Jd‡|[LäP\\w©Øá¼óÈnªï¢?©­ïQ>Ğub[	o\0øÈ*ãs\\ÀA7	«q°³U’ìÑ8ç³P‚©‘Ò:tNô˜=J`´²Ş ¾ğ , \rû›Éy.™â2*ÆúÁü˜Uuı9ÿş„şıŒf.!ªÁ”–p:\r¾‡^{Ü§Ì€VnÏ.ÑœÓO\0jÉ‡r•äˆ–Í¶¹Ìñ@ËQQEƒ&Îã©z +"ƒ&9E6pSw±¦<­æ÷ˆ¿òJÉZ®¢Áñ[»×Ÿ‰ƒî>£ˆñÅŸÃÏæCÏÇG¥:õ2qGr€N!Šg5	bÖt\Z¹©×Xñ†Ób9sëóà£QÈ	œñÑ¼ÜU''ğ8~œY¯™©ˆ´0$µ7¥pû×àRİÒ}Œ9ÇË!Ù07ÿ j"…nk`¤cªõÿ#|ªCô©¨Ù•cè÷ı !@ÏŸ\ZĞxU‡Ë2Ö:Œ:prÎ›İÑYc†tÍ·;(T£bˆGo´ŞG¯iExß´]1r¾zXIt¯’W‘§‰Ú4"¹£"ˆˆuäY‰Ñ–·D>•nâo\0øÈ*ãs\\ÀA7	«qğLU’×ObªVÕÕóû]	@	ˆ!İİ/Õp{ e+ôµ¨ìZ²r%XÉFHö› Y©8Bši÷º¼ã9ê¥8qYßÈéŠ–û÷§KSót‚	)õ ×ºë›(58ñ^‹ˆãÚçí‡o¥dßCZ½ùZ¸D~5Á kš™ÇäúÒ”ßëV´&0…²(èú\0µÆ®Ä''€ÒQ1±’DÌrô¤Åó\0Cıt=×ò>T{\nGFõƒ6ù¤jÓÅcŸ$øÎÛHÌß›û\rö(\Z¢(Õ¨C²o}nkQ/]?^¨T*mõQó1-0ºï.ã‚Çëçãºñ×eof ÚV2uñ›73\\]y#U0mi(ss•I}ª4İÉš:³&`?QKI0½ÆIš2¥\n#Úİûİ3şÚ n2µf"k6,fÅ%39Lh •ŠÄîÄ ¥/Ãûäanš.°«\r/ äX.g`ñd­b­V{p°,Ò–,éo\0èÈ*ãs\\ÀA7	«q0¶U’¡|@®mÛEòäe‹/§€˜ó)¤ÄÖİ\nØŠ?ÔGx–åáCˆıŸqr÷ù¤ad¸?™ŸÈ;ù¶yñ»éëİ¶õ}áD''TŸ.Ñwµ—kŒìEa×ÄŞ;õU@fb­‡H¼¸r¦<Ã_½7Â~o‹Ó&¡	BâıÌÖe]1E#s·6«ñ”M@HªsüÁ>TøAÎP,D»÷»	JV³„½4UZW?úi27\\r÷k-‘Ir4î‰^<1È±¾ŞOú‹Bï2‚D’ØÅë!â,\Z!å¤®"ìdÄß]´[Ç@ó‹`Z’ö«5^\\È¹eNÚ|‰‹˜D®®XIá}ÚYÔÉL°¤,YB´*éwÓŞæ-àøéı$¬É1Í8CÒ	iø[~âÂ&@Ç’*Ø]1åDçÃÕó=s\0¨ëd..¯ĞíLeÛÎ>¹dú!pBH¹Ú’æ€.Í¶f£Ş\n ¨ÿÑ†o\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0(j\0\0\0\0', 'Completed'),
(4, 'VICTOR', 'OFENE', '', 'male', '45 Aba Road', 'victor.ofene@gmail.com', '08034158429', '', '0061412465', '../upload/profile/0061412465.png', '', '\0øÈ*ãs\\ÀA7	«q0®U’!c2³ü”Èb4S¡ºH;tP³g ¨ö}UI6gÔ°½§ínÀéšQi³©ïÉŠcÿï9ğ³W†vö:R(ÈZÎ&ÜéBëCĞ™P’Ó‡\0z«D¡wPòª/4YV\n{m*©çÜædçh“ÿåFKW1È™›ƒş7¥í;•Y«\0”82å!/şóèïV¶L:BÄR|³ÁUÎŒ3›îpÚ%ıüğ=[eÓ!‡~¨ì”[ß\rqä8¶4L}oÿz´wìQvmS¾¯_ÄØHiÆDÍôCÆ4‡\\•"ÄÎX4çw	!Ç‘«¯¹,H;ñQk .K,¿“ğo÷•¢ô$gé½$¼<aŠO¦ëE:TO©ÛüT˜€ •ˆûÄ¬5²±¤*¸Ö\nršt¯ø:EûÍy<ŸÆR«ìVİñXÁù¤æ›×]ÅÍØ¡REfŞ—{ëÒo\0øÈ*ãs\\ÀA7	«q0“U’¢o–éK–ŒRÌxºşBëÒU“±ÿ(6¦dZ„WzŞŒÚÙ$š‰‘‚ÌP,Gş>¡C0´e£ÎsÆZÂÚ±¦¯+Ù×µ¹—‹LDº„Ôtôâ	YÃÁ€¸Ô[æÓ­ÅH7°vÓ…â/—}Ê,1.Tèí§í>·ôR)¬/Huƒş²®mÌB\r&"f…?2©Ì…à‹d¢¨³Å}®†:‰yülï„»%+’ş''õ/îà8Yú™Œt¬ivùF`''×—ÂY±Ğ%5£¤S.@QÄ¡ªU°ÉŠŸ2&&Å(AF¸ƒ¯ÿ)Xµ\Z0d+töçŒ‹NoYú¬X>%Şù(>æi¡ô3V	dp+Kp‹%Ví„ş‰ÿ_è…`éøË^.m«4cDõú+¢.pk–Jàõ*.{âvPğMr	®í°‚Çîâ•8}s{\rì+/‰á3LSXpÌÏŠBşID¸?ùo\0ø€È*ãs\\ÀA7	«qp¤U’£$jóĞl‹¨~>ÔP÷ÎT‚ıáßNÿÔ®Mµ¸²Şâõû¾ŞGgß)ÛÏ^úhÎú\0IÔP¿â¶Ô1Ú¾À†ÊˆÔæzĞwp\\€7ã\n$ö\nÿãjaï{|PK˜Íœİö&¥š¾jî—«aEn8úO®¶¥ƒ\0Î9„!é.¾xg$Å‹‡´Ÿ­ßb×\r9€‹)q‡º×Ù°©{Êb vã¦ĞÀóM¤œ…\rLöOª×e¸{Káióöçj†[«²­í30÷†yx[×—†+É4º[ës…ä`!mPGÎÏŠÀÑ¶QÕŒ¬M¶ìâÿEÆ@ÿG+êÃIov[$ùODÄ~=ä¸ƒÄ(„zˆDá2w„•Ë\0zçËà¡í§¸)A ¤n„šD±O"íšÅ°~ñùl¯!lV#''TÚäxZJ·]Ş9Ÿw…o1 şvôã¨ñ(Vûw:û3}¥Yo\0è€È*ãs\\ÀA7	«qğ–U’­¢¬F£ş[}á§âN1j(8cŸ—Æh×tukÑ_#“‹)+éAş,pË€ÚÀÿO>ñcĞ¼:	xŠÜ›z¾nÏK-OÍÚÉ¤?ğ]²S[‹\0ı\0‚[xÃ­àBÕĞî°K“Ñ ~Ä!ôHlŸ\rßw\\®8‹‹©Œw:»t¾ÅZ~êàç›[ülo_v -åÔ¡"€ms	8‘›}Ô g)íPF¨<¼p¾šP™·œ±Ä,W3ªÿº[=»æ«›‰ô¾°KÈ6ıĞµl|›#ªƒüÄÅóZeÙš)º]_EMiW¿àz®²bª&&ãypQbAßî&==6×ù-\nÚï¦}¯Å§ĞE~¸ÒJ¿@SÖäLçTêKã)øHÈöÜ)ù‘YÅÀi•çÛ/(Áˆ7b¿Ég†¹«¥ğèOÜUØ{±Ô,Ok;YæÌåšs¯?r´Íbıoc\0h\0e\0d\0.\0\r\0\n\0T\0h\0e\0 \0f\0i\0n\0g\0e\0r\0p\0r\0i\0n\0t\0 \0s\0a\0m\0p\0l\0e\0 \0w\0a\0s\0 \0c\0a\0p\0', 'Completed'),
(5, '', '', '', '', '', '', '', '', '', '', '', '\0ø~È*ãs\\ÀA7	«qğOU’ÂùQ95ù!KëXÊrx?\r`Àææ\r„fáEnú}ˆ0¾ªtO£Øşò=À¦Š‚‚Á\rÈÏº¯0;–Tº›É~™B{Ï×öuQ/EÛ•17ÜôÆ¥öi¡Á×A»¹Aˆ<Kİt13X@~á°4áT$«f#õz¾\0	Û¸	@ñBGÎ¥×gR¤…årP®)óˆÈ*xŠı(L{s™u5ÈËcVäï+”?½>Ì#R·‚xp)³Ö½­r¢\nÚ›C/ª¿ß±=ñ‡!W”/£/ejS£ÕcÆ)šÅjÎl¶Ç5‚:x¯·/Ñ¥#œîpÆÎ¾Obàe–ü e…''\n:ÍŒ2s#®jÎı—}NÚf7¸ìş.’0‹•¼÷é0pİf÷‡	6z;˜õÄH¤\\e.²B/\nÊ"_7rá2CÜ''R´ùãF¸dâ_%Ë~Ö¦JBd…¸lÑlgs#ß@ÆÈÇb¿	o\0ø~È*ãs\\ÀA7	«qp°U’à¯¨Ù6İ=\n.''#jH ñ÷Bı¶|”î÷''Ã&}v”™µ0NÙ%‹™Kúyk—±lÄëËäÎoz7½½”Bµ–%8u)Ğ·áÓ†ns!ĞA…/™FóO—\r‹ş”u;0­¢a™ürMÙğ&Ù\rÕ»?5ÏìåÆ˜ÍÆ:Şºª{\\±†«\\%„½ÌÇ·üÀ5’š>Şö\Z›Š„\\Ãµ£‡Q—µ¾œi‚ì˜z\\²5Ğ4\0d‘OÄ„¤\nØ“µ«''z‘eÌNÂ“W²—wHü‰7 #=7ö‹Å›¸•}G¯({¬Èã%`òVıtosi?×0	\Zñ­Où¤$Ì6.ßüï‹q53Lõ×÷’—†^l\r©˜ãcÔ	R\Z¾<TÓ°äœ`5áùÛê­º¥ö>Ä¬¿«¨''®Nq×F?/$¾®ªBçå“T€ÈDÁíƒTXË°õ\\Lsà&‹oUuvƒÄ‡O^sıÈ\\+¹y¯¡=o\0øÈ*ãs\\ÀA7	«q°µU’yÕ6£‡i}¯ \r\ZÚÎÓN§Øø9•™£¸~zR.c:²%€í×UÀyõe<ù—”\Zi>nôå	sÀCEi&\nV$ˆYÛ\Zk”ö0¸6UcI/ƒ‚Ÿ˜¼İW×FßĞ}{ÜÔQÇ=¤j&Fœ¦Û9vu½€Gœ _g¶öhÒãVÈ¥RÉ”l¡íSÏiŞÌNºŸ²³‹†5–)Î»ÑŒ×(SË¸tåºEşò^€À›Üs‡la æ°×/SÀµ:9l‚<ˆV+t­6gØÁà3“\0jY+¯_ãğ5csM2uî7³óL|†»r¸3\\F±Y	£ıCqİWI^SqèÉµÌ$D™Ğ»''r¤Ã(®	vYO~ƒÂZ]¡Úc	éwÛˆI<t<6İE0j2ØšGÄd(Kæğ¾ÛWû.İşìı.”^‰)aló_{X6ÊÃKØQkemo‰Å?ÁiQâ1¨	tÖ0I,¥Õd˜ÀÑo\0è~È*ãs\\ÀA7	«q°³U’êã˜··3 µ.ÿ<T˜ qf{Á@÷MyEù.:\ZºíÙ.¨œ|ÒôúÛÛ÷.©Wñ§­5Üúr<sW2%];/†ØÅ`®Î“~,a3G3ùÛcñ¿Ã­Ã f¦©ZRWrHîPÇ}{÷äq€L7ôôê|2Nêµ5êËÏ)Ê¿Ûw\rìv¥ú«&¯8)eh%ŠêG[j±à³¹Ÿ…ì\rîŒˆ~¡ÿĞÛ}á“±W(q#7-Nïb’ÏŒ,(ÀÍ¿·ïpƒˆİ‰§DCMåõR&S‹8`	Ú/…+Wö?³ÄımyN©‘øï‹IHZúÚ00Ê³Ğ¸Å/MAÙçğ«@´Öìç@=«ú,ï@Ï©?ÍÀ_–Iü"åÇŠ4C2Ê¿Ìè#Ş´ú\r‡¿¶¥,ŒùBá|?iÌ‡ikö\\¿Ñî¢F›\ZÚ¹²—°0\0‘<—™4šÚ~oû ¤ºr\ZØo\0 \0t\0o\0u\0c\0h\0e\0d\0.\0\r\0\n\0T\0h\0e\0 \0f\0i\0n\0g\0e\0r\0 \0w\0a\0s\0 \0r\0e\0m\0o\0v\0e\0d\0 \0f\0r\0o\0m\0 \0t\0h\0', 'Pending Completion'),
(6, 'VICTOR', 'OFENE', 'CHINEDU', 'male', '45 Aba Road', 'victor.ofene@gmail.com', '08034158429', '', '0070612465', '../upload/profile/0070612465.png', '', '\0øÈ*ãs\\ÀA7	«q0°U’?qø@Ğ+râ>PŞÆq“íä?Â\rïì;\nÄøÄ\\DıˆÈ8¡IiÕÍº6yBy­ÑWÑP"üA~uzûıXlà¬sÂz34²4''ûüİn‡ÌC€.èÙM)üøU©v˜†\nï÷yG“\rVê¸[ÃAsÕÁ—o²_ ú»V‰Æâ]Lİ¨èJ|>0÷''^äÙS3Eç¶Ç{%JçÖëŒ+[\0nèÖ¥›î<jmpo`wú¯vÏz œºdY''bi''WÄsÚÏÆ–WL¸_üñàÔÄëA_Òp³2yÉ@MÇ){ö„Û²µjIìu=LØñR"\rœ#ÚıZÀ°A‹~*	|Ï¦EwûÄ„¼Ÿı;|ÿøÈ(ïÃÈ-èvœ¨‰e†ı+V½¥œø\0üepÅlWºhgzÖ—Jª3£¬dÅ²»…*÷6S¥Å6§®©øöÆ‰ûCŠÑÓÚM$ˆÌÃé\nRçG°ç›Šo\0ø~È*ãs\\ÀA7	«q0»U’#¹]Ñ¸|Æ*ñ‚‰!GBQ;Á‚~Yû9÷ß×DÜå‹È¿eMÓÙ¡£0ámL>ˆ‰Á£İsÚ\0ß"¡â''Ï©bKbG#°¨7 ÀG0‰;WtœÔ­[¸y’?S•œK„rUú}TB%F''~3Ù±ÄıŒuF#Ì£éQí½¼jM;ùÓ)…–SîôÇ8ÃQ“õ/®>–©Ê8dwq˜F-‹ÕQ‹Õ_xê‘´p:RÖ7¦àB¼ó|l¼0eÜ%Ë‡º7T#åÁŒ}2vgß™¡§8 $IËZ“‹|Á4-Á•ğÇRCi³OkOª·ñÎ%6Ø]Xã¥¹ïş‚¯€LıáP™mÕ¹£läâg%7£Ê0ƒc¨*|°ò÷w©t±îEŒ<êıê`É1Œ		»)ÒP÷Ù§V8''5:LkŸLnØ¡½J…êf	X{p]=îştX&Á¢È!\nèx#äÙ_‡À]Œ$!9üÙ\nØo\0ø~È*ãs\\ÀA7	«q°½U’úÁ§ÉuÆçdÆTg²Œ<YÖ|-ŸsğáÇîÊ®ã¤ÅtêA7÷J—ñı€³R_÷qïÏhÚ:¡üUÖ¦\\U>ıÂPR¤3ZoîœÒëäËY4ÚE’K f¶»M?@–„¨XBë^]§‰\noôHô~„ÍÙÿ’„ğÿ£ì–‡ôêVoéFÇ.­ÈÑ9ÚVPªvÑ­ß2Q~~Ğt Óı=}zR/Úö\ZúÜQ‘ëtò%\ZûÉŠ!Y›èÒÓÑÈÔc_Áé¨Ô˜äÎBdPQ×‘s”æÁó"Áï\Zyo\0ƒ·DVÑYÜ5±Ş\nHõ›†Öcó®G,d‚Fôx´“ÄdIL÷<j³Ñ€Ô„–~…3•)ó¼Cœ;³ùà.#bĞyAø~/PkÍXÃ”–6Û«ÀÒ£»rÎjË3l¸Ï•=)çkpÒË''¡£†}UyªÏ1û±’19§Rl¡-ğì0üQ³ğR‘»iv@o\0èÈ*ãs\\ÀA7	«q°¿U’«Fdç„54GúìÏ­ø?›°zï~RdGcş¹]½Ø§/eÿ§ûÇŸ2¡\\\rgÒ#­X=·ZµÄøx‚ro9§ {­ùKìpj#%€¢^_è³©7\\eİ‹˜²¾øZ^ÈP·€RöÇë\0B…<òğ©Y[,ıU9''!p²¥5¶î,™”é·øËù7k2I¼z±S’º‘Eq.E˜‰ëº[Š”¼ÀyK{ıt1ÈÁØ¦“X¡ÿÿ“OˆüÆ³Ø²’×/ÁIô#ÿ´h(­ÀßÒÊ¾ˆ^lx¶G[\Z{6¡c"¬ƒá\Z’w¸pÎaÏRÊ—Mä4FÁÈ/ã=õğ®q´¶‘—r[O€bF5Ûá‚@n’—X>V,9>E¡¡\r8$Ë©æ…9Æ‘ğûÙ‹~òª= Õ—Ù’fß\rÑ‡o„ğG9&OÔàgÍ‚4K®‚°jÇ•Œ¬´pî¦YpO/ÛˆÑ —B«õîo\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÀYNü\0\0\0\0\0\0\0\0\0\0', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `fraud`
--

CREATE TABLE IF NOT EXISTS `fraud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `frauder_img` varchar(200) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `checked` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fraud`
--

INSERT INTO `fraud` (`id`, `account_number`, `description`, `frauder_img`, `unit_name`, `checked`) VALUES
(1, '0014', 'test fraud', '', 'unit 1', 0),
(2, '0014', 'test fraud', '', 'unit 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fraud_analysis`
--

CREATE TABLE IF NOT EXISTS `fraud_analysis` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fraud_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(50) NOT NULL,
  `bio_data` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gps` varchar(200) NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_team`
--

CREATE TABLE IF NOT EXISTS `monitoring_team` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `monitoring_team`
--

INSERT INTO `monitoring_team` (`id`, `unit_name`, `email`, `phone`, `password`) VALUES
(1, 'Unit 1', 'unit1@yahoo.com', '09012345678', 'unit1');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(20) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_type`, `account_number`, `transaction_date`, `admin_id`) VALUES
(1, 'deposit', '0046', '2017-12-23 15:24:51', -1),
(2, 'widthraw', '0046', '2017-12-23 15:25:08', -1),
(3, 'widthraw', '0046', '2018-01-29 08:06:54', -1),
(4, 'widthraw', '0046', '2018-01-29 08:41:08', -1),
(5, 'widthraw', '0046', '2018-01-29 08:42:55', -1),
(6, 'widthraw', '0046', '2018-01-29 09:13:39', -1),
(7, 'widthraw', '0046', '2018-01-29 09:18:11', -1),
(8, 'widthraw', '0046', '2018-01-29 10:10:46', -1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
