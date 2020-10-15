@extends('layouts.app-page')
@section('css')
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
    <!--? Hero Start -->
    <div class="about-low-area section-padding2">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-12 mb-50">
                        <div class="section-tittle hero-cap2 text-center">
                            <h2>Reportar tu Pago</h2>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <payment></payment>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
