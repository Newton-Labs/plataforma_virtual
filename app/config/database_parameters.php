<?php
    //$db = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $container->setParameter('database_driver', 'pdo_mysql');
    $container->setParameter('database_host', getenv('MYSQL_HOST'));
    $container->setParameter('database_port', 3306);
    $container->setParameter('database_name', getenv('MYSQL_NAME'));
    $container->setParameter('database_user', 'fcpauldiaz');
    $container->setParameter('database_password', getenv('MYSQL_PASSWORD'));
    $container->setParameter('secret', getenv('SECRET'));
    $container->setParameter('locale', 'es');
    $container->setParameter('mailer_transport', getenv('EMAIL_TRANSPORT'));
    $container->setParameter('mailer_host', getenv('EMAIL_HOST'));
    $container->setParameter('mailer_user', getenv('EMAL_USER'));
    $container->setParameter('mailer_port', getenv('EMAIL_PORT'));
    $container->setParameter('mailer_password', getenv('EMAIL_PASSWORD'));

