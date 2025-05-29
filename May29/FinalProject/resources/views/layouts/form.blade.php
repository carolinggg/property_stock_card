@extends('layouts.admin')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mt-5"> {{-- Added margin-top here --}}
        <div class="card-body">
            <form action="{{ $action }}" class="mt-6" method="POST">
                @csrf
                @if (isset($methodOverride))
                    @method($methodOverride)
                @endif

                @yield('form-content')

                <button type="submit" class="btn btn-primary w-100 mt-4">
                    {{ $submitText ?? 'Submit' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
