@php use App\Enums\AccountBalanceStatus;use App\Enums\TransactionObjectType;use App\Enums\TransactionType;use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-9 ">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <h1>{{ __('Hello :username!', ['username' => Auth::user()->name]) }}</h1>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('accounts.create') }}">
                                    <button class="btn btn-success">Dodaj konto</button>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <h3>Twoje konta</h3>

                                <table class="table table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Nazwa</th>
                                        <th>Numer konta</th>
                                        <th>Saldo</th>
                                        <th>Ilość operacji</th>
                                        <th>Akcje</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accounts as $account)
                                        <tr class="text-center">
                                            <td class="align-middle">{{ $account->name }}</td>
                                            <td class="align-middle">{{ $account->number }}</td>
                                            <td class="align-middle <?= $account->balanceStatus() === AccountBalanceStatus::Afloat ? "text-success" : "text-danger" ?>">{{ $account->currencySaldo() }}</td>
                                            <td class="align-middle">{{ count($account->transactions) }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('transactions.createFull', ['type' => TransactionType::Outgoing, 'object' => TransactionObjectType::Account, 'objectId' => $account->id]) }}">
                                                    <button class="btn btn-danger">Przelew</button>
                                                </a>
                                                <a href="{{ route('transactions.createFull', ['type' => TransactionType::Ingoing, 'object' => TransactionObjectType::Account, 'objectId' => $account->id]) }}">
                                                    <button class="btn btn-success">Wpłata</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <h3>Twoi kontrahenci</h3>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('customers.create') }}">
                                    <button class="btn btn-success">Dodaj kontrahenta</button>
                                </a>
                            </div>
                            <div class="col-12">

                                <table class="table table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Imię i nazwisko</th>
                                        <th>Numer konta</th>
                                        <th>Telefon</th>
                                        <th>Ilość operacji</th>
                                        <th>Akcje</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr class="text-center">
                                            <td class="align-middle">{{ $customer->getFullName() }}</td>
                                            <td class="align-middle">{{ $customer->account_number }}</td>
                                            <td class="align-middle">{{ $customer->phone }}</td>
                                            <td class="align-middle">{{ count($customer->transactions) }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('transactions.createFull', ['type' => TransactionType::Outgoing, 'object' => TransactionObjectType::Customer, 'objectId' => $customer->id]) }}">
                                                    <button class="btn btn-danger">Przelew</button>
                                                </a>
                                                <a href="{{ route('transactions.createFull', ['type' => TransactionType::Ingoing, 'object' => TransactionObjectType::Customer, 'objectId' => $customer->id]) }}">
                                                    <button class="btn btn-success">Wpłata</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
