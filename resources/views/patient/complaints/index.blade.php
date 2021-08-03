@extends('layouts.common')

@section('css')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
@endsection

@section('page-title')
    Complaints - Patient
@endsection

@include('patient.components.profile')



@section('content')

    <div class="row">
        <div class="card shadow mb-4 col-md-4 offset-md-1">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Appointment Info</h6>
            </div>
            <div class="card-body">
                <p>Appointment date (each month): <span class="text-info font-weight-bold">{{date('d', strtotime(auth()->user()->patient->appointment_date))}}</span></p>
                <p>Can you make an appointment right now? <span class="text-success font-weight-bold">
                        @if (date('d') != date('d', strtotime(auth()->user()->patient->appointment_date)))
                            <span class="badge badge-danger">No!</span>
                        @else
                            <span class="badge badge-success">Yes!</span>
                        @endif
                    </span></p>
            </div>
        </div>

        <div class="card shadow mb-4 col-md-6 ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Complaints Log</h6>
            </div>
            <div class="card-body">
                @if (date('d') != date('d', strtotime(auth()->user()->patient->appointment_date)))
                    Sorry, your appointment date is due. You cannot submit your complaint log today.
                @else
                    <form action="{{route('complaints.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="message">Describe how you feel since your last appointment</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      name="message" value="{{ old('message') }}" rows="7">
                        </textarea>

                            @error('message')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        ClassicEditor
            .create( document.querySelector( '#message' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
