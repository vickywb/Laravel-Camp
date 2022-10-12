@extends('layouts.auth-user')

@section('content')
<section class="dashboard my-5">
    <div class="container">
        <div class="row text-left">
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    Transaction Dashboard
                </p>
                <h2 class="primary-header ">
                    My Bootcamps
                </h2>
            </div>
        </div>
        <div class="row my-5">
            @include('partials._messages')
            <table class="table">
                <tbody>
                    @foreach ($checkouts as $checkout)
                    <tr class="align-middle">
                        <td width="18%">
                            <img src="{{ asset('images/item_bootcamp.png') }}" height="120" alt="">
                        </td>
                        <td>
                            <p class="mb-2">
                                <strong>{{ $checkout->camp->title }}</strong>
                            </p>
                            <p>
                                {{ $checkout->created_at->format('M d, Y') }}
                            </p>
                        </td>
                        @if (!$checkout->discount)
                        <td>
                            <p class="mb-2">Normal Price</p>
                            <p><strong>Rp.{{ number_format($checkout->camp->price, 0, ', ', '.') }}</strong></p>
                        </td>
                        @else
                            <td>   
                                <p class="mb-2 text-danger">Discount Price</p>
                                <p><strong>Rp.{{ number_format($checkout->total, 0, ', ', '.') }}</strong></p>
                            </td>
                        @endif
                        <td>
                            @if ($checkout->payment_status != "success")
                                <strong class="text-danger">{{ $checkout->payment_status }}</strong>
                            @else
                                <strong class="text-success">{{ $checkout->payment_status }}</strong>
                            @endif
                        </td>
                        <td>
                            @if ($checkout->payment_status != "success")
                               <a href="{{ $checkout->midtrans_url }}" class="btn btn-primary">Midtrans Payment</a>
                            @endif
                        </td>
                        <td>
                            @if ($checkout->payment_status != "success")
                               <a href="{{ route('checkout.manual-payment', $checkout) }}" class="btn btn-primary">Manual Payment</a>
                            @endif
                        </td>
                        <td>
                            @if ($checkout->payment_status == 'success')
                                <a href="{{ route('user.transaction.detail', $checkout) }}" class="btn btn-primary">
                                    Detail Transaction
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $checkouts->links('components.pagination') }}
        </div>
    </div>
</section>
@endsection