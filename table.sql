CREATE TABLE `cars` (
  `id` int AUTO_INCREMENT NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `nbrSlots` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `nbrSlots`) VALUES
(1, 'Skoda', 'Fabia', 'Noire', 5),
(2, 'Huandai', 'Getz', 'Rouge', 5),
(3, 'Mercedes', 'Classe C', 'Noire', 4),
(4, 'Renaut', 'Zoé', 'Bleu', 2);

CREATE TABLE users_cars (
	user_id INT NOT NULL, 
	car_id INT NOT NULL, 
	PRIMARY KEY(user_id, car_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);




CREATE TABLE `annonces` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `prix` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


INSERT INTO `annonces` (`id`, `titre`, `prix`) VALUES
(1,'Trajet Bézier-Montpellier', 14),
(2,  'Trajet France-Belgique', 30),
(7, 'Trajet Nîmes-Arles', 10);


CREATE TABLE annonces_cars (
	annonce_id INT NOT NULL, 
	car_id INT NOT NULL, 
	PRIMARY KEY(annonce_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `annonces_cars` (`annonce_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);
