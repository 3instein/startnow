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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 mb-5">
                    <div class="d-flex align-items-center">
                        <img src="https://source.unsplash.com/120x120"
                            style="width: 120px; height: 120px; object-fit: contain; border-radius: 10%">
                        <div class="d-flex flex-column ms-4">
                            <h1 class="fw-bold">{{ auth()->user()->typeable->name }}</h1>
                            <p class="mb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum
                                iusto atque sed
                                provident adipisci. Iusto aperiam ducimus rerum? Dolorum quaerat fugit neque impedit
                                facere libero consequatur dignissimos pariatur aperiam atque!</p> {{-- slogan --}}
                            <p class="fw-bold">{{ auth()->user()->typeable->category->name }}</p>
                        </div>
                    </div>
                </div>
                <h3 class="fw-bold border-bottom pb-3">Gambaran Singkat</h3>
                <div class="mt-3">
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5> {{-- slogan --}}
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas doloribus cupiditate enim iste
                        qui? Eius doloremque soluta aperiam molestiae quas ipsam dolorum deleniti adipisci explicabo
                        sunt nobis fuga ullam vitae, eos quia, possimus cupiditate dolorem laborum voluptatem?
                        Consectetur vel ullam sint, deleniti beatae eos vero expedita nulla unde ipsa iste, aliquid sunt
                        architecto excepturi, dolorum id molestias est repellat laboriosam? Vel numquam veritatis
                        sapiente, neque expedita saepe recusandae perspiciatis eveniet harum exercitationem dolores odio
                        cupiditate minima error delectus quo qui unde reprehenderit commodi. Esse, corrupti pariatur.
                        Dolore non aliquid autem totam labore.
                    </p>
                    <p>
                        Eum, harum. Deleniti esse repellat corporis ipsam et quod
                        sed est architecto, id tenetur necessitatibus adipisci animi blanditiis odit cumque quam, sequi
                        non optio corrupti facilis molestiae distinctio exercitationem eveniet maiores. Sit iste dicta
                        odio consequatur aut expedita molestiae perferendis. Iure sequi, omnis facilis doloribus
                        mollitia architecto aspernatur distinctio illum sapiente eveniet a animi commodi porro nostrum
                        rem atque deserunt ipsam quia sed inventore? Quos sint molestias, eum tenetur quia fugiat
                        recusandae. Molestiae, vel, dignissimos sint velit adipisci, accusamus veritatis illo harum fuga
                        consequatur modi laboriosam. Quis perferendis sit nulla placeat velit sed ducimus quod incidunt
                        explicabo rem vitae, perspiciatis qui, laboriosam blanditiis excepturi non. Dolor, ut obcaecati.
                    </p>
                </div>
                <h6>Alamat: {{ auth()->user()->typeable->address }}</h6>
                <h6>Kontak: {{ auth()->user()->typeable->contact }}</h6>
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
    </script>
@endpush
