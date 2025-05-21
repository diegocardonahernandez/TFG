<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/User.php';

$users = User::getAllUsers();

renderLayout('processUsers', ["users" => $users]);
