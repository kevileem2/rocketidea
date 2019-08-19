@extends('layout')


@section("title",'News')

@section('content')

<h1>New News</h1>
<form action="{{ route('news.save') }}" method="post" style="width:100%;" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name='news_id' value="{{$news->id}}">
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="NewsTitle">News Title</label>
            <input type="text"
                class="form-control {{$errors->any() ? $errors->has('news_title') ? 'is-invalid': 'is-valid' : ''}}"
                id="NewsTitle" placeholder="News Title" value="" name="news_title">
            @if ($errors->has('news_title'))
            <div class="invalid-feedback">
                Geef ons een geldige titel.
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="description">News Description</label>
        <textarea class="form-control {{$errors->any() ? $errors->has('news_description') ? 'is-invalid': 'is-valid' : ''}}" id="textarea_description" rows="6"
            name="news_description"> {{old('news_description',$news->description) }}</textarea>
        @if ($errors->has('news_description'))
        <div class="invalid-feedback">
            Geef ons een geldige uitleg.
        </div>
        @else
        <div class="valid-feedback">
            Super!
        </div>
        @endif
    </div>

    <div class="custom-file">
        <input type="file" id="customFile" name="news_image" value="Upload Image"
            class="form-control {{$errors->any() ? $errors->has('news_image') ? 'is-invalid': 'is-valid' : ''}}">
        <br>
        * only file format: png, jpg, jpeg
    </div>
    <button style="margin-top:20px;" class="btn primary-button" type="submit">Voeg nieuw news toe!</button>
</form>



@endsection