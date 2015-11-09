<?php
require 'Class_PullToDB.php';

$Connection = new PullToDB();

var_dump($Connection->DB_Connect(
    'ec2-107-21-219-235.compute-1.amazonaws.com',
    '5432',
    'dbgsmuc7klfj0t',
    'myyzahbzahwxvs',
    '1x58uPPsg0mfcfBfwt-nRSzlX5'
    )
);
