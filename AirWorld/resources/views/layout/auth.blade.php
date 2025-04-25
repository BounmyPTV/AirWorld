@extends('layout.template')

@section('content')

    @php
        use App\Http\Helpers\ImgHelper;
    @endphp

    <div class="container my-5">
        <div class="body d-md-flex align-items-center justify-content-between rounded-4 shadow overflow-hidden">

            {{-- Partie gauche avec l'image --}}
            <div class="box-1 w-75 d-none d-xl-block h-100">
                <img src="{{ ImgHelper::img_section('login1') }}" class="w-100 h-100"
                    style="object-fit: cover; object-position: center;" alt="Image d'illustration">
            </div>

            {{-- Partie droite avec le formulaire --}}
            <div class="box-2 w-100 w-md-50 p-4 d-flex flex-column justify-content-between">
                <div>
                    <h2 class="mb-3 text-center">@yield('title')</h2>

                    {{-- Affichage des erreurs --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="@yield('form-action')">
                        @csrf
                        @yield('form-content')

                        <div class="form-check mb-2">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-check-label">Se souvenir de moi</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">@yield('title')</button>
                    </form>

                    @yield('autre-content')
                </div>

                <div class="text-center mt-4">
                    <p class="footer text-muted small mb-0">En t'inscrivant, tu acceptes nos
                        <a href="#" class="text-decoration-none">conditions d'utilisation</a> et notre
                        <a href="#" class="text-decoration-none">politique de confidentialité</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection