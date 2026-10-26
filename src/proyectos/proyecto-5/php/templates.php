<?php

    function headerMain($user) {
        ?>
            <header class="relative z-50 border-b border-red-900/40 bg-[#0b0b0d] text-gray-200">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-10">
                    <a href="" class="group flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center border border-red-700/60 bg-red-950/30 transition group-hover:border-red-500">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-7 w-7 text-red-600"
                            >
                            <path d="M12 3 3.5 7v5c0 5 3.5 7.5 8.5 9 5-1.5 8.5-4 8.5-9V7L12 3Z"/>
                            <circle cx="12" cy="11" r="3"/>
                            <path d="M7 17c1.3-2 2.8-3 5-3s3.7 1 5 3"/>
                            </svg>
                        </div>

                        <div>
                            <span class="block text-xl font-black uppercase tracking-[0.18em] text-white">
                            RED <span class="text-red-600">CASE</span>
                            </span>
                            <span class="text-[9px] uppercase tracking-[0.3em] text-gray-500">
                            Criminal Investigation
                            </span>
                        </div>
                    </a>

                    <?php
                        if(!isset($user)):
                    ?>
                            <a href="#reservar" class="hidden border border-red-700 bg-red-800/10 px-5 py-3 text-xs font-bold tracking-[0.18em text-white transition hover:bg-red-700 sm:inline-flex">
                                Iniciar sesión
                                <span class="ml-3 text-red-500">↗</span>
                            </a>
                    <?php
                        else:
                    ?>
                            <div class="hidden items-center gap-3 text-xs font-bold tracking-wider text-white sm:flex">
                                <span class="text-gray-400">Bienvenido,</span>
                                <span class="text-red-500">
                                    <?= $user['username'] ?>
                                </span>
                                <span class="text-red-500">↗</span>
                            </div>
                    <?php
                        endif;
                    ?>

                </div>
            </header>
        <?php
    }