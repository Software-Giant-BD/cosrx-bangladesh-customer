@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <style>
       
        .btn-custom-3
        {
            color: #fff;
            background-color: #ff4858;
            border-radius: 5px;
            border: 1px solid #ece5e5;
        }

    </style>
@endsection
@section('main')
    <section class="section-space pt-0 mb-n1" style="margin-top:150px">
        <div class="container">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset(env('mart_logo')) }}"
                        srcset="{{ asset(env('mart_logo')) }}" alt="" />
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Invoice To</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">{{ $invoice->name }}</h4>
                            <ul class="list-plain">
                                <li class="invoice_icon">
                                    <span class="material-symbols-outlined" style="font-size:14px">location_on</span>
                                    <span>{{ $invoice->full_address }}
                                        @if (isset($invoice->city) || isset($invoice->postal_code))
                                        <br>
                                            {{ $invoice->city }},
                                            {{ $invoice->postal_code }}
                                        @endif
                                        </span>
                                </li>
                                <li>
                                    <span class="material-symbols-outlined" style="font-size: 14px;">call</span>
                                    <span>{{ $invoice->mobile }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <h3 class="title">Invoice</h3>
                        <ul class="list-plain">
                            <li class="invoice-id">
                                <span>Invoice ID</span>:<span>{{ $invoice->invoice }}</span>
                            </li>
                            <li class="invoice-date">
                                <span>Date</span>:<span>{{ date('d M, Y', strtotime($invoice->created_at)) }}</span>

                            </li>
                        </ul>
                    </div>
                </div>
                <!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-150px">Product Code</th>
                                    <th class="w-60">Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                    $total = 0;
                                @endphp
                                @if (isset($data[0]))
                                    @foreach ($data as $item)
                                        @php
                                            $subtotal = $item->sell_amount * $item->qty;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->product->code }}</td>
                                            <td>
                                                {{ $item->product->name }}
                                            </td>
                                            <td>{{ $item->sell_amount }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $subtotal }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Subtotal</td>
                                    <td>৳ {{ $total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Delivery fee</td>
                                    <td>৳ 50</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Grand Total</td>
                                    <td>৳ {{ $total + 50 }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="nk-notes ff-italic fs-12px text-soft">
                            Invoice was created on a computer and is valid
                            without the signature and seal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
