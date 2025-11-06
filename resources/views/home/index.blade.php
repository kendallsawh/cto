@extends('layouts.app-master')
@section('css')
<style type="text/css">
    .stacked-badge-prev, .btn-stacked {
      display: block;
      width: 100%; /* Makes it take full available width */
      margin-bottom: 5px; /* Adds a little margin for separation */
      text-align: center; /* Centers the text */
    }

    .icon-spacing {
        margin-right: 5px; /* Adjust the space as needed */
    }


    /* Shared outline style */
    .stacked-badge {
        border: 1px solid; /* Default border */
        background-color: transparent; /* Transparent background for outline effect */
        padding: 0.5rem 1rem; /* Adjust padding for button-like appearance */
        text-align: center;
        cursor: pointer;
    }

    /* Specific colors for outline */
    .outline-primary {
        border-color: #0078b9; /* Primary color, actually its a dull blue based on bookstack blue color */
    }

    .outline-primary a{
        color: #0078b9; /* Ensure text matches the border */
    }

    .outline-success {
        border-color: #28a745; /* Success color */
    }

    .outline-success a {
        color: #28a745;
    }

    .outline-info {
        border-color: #17a2b8; /* Info color */
    }

    .outline-info a {
        color: #17a2b8;
    }

    /* Outline warning style */
    .outline-warning {
        border: 1px solid #ffc107; /* Warning color */
        background-color: transparent; /* Transparent background for outline effect */
        padding: 0.5rem 1rem; /* Adjust padding for button-like appearance */
        text-align: center;
        cursor: pointer;
    }

    .outline-warning a {
        color: #ffc107; /* Match text color to border */
        text-decoration: none; /* Ensure no underline */
    }

    /* Hover effect for outline-warning */
    .outline-warning:hover {
        background-color: rgba(255, 193, 7, 0.1); /* Slight yellow tint on hover */
    }

    /* Hover effect */
    .stacked-badge:hover {
        background-color: rgba(0, 0, 0, 0.05); /* Slight background color change on hover */
    }

    .book-tree {
        font-family: Arial, sans-serif;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        background-color: #f9f9f9;
        width: 250px;
    }

    .book-tree h5 {
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .sidebar-page-list {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }




    .entity-list-item {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: background-color 0.2s ease, color 0.2s ease;
        padding: 2px 10px;/* Adjust inner padding (top/bottom: 5px, left/right: 10px) */
        border-radius: 5px;
        position: relative;
        min-height: 30px; /* Ensure the line has enough space to display */
        display: flex; /* Aligns the line and text content properly */
        align-items: center; /* Vertically centers the text and line */
    }

    .entity-list-item:hover {
        background-color: #eaeaea;
        color: #333;
    }

    .vertical-line {
        width: 5px; /* Thickness of the line */
        height: 30px; /* Full height of the parent */
        background-color: #0078b9; /* Matches .text-decoration-dull-blue */
        margin-right: 20px;
        display: inline-block; /* Ensures the line behaves like an inline element */
        position: relative; /* Adjust positioning if needed */


    }

    button.book {
        background: none;
        border: none;
        margin: 0;
        padding: 0;
        width: 100%;  /* Ensure full width if your anchors span the container */
        display: flex;  /* Match the display type if your anchors use flex styles */
        align-items: center;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
    }

    .tutorial-disable{
        pointer-events: none;   /* To disable clicking on elements that could interrupt the tour */
    }
</style>
@endsection
@section('content')
@auth
    <!--
        Subscriber: Can only manage their own profile. This is the role with the fewest permissions.
        Contributor: Can write and edit their own posts, but cannot publish them. They have no publishing or uploading capabilities.
        Author: Can write, upload media, edit, and publish their own posts.
        Editor: Can publish and manage posts for all users, upload media, and manage categories and tags.
        Administrator: Has full control over the entire site, including managing users, themes, plugins, settings, and more. They can create other administrators.
    -->
    @role('Subscriber')
    @include('home.subscriber')
    @endrole

    @role('Contributor')
    @include('home.contributor')
    @endrole

    @role('Author') 
    @include('home.author')
    @endrole


    @role('Editor') 
    @include('home.editor')
    @endrole

    @role('admin')
    @include('home.subscriber')
    @endrole

@endauth
@guest
<div class="bg-light p-5 rounded">

    <h1>MALF Conssesions</h1>
    <p class="lead">Please login to continue.</p>

</div>
@endguest
@endsection
@section("scripts")
<!-- Define a global variable with the tutorial name -->
<script>
    // You can set the tutorial name (or an empty string if not defined)
    window.tutorialConfig = {
        tutorialName: "{{ $tutorialName ?? '' }}"
    };
</script>
<!-- Include the tour script -->
<script src="{!! url('js/tutorial.overlay.js') !!}"></script>

@endsection
