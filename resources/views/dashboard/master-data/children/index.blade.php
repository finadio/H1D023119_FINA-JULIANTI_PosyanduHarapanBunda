@extends('layouts.dashboard')

@section('title', 'Data Anak')

@push('styles')
    <link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.min.css') }}">
    <style>
        .table {
            white-space: nowrap !important;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">@yield('title')</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Auth::user() &&
                                    (Auth::user()->role === 'family_parent' ||
                                        (Auth::user()->officer_id !== null &&
                                            Auth::user()->officers->position !== 'Lurah' &&
                                            Auth::user()->officers->position !== 'Kepala Lingkungan')))
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a href="{{ url('/children-data/create') }}" class="btn btn-primary ml-auto">Tambah</a>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>NIK Anak</th>
                                            <th>Nama Lengkap</th>
                                            <th>L/P</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            @if (Auth::user() && Auth::user()->role !== 'family_parent')
                                                <th>NIK Ibu</th>
                                                <th>Nama Lengkap Ibu</th>
                                                <th>Nama Lengkap Ayah</th>
                                            @endif
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($children as $child)
                                            <tr>
                                                <td class="text-right">{{ $loop->iteration }}</td>
                                                <td class="text-right">{{ $child->nik }}</td>
                                                <td>{{ $child->fullname ?? 'N/A' }}</td>
                                                <td class="text-center">{{ $child->gender ?? 'N/A' }}</td>
                                                <td>{{ $child->birth_place ?? 'N/A' }}</td>
                                                <td>
                                                    {{ $child->date_of_birth ? \Carbon\Carbon::parse($child->date_of_birth)->locale('id')->isoFormat('D MMMM YYYY') : 'N/A' }}
                                                </td>
                                                @if (Auth::user() && Auth::user()->role !== 'family_parent')
                                                    <td class="text-right">
                                                        <a
                                                            href="{{ url("/parent-data/{$child->familyParents->id}/show") }}">{{ $child->familyParents->nik ?? 'N/A' }}</a>
                                                    </td>
                                                    <td>{{ $child->familyParents->mother_fullname ?? 'N/A' }}</td>
                                                    <td>{{ $child->familyParents->father_fullname ?? 'N/A' }}</td>
                                                @endif
                                                <td>
                                                    <div class="d-flex justify-content-center" style="gap: .5rem">
                                                        <a href="{{ url("/children-data/{$child->id}/show") }}"
                                                            class="btn btn-info" data-toggle="tooltip" title="Detail">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        @if (Auth::user() &&
                                                                (Auth::user()->role === 'family_parent' ||
                                                                    (Auth::user()->officer_id !== null &&
                                                                        Auth::user()->officers->position !== 'Lurah' &&
                                                                        Auth::user()->officers->position !== 'Kepala Lingkungan')))
                                                            <a href="{{ url("/children-data/{$child->id}/edit") }}"
                                                                class="btn btn-primary" data-toggle="tooltip"
                                                                title="Ubah">
                                                                <i class="fas fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ url("/children-data/{$child->id}") }}"
                                                                method="POST" id="delete-form-{{ $child->id }}"
                                                                class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-delete"
                                                                    data-toggle="tooltip" title="Hapus">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modules/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    @if (Auth::user() &&
            (Auth::user()->role === 'family_parent' ||
                (Auth::user()->officer_id !== null &&
                    Auth::user()->officers->position !== 'Lurah' &&
                    Auth::user()->officers->position !== 'Kepala Lingkungan')))
        <script>
            $(document).ready(function() {
                // Gunakan delegasi untuk tombol hapus
                $(document).on('click', '.btn-delete', function(e) {
                    e.preventDefault();

                    const formId = $(this).closest('form').attr('id');

                    swal({
                        title: 'Hapus Data',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        buttons: {
                            cancel: 'Batal',
                            confirm: {
                                text: 'Ya, Hapus!',
                                value: true,
                                className: 'btn-danger',
                            }
                        },
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $('#' + formId).submit();
                        }
                    });
                });
            });
        </script>
    @endif
@endpush
