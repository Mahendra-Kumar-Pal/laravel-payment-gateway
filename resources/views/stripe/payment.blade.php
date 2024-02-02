<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stripe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <main>
        <div class="row">
            <aside class="col-md-6 offset-md-3">
                <article class="card mt-5">
                    <div class="card-body p-5">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">

                                {{-- success message --}}
                                @foreach (['danger', 'success'] as $status)
                                    @if(Session::has($status))
                                        <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                    @endif
                                @endforeach

                                {{-- form --}}
                                <form role="form" method="POST" id="paymentForm" action="{{ route('stripe.payment')}}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">Full name (on the card)</label>
                                        <input type="text" value="{{old('fullName')}}" class="form-control" name="fullName" placeholder="Full Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="cardNumber">Card number</label>
                                        <div class="input-group">
                                            <input type="text" value="{{old('cardNumber')}}" class="form-control" name="cardNumber" placeholder="Card Number">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                <i class="fab fa fa-cc-visa fa-lg pr-1"></i>
                                                <i class="fab fa fa-cc-amex fa-lg pr-1"></i>
                                                <i class="fab fa fa-cc-mastercard fa-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Expiration</span> </label>
                                                <div class="input-group">
                                                    <select class="form-control" name="month">
                                                        <option value="">MM</option>
                                                        @foreach(range(1, 12) as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select class="form-control" name="year">
                                                        <option value="">YYYY</option>
                                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label data-toggle="tooltip" title=""
                                                    data-original-title="3 digits code on back side of the card">CVV <i
                                                    class="fa fa-question-circle"></i></label>
                                                <input type="number" value="{{old('cvv')}}" class="form-control" placeholder="CVV" name="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="subscribe btn btn-success btn-sm btn-block" type="submit"> Confirm </button>
                                </form>


                            </div>
                        </div>
                    </div>
                </article>
            </aside>
        </div>
    </main>
</body>
</html>