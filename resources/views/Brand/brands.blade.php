@extends('layouts.app')

@section('title')
    Brands
@endsection

@section('brands')
    <component-brands ref="brands" csrf="{{ csrf_token() }}"></component-brands>
@endsection


