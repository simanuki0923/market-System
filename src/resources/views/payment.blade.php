<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>
  <header>
  <div class="container">
    <h2>支払いの方法</h2>
    <form action="{{ route('update.payment.method') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="payment_method">支払い変更</label>
            <select id="payment_method" name="payment_method" class="form-control">
                <option value="credit_card" {{ old('payment_method', $payment->payment_method) == 'credit_card' ? 'selected' : '' }}>クレジットカード</option>
                <option value="convenience_store" {{ old('payment_method', $payment->payment_method) == 'convenience_store' ? 'selected' : '' }}>コンビニ払い</option>
                <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>銀行振込</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">変更する</button>
    </form>
  </div>
  </header>
</body>
</html>