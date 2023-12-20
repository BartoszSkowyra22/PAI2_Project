1. To use the application you need to create a mySQL database and then the following tables:
    - users
    - logged_in_users

You can use the following SQL code:

*users:

CREATE TABLE IF NOT EXISTS `users` ( `id` int(11) NOT NULL AUTO_INCREMENT, `userName` varchar(100) NOT NULL, `fullName` varchar(255) NOT NULL, `email` varchar(100) NOT NULL, `passwd` varchar(255) NOT NULL, `status` int(1) NOT NULL,
`date` datetime NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `userName` (`userName`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


*logged_in_users:

CREATE TABLE IF NOT EXISTS `logged_in_users` ( `sessionId` varchar(100) NOT NULL,
`userId` int(11) NOT NULL,
`lastUpdate` datetime NOT NULL,
PRIMARY KEY (`sessionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

