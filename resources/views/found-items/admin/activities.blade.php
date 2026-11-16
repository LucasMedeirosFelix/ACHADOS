<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Histórico | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --line: #e4e4eb; --pink: #f31656; --blue: #2879a7; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        a, button { font: inherit; -webkit-tap-highlight-color: transparent; }
        .topbar { min-height: 70px; display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 12px max(28px, calc((100vw - 1060px) / 2)); background: var(--ink); color: white; }
        .brand { display: flex; align-items: center; gap: 11px; color: white; text-decoration: none; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 8px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 22px; }
        .brand-name { display: block; font-size: 14px; font-weight: 700; }
        .brand-caption { display: block; margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .topbar-actions a, .logout-button { min-height: 38px; display: inline-flex; align-items: center; padding: 0 12px; border: 1px solid #77788a; border-radius: 3px; background: transparent; color: white; text-decoration: none; font-size: 12px; font-weight: 600; cursor: pointer; }
        .topbar-actions a:hover, .logout-button:hover { border-color: white; background: #ffffff12; }
        main { width: min(1060px, calc(100% - 56px)); margin: 0 auto; padding: 36px 0 60px; }
        .page-head { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin-bottom: 22px; }
        .eyebrow { margin: 0 0 7px; color: #61458f; font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1 { margin-bottom: 5px; font-family: 'DM Serif Display', Georgia, serif; font-size: 36px; font-weight: 400; }
        .subtitle { margin: 0; color: var(--muted); font-size: 13px; }
        .count { padding: 10px 13px; border: 1px solid var(--line); border-radius: 4px; background: white; color: var(--muted); font-size: 11px; white-space: nowrap; }
        .activity-list { display: grid; gap: 10px; }
        .activity { display: grid; grid-template-columns: 132px minmax(0, 1fr) auto; align-items: start; gap: 17px; padding: 17px; border: 1px solid var(--line); border-radius: 4px; background: white; }
        .event { display: inline-flex; width: fit-content; min-height: 26px; align-items: center; padding: 0 9px; border-radius: 3px; font-size: 10px; font-weight: 700; }
        .event-created { background: #e9f2e9; color: #275b40; }
        .event-updated { background: #e8f2f7; color: #225d7b; }
        .event-deleted { background: #fff1f4; color: #9c2145; }
        .details { min-width: 0; }
        .details h2 { margin: 0 0 5px; overflow-wrap: anywhere; font-size: 14px; }
        .meta { margin: 0 0 9px; color: var(--muted); font-size: 10px; }
        .description { margin: 0 0 8px; color: #535563; font-size: 11px; line-height: 1.5; white-space: pre-line; overflow-wrap: anywhere; }
        .item-meta { margin: 0; color: var(--blue); font-size: 10px; }
        .changes { display: grid; gap: 5px; margin-top: 9px; }
        .change { display: flex; flex-wrap: wrap; align-items: baseline; gap: 6px; color: #535563; font-size: 10px; overflow-wrap: anywhere; }
        .change strong { color: var(--ink); }
        del { color: #9c2145; }
        ins { color: #275b40; text-decoration: none; }
        .actions { display: flex; gap: 7px; }
        .action-link, .delete-button { min-height: 32px; display: inline-flex; align-items: center; justify-content: center; padding: 0 9px; border: 1px solid #d9d9e2; border-radius: 3px; background: white; color: var(--ink); text-decoration: none; font-size: 10px; font-weight: 700; cursor: pointer; }
        .action-link:hover { border-color: #61458f; color: #61458f; }
        .delete-button { border-color: #f0bacb; color: #b70d41; }
        .delete-button:hover { background: #fff4f7; }
        .empty { padding: 34px 18px; border: 1px dashed #d1c5e1; border-radius: 4px; background: #faf8fc; text-align: center; }
        .empty h2 { margin-bottom: 6px; font-family: 'DM Serif Display', Georgia, serif; font-size: 20px; font-weight: 400; }
        .empty p { margin: 0; color: var(--muted); font-size: 11px; }
        .pagination { margin-top: 16px; }
        .pagination nav { display: flex; justify-content: center; }
        footer { padding: 18px; border-top: 1px solid var(--line); color: #839087; text-align: center; font-size: 10px; }
        @media (max-width: 760px) { .topbar { padding: 11px 16px; flex-wrap: wrap; } .topbar-actions { width: 100%; justify-content: flex-end; flex-wrap: wrap; } main { width: calc(100% - 32px); padding-top: 26px; } .page-head { align-items: start; flex-direction: column; } .activity { grid-template-columns: 1fr; gap: 9px; } .actions { justify-content: flex-start; } }
        @media (max-width: 420px) { h1 { font-size: 31px; } .action-link, .delete-button { flex: 1; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('admin.found-items.index') }}">
            <span class="brand-mark" aria-hidden="true">A</span>
            <span><span class="brand-name">Achados e Perdidos Bradesco</span><span class="brand-caption">painel de administração</span></span>
        </a>
        <nav class="topbar-actions" aria-label="Navegação administrativa">
            <a href="{{ route('admin.found-items.index') }}">Itens cadastrados</a>
            <a href="{{ route('admin.account.edit') }}">Minha conta</a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="logout-button" type="submit">Sair</button>
            </form>
        </nav>
    </header>

    <main>
        <section class="page-head">
            <div>
                <p class="eyebrow">Auditoria administrativa</p>
                <h1>Histórico de itens</h1>
                <p class="subtitle">Acompanhe inclusões, alterações e exclusões feitas no mural.</p>
            </div>
            <div class="count">{{ $activities->total() }} registros</div>
        </section>

        <section class="activity-list" aria-label="Registros de atividade">
            @forelse ($activities as $activity)
                @php
                    $actionLabels = ['created' => 'Adicionado', 'updated' => 'Modificado', 'deleted' => 'Deletado'];
                    $fieldLabels = ['name' => 'Nome', 'description' => 'Descrição', 'found_at' => 'Data', 'location' => 'Local', 'image_path' => 'Foto'];
                @endphp
                <article class="activity">
                    <span class="event event-{{ $activity->action }}">{{ $actionLabels[$activity->action] ?? 'Ação' }}</span>
                    <div class="details">
                        <h2>{{ $activity->item_name }}</h2>
                        <p class="meta">{{ $activity->actor ?? 'Sistema' }} · {{ $activity->created_at->format('d/m/Y H:i') }}</p>
                        @if ($activity->action !== 'updated')
                            <p class="description">{{ $activity->snapshot['description'] ?? '' }}</p>
                            <p class="item-meta">{{ $activity->snapshot['found_at'] ?? '' }}@if (!empty($activity->snapshot['location'])) · {{ $activity->snapshot['location'] }}@endif</p>
                        @else
                            <div class="changes">
                                @foreach ($activity->changes ?? [] as $field => $change)
                                    <div class="change">
                                        <strong>{{ $fieldLabels[$field] ?? $field }}:</strong>
                                        <del>{{ $change['old'] ?: 'vazio' }}</del>
                                        <span aria-hidden="true">→</span>
                                        <ins>{{ $change['new'] ?: 'vazio' }}</ins>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @if ($activity->foundItem)
                        <div class="actions">
                            <a class="action-link" href="{{ route('admin.found-items.edit', $activity->foundItem) }}">Editar item</a>
                            <form action="{{ route('admin.found-items.destroy', $activity->foundItem) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este item?')">
                                @csrf
                                @method('DELETE')
                                <button class="delete-button" type="submit">Excluir</button>
                            </form>
                        </div>
                    @endif
                </article>
            @empty
                <div class="empty">
                    <h2>Nenhuma atividade registrada</h2>
                    <p>As próximas inclusões, alterações e exclusões aparecerão aqui.</p>
                </div>
            @endforelse
        </section>

        @if ($activities->hasPages())
            <div class="pagination">{{ $activities->links() }}</div>
        @endif
    </main>
    <footer>Área de administração · Achados e Perdidos</footer>
</body>
</html>