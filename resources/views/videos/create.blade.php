@extends('layouts.layout')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link href="{{ asset('tag/tagsinput.css') }}" rel="stylesheet" type="text/css">

@endsection



@section('content')
    <div class="card card-primary p-4">
        <div class="card-header">
            <h3 class="card-title">Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="" placeholder="Enter Video Title">
                    <span class="text-danger">{{ $errors->first('Name') }}</span>
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="description" class="form-control" id="" placeholder="Enter Description">
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" name="tag" data-role="tagsinput" placeholder="Video Tags" value="">
                    <span class="text-danger">{{ $errors->first('tag') }}</span>

                </div>
                <div class="form-group">
                    <label for="Video">Upload Video</label>
                    <input type="file" id="file-uploader" onchange="uploadFile()" accept="video/*" name="video" required
                        class="form-control" id="" placeholder="Enter Description">
                    <span class="text-danger">{{ $errors->first('video') }}</span>
                    <br>
                    <div id="feedback">

                    </div>

                    <label id="progress-label" for="progress"></label>
                    <progress id="progress" value="0" max="100" style="width:100%;"> </progress>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('tag/tagsinput.js') }}"></script>


@endsection

@section('script')
    <script>
        const fileUploader = document.getElementById('file-uploader');
        const feedback = document.getElementById('feedback');
        const progress = document.getElementById('progress');

        const reader = new FileReader();

        fileUploader.addEventListener('change', (event) => {
            const files = event.target.files;
            const file = files[0];
            reader.readAsDataURL(file);

            reader.addEventListener('progress', (event) => {
                if (event.loaded && event.total) {
                    const percent = (event.loaded / event.total) * 100;
                    progress.value = percent;
                    document.getElementById('progress-label').innerHTML = Math.round(percent) + '%';

                    if (percent === 100) {
                        let msg =
                            `<span style="color:green;">File <u><b>${file.name}</b></u> has been uploaded successfully.</span>`;
                        feedback.innerHTML = msg;
                    }
                }
            });
        });
    </script>
@endsection
