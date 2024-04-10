<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>クレジットカード情報</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-info {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .edit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            width: 100%;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>クレジットカード情報</h1>
    <div class="card">
        <div class="card-title">カードブランド</div>
        <div class="card-info">{{ $customer['cards']['data'][0]['brand'] }}</div>
        
        <div class="card-title">有効期限（月）</div>
        <div class="card-info">{{ $customer['cards']['data'][0]['exp_month'] }}</div>
        
        <div class="card-title">有効期限（年）</div>
        <div class="card-info">{{ $customer['cards']['data'][0]['exp_year'] }}</div>
        
        <div class="card-title">下4桁</div>
        <div class="card-info">{{ $customer['cards']['data'][0]['last4'] }}</div>
        
        <div class="card-title">名前</div>
        <div class="card-info">{{ $customer['cards']['data'][0]['name'] }}</div>
    </div>
    
    <!-- カード情報を編集するボタン -->
    <button class="edit-button" onclick="location.href='{{ route('card.edit') }}'">クレジットカード情報を編集する</button>
</div>
</body>
</html>