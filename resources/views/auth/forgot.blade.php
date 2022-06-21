@extends('layouts.app')

@section('content')
    <div>
        User Forgot
        <form action="" method="post">
            <input type="submit" value="submit">
            {:token_field()}
        </form>
    </div>
@endsection
