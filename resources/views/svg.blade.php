<!-- quote.blade.php -->
@extends('layout')

@section('title', 'svg')

@section('header')
    @parent
@endsection

@section('content')
<style>
    .line {
        stroke:rgb(0,0,0);
        stroke-width:0.1cm;
    }
    @media (min-width: 480px) {
    
    }
</style>

<div class="flex-center position-ref full-height" style="margin-top: 5%;">
    <div class="container">
        <div>
            長度：<input type="text" name="paper_length" value="100">
            寬度：<input type="text" name="paper_width" value="100">
            高度：<input type="text" name="paper_height" value="100">
        </div>
        <div style="margin-top: 1%;">
            <span>側脈一：</span>
            <textarea type="text" style="width:100px;height:200px;resize: none;" name="side_one">100</textarea>
            <span>側脈二：</span>
            <textarea type="text" style="width:100px;height:200px;resize: none;" name="side_two"></textarea>
        </div>
        <div style="margin-top: 1%;">
            <span>正脈一：</span>
            <textarea type="text" style="width:200px;height:200px;resize: none;" name="positive_one"></textarea>
            <span>正脈二：</span>
            <textarea type="text" style="width:200px;height:200px;resize: none;" name="positive_two"></textarea>
        </div>
        <div style="margin-top: 3%;">
            <svg width="800" height="410">
                <rect width="600" height="300" style="fill:#ffbf00;" />
                <line x1="0" y1="50" x2="600" y2="50" class="line" />
                <line x1="0" y1="250" x2="600" y2="250" class="line" />
                <line x1="100" y1="0" x2="100" y2="300" class="line" />
                <line x1="300" y1="0" x2="300" y2="300" class="line" />
                <line x1="400" y1="0" x2="400" y2="300" class="line" />
                <text x="100" y="100" fill="red" style="font-size:5px;">I love SVG!</text>
            </svg>
        </div>
    <div>
</div>

<script type="text/javascript">
    
</script>
@endsection