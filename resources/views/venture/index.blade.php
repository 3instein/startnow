@extends('layouts.app')

@push('addon-style')
    <style>
        #phone_number::-webkit-outer-spin-button,
        #phone_number::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .navbar-brand {
            background-color: #fff !important;
            box-shadow: none !important;
        }

    </style>
    <link rel="stylesheet" href="/css/dashboard.css">
@endpush

@section('dashboard')
    @include('venture.components.navigation')
    <div class="container-fluid">
        <div class="row">
            @include('venture.components.sidebar')
            <main class="col-md-9 mx-auto">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ auth()->user()->typeable->name }}</h1>
                </div>
                {{-- <h3>{{ auth()->user()->typeable->category->name }}</h3> --}}
                {{ auth()->user()->typeable->address }}
                {{ auth()->user()->typeable->contact }}
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="/js/dashboard.js"></script>
@endsection

@push('addon-script')
    <script>
        $('input[type="radio"][name="type-radio"]').change(function(e) {
            e.preventDefault();
            let url = $('input[type="radio"][name="type-radio"]:checked').data('value');
            $('#business-form').attr('action', url);
        });
        $('#business-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            let data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        let parent = form.parent().parent();

                        parent.find('.text-upvote').text(data.upvote);
                        parent.find('.text-downvote').text(data.downvote);
                    }
                }
            });
        });
    </script>
@endpush
