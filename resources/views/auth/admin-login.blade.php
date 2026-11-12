<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#292a40">
    <title>Acesso administrativo | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --line: #e4e4eb; --pink: #f31656; --purple: #61458f; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { min-width: 320px; min-height: 100vh; display: grid; place-items: center; margin: 0; padding: 28px; background: radial-gradient(ellipse at 15% 15%, #e9e3f1 0, transparent 37%), var(--paper); }
        a, button, input { font: inherit; -webkit-tap-highlight-color: transparent; }
        .shell { width: min(100%, 980px); overflow: hidden; display: grid; grid-template-columns: 1fr 1fr; border: 1px solid #e8e5ee; border-radius: 8px; background: white; box-shadow: 0 24px 70px #292a401a; }
        .welcome-panel { position: relative; min-height: 570px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; padding: 42px; background: var(--ink); color: white; }
        .welcome-panel::before, .welcome-panel::after { position: absolute; border: 1px solid #ffffff1a; border-radius: 50%; content: ''; pointer-events: none; }
        .welcome-panel::before { width: 380px; height: 380px; right: -165px; bottom: -155px; }
        .welcome-panel::after { width: 260px; height: 260px; right: -105px; bottom: -95px; }
        .brand { position: relative; z-index: 1; display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; }
        .brand-mark { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 9px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 26px; }
        .brand-name { display: block; font-size: 14px; font-weight: 700; }
        .brand-caption { display: block; margin-top: 3px; color: #c6c6d3; font-size: 11px; }
        .welcome-copy { position: relative; z-index: 1; max-width: 370px; padding: 30px 0; }
        .eyebrow { margin: 0 0 13px; color: #f2a4bb; font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; }
        h1 { margin: 0 0 14px; font-family: 'DM Serif Display', Georgia, serif; font-size: clamp(34px, 4vw, 48px); font-weight: 400; line-height: 1.08; }
        .welcome-copy p { margin: 0; color: #d3d2de; font-size: 13px; line-height: 1.7; }
        .panel-note { position: relative; z-index: 1; display: flex; align-items: center; gap: 10px; color: #c6c6d3; font-size: 11px; }
        .panel-note span { width: 8px; height: 8px; border-radius: 50%; background: #7bc79c; box-shadow: 0 0 0 4px #7bc79c20; }
        .login-panel { display: flex; flex-direction: column; justify-content: center; padding: 52px clamp(28px, 5vw, 62px); }
        .login-heading { margin-bottom: 27px; }
        .login-heading p { margin: 0 0 7px; color: var(--purple); font-size: 10px; font-weight: 700; letter-spacing: 1.3px; text-transform: uppercase; }
        h2 { margin: 0 0 7px; font-family: 'DM Serif Display', Georgia, serif; font-size: 31px; font-weight: 400; }
        .login-heading span { color: var(--muted); font-size: 12px; line-height: 1.6; }
        .login-form { display: grid; gap: 17px; }
        .field label { display: block; margin-bottom: 7px; color: #37374d; font-size: 11px; font-weight: 700; }
        .field input { width: 100%; min-height: 45px; padding: 11px 12px; border: 1px solid #dfe0e7; border-radius: 4px; outline: none; background: white; color: var(--ink); font-size: 13px; transition: border-color .15s, box-shadow .15s; }
        .field input:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        .remember { display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 11px; }
        .remember input { accent-color: var(--purple); }
        .error { margin: 6px 0 0; color: #b44533; font-size: 11px; }
        .alert { padding: 11px 12px; border: 1px solid #e8bec7; border-radius: 4px; background: #fff1f4; color: #9c2145; font-size: 11px; line-height: 1.5; }
        .submit { min-height: 46px; border: 0; border-radius: 4px; background: var(--pink); color: white; font-size: 12px; font-weight: 700; cursor: pointer; transition: background .15s, transform .15s; }
        .submit:hover { transform: translateY(-1px); background: #cb1046; }
        .public-link { margin-top: 25px; padding-top: 18px; border-top: 1px solid var(--line); color: var(--muted); text-align: center; font-size: 11px; }
        .public-link a { color: var(--purple); font-weight: 700; text-decoration: none; }
        .public-link a:hover { text-decoration: underline; }
        @media (max-width: 680px) { body { padding: 16px; } .shell { grid-template-columns: 1fr; max-width: 440px; } .welcome-panel { min-height: auto; gap: 30px; padding: 25px 27px; } .welcome-copy { padding: 5px 0; } h1 { font-size: 34px; } .panel-note { display: none; } .login-panel { padding: 32px 27px; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <main class="shell">
        <section class="welcome-panel" aria-label="Achados e Perdidos">
            <a class="brand" href="{{ route('found-items.index') }}">
                <span class="brand-mark" aria-hidden="true">A</span>
                <span><span class="brand-name">Achados e Perdidos</span><span class="brand-caption">mural da comunidade</span></span>
            </a>
            <div class="welcome-copy">
                <p class="eyebrow">Área restrita</p>
                <h1>Organize os achados. Ajude alguém a reencontrar.</h1>
                <p>Entre no painel para publicar itens encontrados e acompanhar as solicitações recebidas pelo mural.</p>
            </div>
            <div class="panel-note"><span aria-hidden="true"></span>Acesso exclusivo para administração</div>
        </section>

        <section class="login-panel" aria-labelledby="login-title">
            <div class="login-heading">
                <p>Painel administrativo</p>
                <h2 id="login-title">Boas-vindas</h2>
                <span>Informe seus dados de acesso para continuar.</span>
            </div>
            @if ($errors->any())
                <div class="alert" role="alert">Não foi possível entrar. Confira o login e a senha e tente novamente.</div>
            @endif
            <form class="login-form" action="{{ route('admin.login.store') }}" method="post">
                @csrf
                <div class="field">
                    <label for="username">Login</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" maxlength="255" required autofocus>
                    @error('username')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="password">Senha</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                    @error('password')<p class="error">{{ $message }}</p>@enderror
                </div>
                <label class="remember"><input name="remember" type="checkbox" value="1"> Manter conectado neste dispositivo</label>
                <button class="submit" type="submit">Entrar na administração</button>
            </form>
            <div class="public-link">Quer consultar os itens? <a href="{{ route('found-items.index') }}">Acessar o mural público</a></div>
        </section>
    </main>
</body>
</html>
