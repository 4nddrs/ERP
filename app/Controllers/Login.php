<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        helper('form');

        $reglas = [
            'usuario'  => 'required',
            'password' => ['label' => 'contraseña', 'rules' => 'required'],
        ];

        if (!$this->validate($reglas)) {
            return view('login', ['errors' => $this->validator->getErrors()]);
        }

        $usuarioModel = new UsuariosModel();
        $post = $this->request->getPost(['usuario', 'password']);

        $usuarioData = $usuarioModel->validaUsuario($post['usuario'], $post['password']);

        if ($usuarioData !== null) {
            $this->configurarSesion($usuarioData);
            return redirect()->to(base_url('inicio'));
        }

        $this->session->destroy();
        $this->validator->setError('error', 'El usuario y/o contraseña son incorrectos.');
        return view('login', ['errors' => $this->validator->getErrors()]);
    }

    private function configurarSesion($usuarioData)
    {
        $sesionData = [
            'usuarioLogin'  => true,
            'usuarioId'     => $usuarioData['id'],
            'usuarioNombre' => $usuarioData['nombre'],
            'permisos' => ($usuarioData['permisos'] != null) ? json_decode($usuarioData['permisos'], true) : [],
            'id_sucursal' => $usuarioData['id_sucursal'],
        ];

        $this->session->set($sesionData);
    }

    public function logout()
    {
        if ($this->session->get('usuarioLogin')) {
            $this->session->destroy();
        }

        return redirect()->to(base_url());
    }

    public function cambiaPassword()
    {
        helper('form');
        return view('cambia_password', ['usuario' => $this->session]);
    }

    public function actualizaPassword()
    {
        $reglas = [
            'password'     => ['label' => 'contraseña', 'rules' => 'required'],
            'con_password' => ['label' => 'confirmar contraseña', 'rules' => 'required|matches[password]'],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $usuarioModel = new UsuariosModel();
        $post = $this->request->getPost(['id_usuario', 'password']);

        $hash = password_hash($post['password'], PASSWORD_DEFAULT);
        $usuarioModel->update($post['id_usuario'], ['password' => $hash]);

        return redirect()->back()->withInput()->with('success', 'Contraseña actualizada correctamente.');
    }
}
