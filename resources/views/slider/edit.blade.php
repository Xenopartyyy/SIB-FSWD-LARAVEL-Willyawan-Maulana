@extends('layout.utamadashboard')

@section('kontendashboard')
    {{-- dashboard content start --}}
    <div class="col-10">
        <div class="container">
            <h1 class="text-center my-5">Edit Slider</h1>
            <form action="/slider/{{ $slider->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Slider</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama',$slider->nama) }}">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url Slider</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $slider->url) }}">
                    @error('url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="banner">Banner Pengguna</label>
                    <input type="file" class="form-control @error('banner') is-invalid @enderror" name="banner" value="{{ old('banner',$slider->banner) }}">
                    @error('banner')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" name="submit" value="save" class="btn btn-primary">Simpan</button>
                <a href={{ url('/slider') }} class="btn btn-danger">Batal</a>

            </form>
        </div>
    </div>
@endsection