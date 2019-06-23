<?php
require_once '/var/www/vendor/autoload.php';
$pdo = new PDO("mysql:host=" . getenv('MYSQL_HOST') . ";dbname=" . getenv('MYSQL_DATABASE'),
                    getenv('MYSQL_USER'),
                    getenv('MYSQL_PASSWORD'));
                    
//creation tables
echo "[";

$etape = $pdo->exec("DROP TABLE IF EXISTS `commandes`");
$etape = $pdo->exec("CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idsproduits` text NOT NULL,
  `prixttc` float NOT NULL,
  PRIMARY KEY (`id`)
)");

echo "||";
echo " commandes : " . $etape . "\n";

$etape = $pdo->exec("DROP TABLE IF EXISTS `biere`");
$etape = $pdo->exec("CREATE TABLE IF NOT EXISTS `biere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `prixht` float NOT NULL,
  PRIMARY KEY (`id`)
)");
echo " biere : " . $etape . "\n";

$etape = $pdo->exec("DROP TABLE IF EXISTS `users`");
$etape = $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin DEFAULT NULL,
  `numrue` varchar(10) CHARACTER SET utf32 COLLATE utf32_bin DEFAULT NULL,
  `rue` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `codepostal` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pays` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
)");
echo " users : " . $etape . "\n";

//vidage tables
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE biere');
$pdo->exec('TRUNCATE TABLE commandes');
$pdo->exec('TRUNCATE TABLE users');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


echo "||||||||||||";
$pdo->exec("INSERT INTO `biere` (`id`, `nom`, `image`, `description`, `prixht`) VALUES
(1, 'La Chouffe Blonde D\'ardenne', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/la-chouffe-blonde-d-ardenne_opt.png?h=500&rev=899257661', 'Bière dorée légèrement trouble à mousse dense, avec un parfum épicé aux notes d’agrumes et de coriandre qui ressortent également au goût.', 1.91),
(2, 'Duvel', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/duvel_opt.png?h=500&rev=899257661', 'Robe jaune pâle, légèrement trouble, avec une mousse blanche incroyablement riche. L’arôme associe le citron jaune, le citron vert et les épices. La saveur incorpore des agrumes frais, le sucre de l’alcool et une note épicée due au houblon qui tire sur le poivre. En dépit de son taux d’alcool, c’est une bière fraîche qui se déguste facilement. ', 1.66),
(3, 'Duvel Tripel Hop', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/duvel-tripel-hop-citra.png?h=500&rev=39990364', 'Une variété supplémentaire de houblon est ajoutée à cette Duvel traditionnelle. Le HBC 291 lui procure un caractère légèrement plus épicé et poivré. Cette bière présente un fort taux d’alcool mais reste très facile à déguster grâce à ses arômes d’agrumes frais et acides, entre autres.', 2.24),
(4, 'Delirium Tremens', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/blond/delirium_tremens_2.png?h=500&rev=204392068', 'Bière dorée, claire à la mousse blanche pleine. Bière belge classique fortement gazéifiée et alcoolisée à la levure fruitée, arrière-goût doux.', 2.08),
(5, 'Delirium Nocturnum', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/delirium_nocturnum.png?h=500&rev=1038477262', 'Une bière rouge foncée brassée selon la tradition belge: à la fois forte et accessible. Des saveurs de fruits secs, de caramel et chocolat. Légèrement sucrée avec une touche épicée (réglisse et coriandre). La finale en bouche est chaude et agréable.', 2.24),
(6, 'Cuvée des Trolls', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/cuvee_des_trolls_2.png?h=500&rev=923839745', 'Bière brumeuse jaune paille à la mousse blanche consistante. Full body aux arômes fruités d’agrumes et de fruits jaunes. Grande douceur et petite touche acide rafraîchissante, levure. ', 1.29),
(7, 'Chimay Rouge', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/chimay---rood_v2.png?h=500&rev=420719671', 'Bière brune à la robe cuivrée avec une mousse durable, délicate et généreuse. Elle présente des arômes fruités de banane. D’autres parfums comme le caramel sucré, le pain frais, le pain grillé et même une touche d’amande sont aussi présents. Les mêmes arômes sucrés se retrouvent au goût et conduisent à une fin de bouche douce et légèrement amère. ', 1.49),
(8, 'Chimay Bleue', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/chimay---blauw_v2.png?h=500&rev=420719671', 'La Chimay Blauw, aussi connue sous le nom de Grande Réserve, est une bière trappiste reconnue. Il s’agissait au départ d’une bière de Noël, mais elle est disponible toute l’année depuis 1954. Une bière puissante et chaleureuse aux arômes de caramel et de fruits secs.', 1.74),
(9, 'Chimay Triple', 'https://www.beerwulf.com/globalassets/catalog/beerwulf/beers/chimay---wit_v2.png?h=500&rev=420719671', 'Robe de couleur doré clair, légèrement trouble avec une belle mousse blanche qui fera saliver les amateurs. Le nez et la bouche sont chargés de fruits comme le raisin et de levure. Une amertume ronde se dégage en fin de bouche.', 1.57);
");

echo "||]";