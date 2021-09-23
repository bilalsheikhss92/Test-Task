@extends('layouts.layout')


@section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link href="{{ asset('tag/tagsinput.css') }}" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('tag/assets/app.css') }}"> --}}
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>


@endsection



@section('content')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-bold">Video Detail</h3>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-8">
                <label class="font-weight-bold">Name:</label>
                <p class="mb-2"><span class="font-weight-light ">{{ $video->name }}</span></p>

                <label class="font-weight-bold">Description:</label>
                <p class="mb-2"><span class="font-weight-light ">{{ $video->description }}</span></p>


                <p class="mb-2"><span class="font-weight-light ">
                        <label class="font-weight-bold">Tags:</label>

                        <input autocomplete="off" readonly disabled type="text" name="tag" data-role="tagsinput" value="
                                 @foreach ($tags as $tag)
                        {{ $tag->tag }},
                        @endforeach
                        ">

                    </span>
                </p>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Orignal Video</label>
                        <video height="200" controls>
                            <source src={{ asset($video->video) ?: 'N/A'}} >
                        </video>

                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Converted Video</label>
                        <video height="200" controls>
                            <source src={{ asset($video->converted_name ?: 'N/A') }} >
                        </video>

                    </div>
                </div>


            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('tag/tagsinput.js') }}"></script>


@endsection
