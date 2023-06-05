@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>Dodawanie kontrahenta</h1>
                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">{{ __('Lastname') }}</label>
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="lastname">

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">{{ __('Numer konta') }}</label>
                        <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" required autocomplete="account_number">

                        @error('account_number')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <button class="btn btn-success" type="submit">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
