<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Benz Makeup</title>

    {{-- Icon Boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    
    {{-- Css Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Css Style --}}
    <link rel="stylesheet" href="/css/style.css">

    <!-- Logo title -->
    <link rel="icon" type="img/png" href="https://s3-alpha-sig.figma.com/img/3865/9eea/6d33d9ec618995c486b796d4668fd8a5?Expires=1669593600&Signature=G0FcSzGMg9c6LEyVqKCpt44ngcxBCUqj66UKe~82tCvVp-e3h8gPcfHIgdQeLZjN9c7yo0wVjVu9qiLuqW1j2UMXvKyNZde10kKdWZQRnWs58L8Ace-NTuhm~fRdbbljSpBBsfqM4lqFnYzDQwdUQiFO3tIisCKhqYXehYKPOcEBLKyQ430-eAYSMThULppa421IsvofRo0gmTehL3XVC2opU-X8QKU1bTxSY11lyWla2ExvGki5tudwseqyC6iQJZFzbSM3TgXVkz9mvhi7NySrTExUUBHczhYRW7R3pxldOG7Lske51mRH3EyxhakiPY3dkPiAYXUPy9ms2IbHsQ__&Key-Pair-Id=APKAINTVSUGEWH5XD5UA">

</head>
<body style="background-color: #ededed;">

@include('partials.navbar')


@yield('container')

@include('partials.footer')

</body>
    {{-- JS Boostrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>