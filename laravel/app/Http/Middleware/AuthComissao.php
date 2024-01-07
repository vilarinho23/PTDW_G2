<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthComissao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obter o utilizador autenticado
        $user = auth()->user();

        // Se não estiver autenticado, redireciona-o para a página de autenticação com a URL da página atual
        if (!$user) return redirect()->route('idp', ['next_url' => $request->url()]);

        // Se o utilizador não for da comissão, redireciona-o para a página inicial
        if (!$user->comissao) return redirect()->route('home');

        // Se o utilizador for da comissão, deixa-o continuar
        return $next($request);
    }
}
