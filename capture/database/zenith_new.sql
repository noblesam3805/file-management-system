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
(3, '', '', '', 'gender', '', '', '', '', '0059312465', '../upload/profile/0059312465.png', '', '\0�~�*�s\\�A7	�q0�U�=j�l��S��6���yx���z\\�ӡ�y��T�:0F�e�2��@�v��=�ѝ��p\\:�3Ι��?Z��8	�d"������=�Q��*LV;��x��e�Ǘl���0�:��4�I]�.�,|]�.�>k�	bj3>m*?cUu9�U%��#�$�џ�5W]�K^�X���\\b���-\\]T&&wH5����N�J�k�S���w��(�N+�F�&^���Լ>[ϭur�]�<]�Z]+�)�u"�X�?$w��4m�� �ROZŭza��nKٳy�|�2�{���.�D5��^�\\�	�iB���4�U0m��\rӅ��g�3).���K�r�i"���j�6��<Jd�|[L�P\\w�����n��?���Q>�ub[	o\0��*�s\\�A7	�q��U���8��P����:tN��=J`���ޠ�� ,�\r���y.���2*�����Uu�9������f.!�����p:\r��^{ܧ̀Vn�.ќ�O\0j�ɇr�䈖Ͷ���@�QQE��&��z +"�&9E6pSw��<������J�Z����[�ן���>���ş���C��G�:��2qGr�N!�g5	b�t\Z���X��b9s����Q�	��Ѽ�U''�8~�Y�����0$�7�p���R��}�9���!�07� j"�nk`�c���#|�C���ٕc��� !@ϟ\Z�xU��2�:�:p�rΛ��Y�c�tͷ;(T�b�Go��G�iExߴ]1r�zXIt��W����4"��"��u�Y����D>�n�o\0��*�s\\�A7	�q�LU��Ob�V����]	@	��!��/�p{�e+����Z�r%X�FH�� Y�8B�i����9�8qY��銖���KS��t�	)�����(58�^������o�d�CZ��Z�D~5� k�����Ҕ���V�&0��(��\0�Ʈ�''��Q1��D�r����\0C�t=��>T{\nGF��6��j��c�$���H�ߛ�\r�(\Z�(ըC�o}nkQ/]?^�T*m�Q�1-0��.あ������eof �V2u�73\\]y#U0mi(ss�I}�4�ɚ:�&`?�QKI0��I�2�\n#�����3�� n2�f"k6,f�%3�9Lh ������ �/���an�.��\r/��X.g`�d��b�V{p�,��,�o\0��*�s\\�A7	�q0�U��|@�m�E��e�/�����)��֝�\n؊?�Gx���C����qr���ad�?���;����y����ݶ�}�D''T�.�w���k��Ea���;�U@fb��H��r�<�_�7�~o��&�	B����e]�1E#s��6��M@H�s��>T�AΎP,D���	JV���4UZW?�i27\\r�k-�Ir4��^<1ȱ��O��B�2�D��؎��!�,\Z!吤�"�d��]��[�@�`Z���5^\\ȹeN�|���D��XI�}�Y��L��,YB�*�w���-����$��1�8C�	i�[~��&@�ǒ*�]1�D����=s\0��d..���Leێ�>�d�!pBH�ڒ�.Ͷf��\n���цo\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0(j\0\0\0\0', 'Completed'),
(4, 'VICTOR', 'OFENE', '', 'male', '45 Aba Road', 'victor.ofene@gmail.com', '08034158429', '', '0061412465', '../upload/profile/0061412465.png', '', '\0���*�s\\�A7	�q0�U�!�c2�����b4S��H;tP�g���}UI�6g԰���n���Qi���Ɋc��9�W�v�:R(��Z�&��B�CЙP�Ӈ\0�z�D�wP�/�4YV\n{m*����d�h���FKW1�����7��;�Y�\0�82�!/����V�L:Bč�R|��U��3��p�%���=[e�!�~��[�\rq�8�4L}o�z�w�QvmS��_��Hi�D��C�4�\\�"��X4�w	!Ǒ���,H;�Qk .K,���o����$g�$�<a�O��E:T�O���T���������5���*��\nr�t��:E��y<��R���V��X������]��ءREfޗ{��o\0���*�s\\�A7	�q0�U��o��K��R�x��B��U���(�6�d�Z�Wzތ��$����̐P,G�>�C0��e��s�Z�ڱ���+�׵����LD���t���	Y�����[�ӭ�H7��vӅ�/�}�,1.T���>��R)�/Hu����m�B\r&"f�?2�̅��d����}��:�y�l%+��''�/��8Y���t�iv�F`''ח�Y��%5��S.@Qġ�U�Ɋ�2&&�(AF����)X�\Z0d+t�猋NoY��X>%��(>�i��3V	dp+Kp�%V����_��`���^.m��4cD��+��.pk�J��*.�{�vP�Mr	�������8}s{\r�+/��3LSXp�ϊB�ID��?�o\0���*�s\\�A7	�qp�U��$j��l���~>�P���T����N�ԮM���������Gg�)��^�h���\0I�P����1ھ������z�wp\\�7�\n$�\n��ja�{|PK�͜��&���jaE�n8�O����\0�9�!�.�xg$ŋ�����b�\r9��)q������{�b v����M���\rL�O��e�{K�i���j�[����30��yx[ח�+��4�[�s��`!mPG�ϊ�ѶQՌ�M����E��@�G+��Iov[$�OD�~=七�(�z�D�2w����\0z����)A���n��D��O"��Ű~��l�!lV�#''T��xZJ�]�9�w�o1��v����(V�w:�3}�Yo\0��*�s\\�A7	�q�U����F��[}��N1j(8c���h�tuk�_#��)+�A�,pˀ���O>�c��:	x��ܛz�n�K-O��ɤ?�]�S[�\0�\0�[xí�B���K��Ѡ~�!�Hl�\r�w�\\�8����w�:��t��Z~����[�lo_v�-�ԡ"�ms	8��}��g)�PF�<�p��P�����,W3���[=��������K�6�еl�|�#������Zeٚ)�]_EMiW��z��b�&&�ypQbA��&==6��-\n��}��ō��E~���J�@S��L�T�K�)�H���)��Y��i���/(��7b��g������O�U�{��,Ok;�Y���s�?r��b�oc\0h\0e\0d\0.\0\r\0\n\0T\0h\0e\0 \0f\0i\0n\0g\0e\0r\0p\0r\0i\0n\0t\0 \0s\0a\0m\0p\0l\0e\0 \0w\0a\0s\0 \0c\0a\0p\0', 'Completed'),
(5, '', '', '', '', '', '', '', '', '', '', '', '\0�~�*�s\\�A7	�q�OU����Q95�!K�X�r�x?\r�`���\r�f�En�}�0��t�O����=������\r�Ϻ�0;�T���~�B{���uQ/Eە17��ƥ�i���A��A�<K�t13X@~�4�T$�f#��z�\0	��	@�BGΥ�gR����rP�)��*x��(L{s�u5��cV���+�?�>�#R��xp)��ֽ��r�\nڛC/��߱=�!W�/�/ejS����c�)��j�l���5�:x��/ѥ#��p�Ν�Ob�e���e�''\n:͌2s#�j���}N�f7���.�0�����0p�f��	6z;����H�\\e.�B/\n�"�_7r�2C�''R���F�d�_%��~֦JBd��l�lgs#�@��Ǐb�	o\0�~�*�s\\�A7	�qp�U�௨�6�=\n.''#jH���B���|���''�&}v���0N�%��K�yk��l�����oz7���B��%8u)з�ӆns!�A�/�F�O�\r���u;0��a��rM��&�\rջ?5�������:޺�{\\���\\%�������5��>��\Z����\\õ��Q����i��z\\�5�4\0d��OĄ�\nؓ��''z�e�N��W��wH��7 #=7��ś��}G�({���%`�V�tosi?�0	\Z�O���$�6.���q53L������^l\r���c�	R\Z�<TӰ�`5���ꭺ��>Ĭ���''�Nq׍F?/$����B��T��D��TX˰�\\Ls�&�oUuv�ćO^s��\\+�y��=o\0��*�s\\�A7	�q��U�y�6��i}��\r\Z���N���9����~zR.c:�%���U�y�e<���\Zi>n��	s�CEi&\nV$�Y�\Zk��0�6UcI/������W�F��}{��Q�=�j&F���9vu��G��_g��h���VȥRɔl��S�i��N������5�)λь�(S˸t�E���^����s�la���/S��:9l�<�V+t�6g���3�\0jY+��_��5csM2u�7���L|��r�3\\F�Y	��Cq�WI^Sq�ɵ�$D�л''r��(�	�vYO~��Z]��c	�wۈI<t<6�E0j2ؚG�d(K���W�.����.�^�)al�_{X6��KؐQkemo��?�iQ�1��	t�0I,��d���o\0�~�*�s\\�A7	�q��U�����3 �.�<T��qf{�@�MyE�.:\Z���.��|������.�W�5��r<sW2%];/���`�Γ~,a3G3��c�Î�� f��ZRWrH�P�}{��q�L7���|2N�5���)ʿ�w\r�v���&�8)eh%��G�[j�೹���\r�~����}ᓱW(q�#7-N�b�ό,(�Ϳ��p��݉�DCM��R&S�8`	�/�+W�?�č�myN����IHZ��00ʳи�/MA���@����@=���,�@ϩ?͝�_�I�"�Ǟ�4C2����#޴�\r�������,��B�|?i̇ik�\\���F�\Zڹ����0\0�<��4��~o�� ��r\Z�o\0 \0t\0o\0u\0c\0h\0e\0d\0.\0\r\0\n\0T\0h\0e\0 \0f\0i\0n\0g\0e\0r\0 \0w\0a\0s\0 \0r\0e\0m\0o\0v\0e\0d\0 \0f\0r\0o\0m\0 \0t\0h\0', 'Pending Completion'),
(6, 'VICTOR', 'OFENE', 'CHINEDU', 'male', '45 Aba Road', 'victor.ofene@gmail.com', '08034158429', '', '0070612465', '../upload/profile/0070612465.png', '', '\0���*�s\\�A7	�q0�U�?q�@�+r�>P��q���?�\r��;\n���\\D����8�Ii���6yBy��W�P"�A~�uz��Xl�s�z34�4''���n��C�.��M)���U�v��\n��yG�\rV�[�As���o�_ ��V���]Lݨ�J|>0��''^��S3E��{%J���+[\0n�֥��<jmpo`w��v�z ��dY''bi''W�s��ƖWL�_������A_�p�2y�@M�){��۲�jI�u=L��R"\r�#��Z��A�~*	|ϦEw�Ą����;|���(���-�v���e��+V����\0��ep�lW�hgz֗J�3��dŲ��*�6S�ō6�����Ɖ��C����M$�̞��\nR�G�益o\0�~�*�s\\�A7	�q0�U�#��]Ѹ|�*񂉞!GBQ;���~Y��9���D��ȿeM�١�0�mL>�����s�\0�"��''ύ�bKbG#��7 �G0�;Wt�����[�y�?S��K�rU�}TB%F''~3ٱ���uF#̣�Q�jM;��)��S���8�Q��/�>���8dwq�F-��Q��_xꑴp:R�7��B��|l�0e�%ˇ�7T#���}2vgߙ��8 $I�Z��|�4-����RCi��OkO����%6�]X㥹�����L��P�mչ�l��g%7��0�c�*|���w�t���E�<���`�1�		��)�P�٧V8''5:�Lk�Lnء�J��f	X{p]=��tX&���!\n�x#��_��]�$!9��\n�o\0�~�*�s\\�A7	�q��U�����u��d�Tg��<Y�|-��s����ʮ��t�A7�J�����R_�q��h�:��U֦\\U�>��PR�3Zo�����Y4�E�K f��M?@���XB�^]��\no�H�~���������얇��Vo�F�.���9�VP�vѭ�2Q~~�t���=}zR/��\Z��Q��t�%\Z�Ɋ!Y����ў��c_��Ԙ��BdPQ��s����"��\Zyo\0��DV�Y�5���\nH����c��G,d�F�x����dIL�<j�рԄ�~�3�)�C�;����.#b�yA��~/Pk�XÔ�6۫�ң��r�j�3l�ϕ=)�kp���''���}Uy��1���19�Rl�-��0�Q��R��iv@o\0��*�s\\�A7	�q��U��Fd�54G��ϭ�?��z�~R�dGc��]�ا/e���ǟ2�\\\rg�#�X=�Z���x�ro9��{��K�pj#%��^_���7\\e݁�����Z^�P��R���\0�B�<��Y[,�U9''!p��5��,������7k2I�z�S���Eq.E���[����yK�{�t1��ئ�X�����O��Ƴز��/�I�#���h(��߁�ʾ�^lx�G[\Z{6�c"���\Z�w�p�a�R��M�4F��/�=��q����r[O�bF5��@n��X>V,9>E��\r8�$˩�9Ƒ��ً~�= ՗ْf�\r�чo���G9&O��g͂4K���j�����p�YpO/��� �B���o\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0�YN�\0\0\0\0\0\0\0\0\0\0', 'Completed');

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
