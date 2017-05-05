<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/fixtures.php';

$app = new Silex\Application();

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

$app->post(
    '/user/{appSecret}/login',
    function (Request $request, $appSecret) use ($users) {
        if ($appSecret != '1234test') {
            return new JsonResponse(['error' => 'invalid app secret'], 403);
        }

        $data = json_decode($request->getContent(), true);

        if (in_array($data['username'], array_keys($users))) {
            if ($users[$data['username']]['password'] == $data['password']) {
                return new JsonResponse(
                    [
                    'username' => $data['username'],
                    'roles' => $users[$data['username']]['roles'],
                    ]
                );
            } else {
                return new JsonResponse(['error' => 'User not authorized'], 401);
            }
        }

        return new JsonResponse(['error' => 'User not found'], 404);
    }
);

$app->error(
  function (\Exception $e, $code) {
      return new JsonResponse(
        ['error' => 'We are sorry, but something went terribly wrong.']
      );
  }
);

$app->run();