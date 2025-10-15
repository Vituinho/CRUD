<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['usuarios'] = array(
			'route' => '/usuarios',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['novo_usuario'] = array(
			'route' => '/usuario/novo',
			'controller' => 'indexController',
			'action' => 'novo'
		);

		$routes['salvar_usuario'] = array(
			'route' => '/usuario/salvar',
			'controller' => 'indexController',
			'action' => 'salvar'
		);

		$routes['editar_usuario'] = array(
			'route' => '/usuario/editar',
			'controller' => 'indexController',
			'action' => 'editar'
		);

		$routes['atualizar_usuario'] = array(
			'route' => '/usuario/atualizar',
			'controller' => 'indexController',
			'action' => 'atualizar'
		);

		$routes['excluir_usuario'] = array(
			'route' => '/usuario/excluir',
			'controller' => 'indexController',
			'action' => 'excluir'
		);

		$this->setRoutes($routes);
	}

}

?>