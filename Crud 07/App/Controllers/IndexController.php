<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$usuario = Container::getModel('Usuario');
		$this->view->usuarios = $usuario->getAll();
		$this->render('usuarios');
	}

	public function novo() {
		$this->render('novo_usuario');
	}

	public function salvar() {
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);
		$usuario->salvar();

		header('Location: /usuarios');
	}

	public function editar() {
		$usuario = Container::getModel('Usuario');
		$this->view->usuario = $usuario->getById($_GET['id']);
		$this->render('editar_usuario');
	}

	public function atualizar() {
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_POST['id']);
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);
		$usuario->atualizar();

		header('Location: /usuarios');
	}

	public function excluir() {
		$usuario = Container::getModel('Usuario');
		$usuario->excluir($_GET['id']);
		header('Location: /usuarios');
	}
 
}


?>