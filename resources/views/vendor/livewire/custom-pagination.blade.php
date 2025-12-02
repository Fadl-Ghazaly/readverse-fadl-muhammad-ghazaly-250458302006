@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">

            {{-- Previous --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled">&lt;</a>
            </li>

            {{-- Pagination Logic --}}
            @php
                $total = $paginator->lastPage();
                $current = $paginator->currentPage();
                $max = 5;

                $start = max(1, $current - floor($max / 2));
                $end = min($total, $start + $max - 1);

                if ($end - $start < $max - 1) {
                    $start = max(1, $end - $max + 1);
                }
            @endphp

            {{-- Ellipsis Left --}}
            @if ($start > 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            {{-- Number Buttons --}}
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $current ? 'active' : '' }}">
                    <a class="page-link" wire:click="gotoPage({{ $i }})">{{ $i }}</a>
                </li>
            @endfor

            {{-- Ellipsis Right --}}
            @if ($end < $total)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            {{-- Next --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled">&gt;</a>
            </li>

        </ul>
    </nav>
@endif
