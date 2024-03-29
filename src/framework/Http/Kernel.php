<?php

namespace Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel
{
	public function handle(Request $request): Response
	{
		$dispatcher = simpleDispatcher(function(RouteCollector $collector){

			$collector->get('/', function (){
				$content = '<h1>Hello world!</h1>';

				return new Response($content, 200, []);
			});

			$collector->get('/posts/{id}', function (array $vars){
				$content = "<h1>Post - {$vars['id']}</h1>>";

				return new Response($content, 200, []);
			});

		});

		$routeInfo = $dispatcher->dispatch(
			$request->server['REQUEST_METHOD'],
			$request->server['REQUEST_URI']
		);

		[$status, $handler, $vars] = $routeInfo;

		return $handler($vars);
	}
}