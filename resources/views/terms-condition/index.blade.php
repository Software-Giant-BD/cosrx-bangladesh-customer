@extends('layouts.index')
@section('main')
      <section class="section-space pt-0 mb-n1" style="margin-top:250px">
            <div class="container">
                <div class="about-content mt-5">
                    <h2>Terms and condition</h2>
                    <p>
                        @if (isset($data))
                            {!! $data->details !!}
                        @endif
                    </p>
                </div>
            </div>
        </section>

@endsection
