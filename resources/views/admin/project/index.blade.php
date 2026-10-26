@extends('admin.template')
@section('title', 'Halaman Kelola Project')
@section('content')

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Halaman Kelola Project</h5>
                <a href="{{ route('admin.project.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="tb_project">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Teknologi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $index => $project)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($project->image)
                                    <img src="{{ asset('images/' . $project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                @else
                                    <span>No Image Available</span>
                                @endif
                            </td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->teknologi }}</td>
                            <td>{{ $project->status }}</td>
                            <td>
                                <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.project.destroy', $project->id) }}" method="POST" 
                                    onclick="return confirm('apakah lu mau hapus data ini wok?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tb_project').DataTable();
        });
    </script>
@endpush