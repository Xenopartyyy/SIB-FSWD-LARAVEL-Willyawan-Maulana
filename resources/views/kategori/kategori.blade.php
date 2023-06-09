@extends('layout.utamadashboard')

@section('kontendashboard')
    
{{-- dashboard content start --}}
    <div class="container">
        <h1 class="text-center my-5">Data Kategori</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aksi</th>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                @if (Auth::user()->role != 'admin')
                    
                @else
                    <a href='kategori/create' class="btn btn-primary">Tambah Kategori</a>
                @endif
                    @foreach($kategori as $ktgr)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex">
                                <div class="btn-group">
                                    @if (Auth::user()->role != 'admin')
                                        -
                                    @else
                                        <a href='/kategori/{{ $ktgr->id }}/edit' class="btn btn-warning btn-sm mr-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class='bx bx-edit-alt'></i></a>
                                        <form action="/kategori/{{ $ktgr->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button value="delete" class="btn btn-danger btn-sm delete-link"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class='bx bx-trash-alt' ></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $ktgr['id'] }}</td>
                            <td>{{ $ktgr['kategori'] }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
{{-- dashboard content ends --}}

@endsection
