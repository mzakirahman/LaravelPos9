<!-- resources/views/form.blade.php -->

@extends('layout.main')

@section('judul')
    
@endsection

@section('isi')
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f7f7f7;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pilih Tanggal</title>
</head>

<body>
    <h3>Rakapan Pemesanan Media Diskominfotik Bengkalis Bidang Sumber Daya Komunikasi dan Informasi</h3>
        <form action="{{ route('report.download') }}" method="GET">
            <label for="bulan">Pilih Tanggal Awal:</label>
            <input type="date" id="bulan" name="bulan" required>

            <label for="bulan">Pilih Tanggal Akhir:</label>
            <input type="date" id="bulan" name="bulan" required>

            <button type="submit">Download PDF</button>
        </form>
</body>

@endsection
