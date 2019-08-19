@extends('layout')


@section("title",'Projects')

@section('content')

<h1>Maak Nieuw Project!</h1>
<form action="{{ route('projects.save') }}" method="post" style="width:100%;" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name='project_id' value="{{$project->id}}">
    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Oeps</strong>, Er ging iets mis!
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validation1">Project Title</label>
            <input type="text"
                class="form-control {{$errors->any() ? $errors->has('project_title') ? 'is-invalid': 'is-valid' : ''}}"
                id="validation1" placeholder="Type Project Title" name="project_title"
                value="{{old('project_title',$project->title)}}">
            @if ($errors->has('project_title'))
            <div class="invalid-feedback">
                Geef ons AUB een geldige titel voor jouw project.
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>

        <div class="col-md-4 mb-3">
            <label for="validation2">Gewenste behalen bedrag in RP's (1 EUR = 1 RP)</label>
            <input type="number"
                class="form-control {{$errors->any() ? $errors->has('project_target_amount') ? 'is-invalid': 'is-valid' : ''}}"
                min="0" id="validation2" placeholder="Target amount of money" name="project_target_amount"
                value="{{old('project_target_amount',$project->target_amount)}}">

            @if ($errors->has('project_target_amount'))
            <div class="invalid-feedback">
                    Geef ons AUB een geldige bedrag in RP's voor jouw project.
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="inputState">Category</label>
            <select id="inputState" class="form-control" name='project_category'>
                @foreach($categories as $category):
                <option value="{{$category->id}}">
                    {{ucfirst($category->name)}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-6">
            <label for="validation3">Start Datum</label>
            <input type="text"
                class="form-control datepicker {{$errors->any() ? $errors->has('start_date') ? 'is-invalid': 'is-valid' : ''}}"
                id="validation3" name="start_date" placeholder="Start Date"
                value="{{old('start_date',($project->getStartDateByFormat('Y-m-d')) ? $project->getStartDateByFormat('Y-m-d')->format('d-m-Y') : '')}}">

            @if ($errors->has('start_date'))
            <div class="invalid-feedback">
                Geef ons AUB een geldige start datum voor jouw project.
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>
        <div class="col-md-6 mb-6">
            <label for="validation4">Eind Datum</label>
            <input type="text"
                class="form-control datepicker {{$errors->any() ? $errors->has('end_date') ? 'is-invalid': 'is-valid' : ''}}"
                id="validation4" placeholder="End Date" name="end_date"
                value="{{old('end_date',($project->getEndDateByFormat('Y-m-d')) ? $project->getEndDateByFormat('Y-m-d')->format('d-m-Y') : '')}}">
            @if ($errors->has('end_date'))
            <div class="invalid-feedback">
                Geef ons AUB een geldige eind datum voor jouw project.
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="FormControlTextarea1">Project Uitleg</label>
        <textarea
            class="form-control {{$errors->any() ? $errors->has('project_description') ? 'is-invalid': 'is-valid' : ''}}"
            id="textarea_description" rows="6" name="project_description"
            value="{{old('project_description',$project->description)}}">{{old('project_description',$project->description)}}</textarea>
        @if ($errors->has('project_description'))
            <div class="invalid-feedback">
                Geef ons AUB een geldige uitleg over jouw project.
            </div>
        @else
            <div class="valid-feedback">
                Super!
            </div>
        @endif
    </div>

    <div class="custom-file ">
        <label for="validation5">
            <h3>Images</h3>
        </label>
        <div class="alert alert-info">
            <strong>Only file format: PNG, JPG, JPEG </strong>
        </div>
        <input type="file" id="customFile" name="images[]" multiple value="Upload Images" class="form-control {{$errors->any() ? $errors->has('images') ? 'is-invalid': 'is-valid' : ''}}">
        @if ($errors->has('images'))
        <div class="invalid-feedback">
            Geef ons AUB een geldige afbeelding voor jouw project.
        </div>
        @else
        <div class="valid-feedback">
            Super!
        </div>
        @endif
        <br>
    </div>

    <div>
        <h3>Donaties</h3>
        <hr>
        <ul class="list-unstyled mt-3 mb-4">
            <li class="alert alert-info"> 1 euro = 1 RP's</li>
        </ul>
        <div>
            <h6>Legendarische Donatie</h6>
            <div class="input-group mb-3">
                <div class="legendary">
                    <span class="input-group-text">RP</span>
                </div>
                <input type="number"
                    class="form-control  {{$errors->any() ? $errors->has('legendary_price') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="legendary_price"
                    value="{{old('legendary_price',$pledges[0]->price)}}">
                @if ($errors->has('legendary_price'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de legendarische prijs is.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Donatie Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('legendary_info') ? 'is-invalid': 'is-valid' : ''}}"
                    name="legendary_info"
                    value="{{old('legendary_info',$pledges[0]->description)}}">Free Gold</textarea>
                @if ($errors->has('legendary_info'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de legendarische donatie inhoud.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>
        </div>

        <div class="input-group bg-epic o-myCard">
            <h6>Epische Donatie</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">RP</span>
                </div>
                <input type="number"
                    class="form-control {{$errors->any() ? $errors->has('epic_price',$pledges[1]->price) ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="epic_price"
                    value="{{old('epic_price',$pledges[1]->price)}}">
                @if ($errors->has('epic_price'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de zeldzame prijs is.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Donatie Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('epic_info') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="With textarea" name="epic_info"
                    value="{{old('epic_info',$pledges[1]->description)}}">Free Silver</textarea>
                @if ($errors->has('epic_info'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de epische donatie inhoud.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>
        </div>

        <div class="input-group bg-rare o-myCard">
            <h6>Zeldzame Donatie</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">RP</span>
                </div>
                <input type="number"
                    class="form-control {{$errors->any() ? $errors->has('rare_price',$pledges[2]->price) ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="rare_price"
                    value="{{old('rare_price',$pledges[2]->price)}}">
                @if ($errors->has('rare_price'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de zeldzame prijs inhoud.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Donatie Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('rare_info') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="With textarea" name="rare_info"
                    value="{{old('rare_info',$pledges[2]->description)}}">Free Bronze</textarea>
                @if ($errors->has('rare_info'))
                <div class="invalid-feedback">
                    Geef ons informatie wat de zeldzame donatie inhoud.
                </div>
                @else
                <div class="valid-feedback">
                    Super!
                </div>
                @endif
            </div>
        </div>
    </div>
<button style="margin-top:20px;" class="btn primary-button" type="submit">Voeg nieuw Project toe!</button>
</form>

@endsection