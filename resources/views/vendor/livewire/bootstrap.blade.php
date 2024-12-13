<div class="row" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="datatables-reponsive_info" role="status" aria-live="polite">
            {{ __('showing_entries', ['from' => $paginator->firstItem(), 'to' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="datatables-reponsive_paginate">
            <div>
                @if ($paginator->hasPages())
{{--                     @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))
 --}}
                    <nav>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                    <span class="page-link" aria-hidden="true">
                                        @if (App::isLocale('ar'))
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 320 512">
                                                <path
                                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 320 512">
                                                <path
                                                    d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                                            </svg>
                                        @endif
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <button type="button"
                                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                        class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                        wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">
                                        @if (App::isLocale('ar'))
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 320 512">
                                                <path
                                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 320 512">
                                                <path
                                                    d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                                            </svg>
                                        @endif
                                    </button>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="page-item disabled" aria-disabled="true"><span
                                            class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <li class="page-item active"
                                                wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                                aria-current="page"><span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item"
                                                wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                                <button type="button" class="page-link"
                                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <li class="page-item">
                                    <button type="button"
                                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                        class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                        wire:loading.attr="disabled" rel="next"
                                        aria-label="@lang('pagination.next')">@if (App::isLocale('ar'))
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                        </svg>
                                        @endif</button>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                    <span class="page-link" aria-hidden="true">@if (App::isLocale('ar'))
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                        </svg>
                                        @endif</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</div>
