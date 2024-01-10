<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakeIdpController extends Controller
{
    private function redirectIfAuthenticated(Request $request)
    {
        if (auth()->check())
            return redirect()->to(
                $request->session()->pull('next_url', route('home'))
            );
    }

    public function idp(Request $request)
    {
        // Verifica se o "next_url" existe
        if ($request->has('next_url'))
        {
            // Se existir, verifica se é uma URL válida
            $request->validate([
                'next_url' => 'url'
            ]);
            $request->session()->put('next_url', $request->next_url);
        }

        // Se o utilizador já estiver autenticado, redireciona-o para a página seguinte
        // Caso contrário, mostra a página de autenticação
        return $this->redirectIfAuthenticated($request) ?? view('idp');
    }

    public function login(Request $request)
    {
        // Verifica se o utilizador já está autenticado
        $redIfAuth = $this->redirectIfAuthenticated($request);
        if ($redIfAuth) return $redIfAuth;

        // Se não estiver autenticado, tenta autenticá-lo com as credenciais fornecidas
        $request->validate([
            'j_username' => 'required|email',
            'j_password' => 'required'
        ]);
        auth()->attempt([
            'email' => $request->j_username,
            'password' => $request->j_password
        ]);

        // Se o utilizador estiver autenticado, redireciona-o para a página seguinte
        // Caso contrário, mostra a página de autenticação com uma mensagem de erro
        return $this->redirectIfAuthenticated($request) ?? redirect()->back()->withErrors([
            'credentials' => 'Credenciais inválidas'
        ]);
    }

    public function logout()
    {
        // Faz logout do utilizador e redireciona-o para a página inicial
        auth()->logout();
        return redirect()->route('home');
    }
}
