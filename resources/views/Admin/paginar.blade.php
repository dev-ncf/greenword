<nav style="margin-top: 20px; padding: 0 16px">
    <ul class="pagination" style="display: flex; justify-content: space-between; align-items: center">
        <!-- Link para a página anterior -->
        @if ($dados->onFirstPage())
            <p class="page-item disabled" aria-disabled="true">
                <span class="page-link">Anterior</span>
            </p>
        @else
            <span class="page-item">
                <a class="page-link" style="background-color: #7d8da1;padding: 4px; border-radius: 5px; color:white"
                    href="{{ $dados->previousPageUrl() }}" rel="prev">Anterior</a>
            </span>
        @endif

        <!-- Exibição da página atual e total de páginas -->
        <span class="page-item disabled" aria-disabled="true">
            <span class="page-link">
                Página {{ $dados->currentPage() }} de {{ $dados->lastPage() }}
            </span>
        </span>

        <!-- Link para a próxima página -->
        @if ($dados->hasMorePages())
            <span class="page-item">
                <a class="page-link" style="background-color: #7380ec;padding: 4px; border-radius: 5px; color:white"
                    href="{{ $dados->nextPageUrl() }}" rel="next">Próximo</a>
            </span>
        @else
            <p class="page-item disabled" aria-disabled="true">
                <span class="page-link">Próximo</span>
            </p>
        @endif
    </ul>
</nav>
