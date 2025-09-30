<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/dashboard') }}" style="color: rgb(250, 156, 204);">HARAPAN BUNDA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('img/Posyandu.png') }}" alt="Logo" class="rounded" height="20">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Umum</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (auth()->check())
                @php
                    $role = auth()->user()->role;
                    $isAdminOrVillageHead = in_array($role, ['admin', 'village_head']);
                    $isAdminOrMidwifeOrVillageHead = in_array($role, ['admin', 'midwife', 'village_head']);
                    $isAdminOrOfficerOrVillageHead = in_array($role, ['admin', 'officer', 'village_head']);
                @endphp

                <li class="menu-header">Master</li>

                @if ($role !== 'family_parent')
                    <li class="{{ Request::is('parent-data*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/parent-data') }}">
                            <i class="fas fa-person-breastfeeding"></i>
                            <span>Data Orang Tua</span>
                        </a>
                    </li>
                @endif

                <li class="{{ Request::is('children-data*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/children-data') }}">
                        <i class="fas fa-children"></i>
                        <span>Data Anak</span>
                    </a>
                </li>

                @if ($isAdminOrOfficerOrVillageHead)
                    <li class="{{ Request::is('elderly-data*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/elderly-data') }}">
                            <i class="fas fa-person-walking-with-cane"></i>
                            <span>Data Lansia</span>
                        </a>
                    </li>
                @endif

                @if ($isAdminOrVillageHead)
                    <li class="{{ Request::is('admin/officer-data*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/officer-data') }}" class="nav-link">
                            <i class="fas fa-user"></i>
                            <span>Data Admin</span>
                        </a>
                    </li>
                @endif


                @if ($isAdminOrOfficerOrVillageHead)
                    <li class="{{ Request::is('officer/officer-data*') ? 'active' : '' }}">
                        <a href="{{ url('/officer/officer-data') }}" class="nav-link">
                            <i class="fas fa-user-tie"></i>
                            <span>Data Petugas</span>
                        </a>
                    </li>
                @endif
            @endif

            <li class="menu-header">Informasi</li>
            <li class="{{ Request::is('schedule*') ? 'active' : '' }}">
                <a href="{{ url('/schedule') }}" class="nav-link">
                    <i class="fas fa-table"></i>
                    <span>Jadwal</span>
                </a>
            </li>
            <li class="{{ Request::is('articles*') ? 'active' : '' }}">
                <a href="{{ route('articles.index') }}" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Artikel</span>
                </a>
            </li>

            <li class="menu-header">Layanan</li>
            <li class="{{ Request::is('immunization-data*') ? 'active' : '' }}">
                <a href="{{ url('/immunization-data') }}" class="nav-link">
                    <i class="fas fa-person-breastfeeding"></i>
                    <span>Imunisasi</span>
                </a>
            </li>
            <li class="{{ Request::is('weighing-data*') ? 'active' : '' }}">
                <a href="{{ url('/weighing-data') }}" class="nav-link">
                    <i class="fas fa-scale-unbalanced-flip"></i>
                    <span>Penimbangan</span>
                </a>
            </li>
            <li class="{{ Request::is('pregnancy-check-data*') ? 'active' : '' }}">
                <a href="{{ url('/pregnancy-check-data') }}" class="nav-link">
                    <i class="fas fa-syringe"></i>
                    <span>Pemeriksaan Ibu Hamil</span>
                </a>
            </li>

            @if (auth()->check() && auth()->user()->role !== 'family_parent')
                @if ($isAdminOrOfficerOrVillageHead)
                    <li class="{{ Request::is('elderly-check-data*') ? 'active' : '' }}">
                        <a href="{{ url('/elderly-check-data') }}" class="nav-link">
                            <i class="fas fa-syringe"></i>
                            <span>Pemeriksaan Lansia</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->officer_id !== null)
                    @if (Auth::user()->officers->position !== 'Lurah' && Auth::user()->officers->position !== 'Kepala Lingkungan')
                        <li class="menu-header">Persediaan</li>
                        <li class="{{ Request::is('vaccine-data*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/vaccine-data') }}">
                                <i class="fas fa-suitcase-medical"></i>
                                <span>Vaksin</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('medicine-data*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/medicine-data') }}">
                                <i class="fas fa-pills"></i>
                                <span>Obat</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif

            @if (auth()->check() && auth()->user()->role !== 'family_parent')
                <li class="menu-header">Pengaturan</li>
                <li class="{{ Request::is('article-data*') ? 'active' : '' }}">
                    <a href="{{ route('article-data.index') }}" class="nav-link">
                        <i class="fas fa-edit"></i>
                        <span>Manajemen Artikel</span>
                    </a>
                </li>
                
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <li class="{{ Request::is('site-identity*') ? 'active' : '' }}">
                        <a href="{{ url('/site-identity') }}" class="nav-link">
                            <i class="fas fa-globe"></i>
                            <span>Identitas Situs</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>

        <div class="my-4 px-3 hide-sidebar-mini">
            <!-- Help center modal button -->
            <button type="button" class="btn btn-success btn-lg btn-block btn-icon-split" data-toggle="modal"
                data-target="#helpCenterModal">
                <i class="fa-solid fa-comments"></i> Pusat Bantuan
            </button>
        </div>
    </aside>
</div>
