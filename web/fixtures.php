<?php

$users = [
  'test_editor' => [
    'password' => 'password',
    'roles' => [
      'editor',
    ],
  ],
  'test_no_roles' => [
    'password' => 'password',
    'roles' => [],
  ],
  'test_all_roles' => [
    'password' => 'password',
    'roles' => [
      'editor',
      'administrator',
    ],
  ],
];
