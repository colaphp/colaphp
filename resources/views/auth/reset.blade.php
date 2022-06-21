@extends('layouts.app')

@section('content')
    User Reset
    <form action="" method="post">
        <input type="submit" value="submit">
        {:token_field()}
    </form>
@endsection
