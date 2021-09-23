@extends('layouts.layout')

@section('content')

    <div class="row p-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Videos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive ">
                    <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($videos as $video)

                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td style="max-width: 150px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;">{{ $video->name }}</td>
                                    <td>
                                        <video width="200" height="150" controls>
                                            <source src="{{asset($video->video)}}">
                                        </video>
                                    </td>
                                    <td>
                                        <a href="{{ route('show', $video->id) }}"><i class="far fa-eye ml-2"></i></a>
                                        <a href="{{ route('edit', $video->id) }}"><i class="far fa-edit ml-2"></i></a>
                                        <a href="{{ route('delete', $video->id) }}"><i class="fas fa-trash-alt ml-2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
