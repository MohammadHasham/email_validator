<!DOCTYPE html>
<html>
<head>
    <title>Email Validation Tool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .container1{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10%;
        }
    </style>
</head>
<body>

<div class="bg-dark py-3">
        <div class="container">
            <div class="h1 text-white">Email Validator</div>
        </div>
</div>

<div class="container1">
    <div class="card border-0 shadow-lg" style="width: 25rem;">
        <div class="card-body">

            <form method="post" action="{{ route('email.validation.validate') }}">
                @csrf
            
                            <div class="mb-3">
                                <label for="email" class="form-label"><h3>Enter Email Below</h3></label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                            </div>
                            <button type="submit" class="btn btn-dark">Validate Email</button>
            </form>

            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div style="color: red;">{{ session('error') }}</div>
            @endif

            @if(session('disposalStatus'))
                <div style="color: blue;">Email Disposal Status: {{ session('disposalStatus') }}</div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
