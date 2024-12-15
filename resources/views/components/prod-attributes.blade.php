<?php
use App\Models\ProductAttribute;

$attributes = ProductAttribute::all();
$finish = $attributes->select('id', 'attribute', 'category', 'price')->where('category', 'finish');
$legs = $attributes->select('id', 'attribute', 'category', 'price')->where('category', 'legs');
$size = $attributes->select('id', 'attribute', 'category', 'price')->where('category', 'size');
?>
  <form action="/cart" method="post" enctype="multipart/form-data">
  @csrf
    <div class="mb-3">
        <label for="finish" class="form-label">Choose your finish.</label>
        <select class="form-select" id="finish" name="finish" onchange="ChangeFunction()">
        <option value="0">None</option>
          @foreach ($finish as $finish)
          <option value="{{$finish['price']}}">{{ucfirst($finish['attribute'])}} + ${{$finish['price']}}</option>
          @endforeach
        </select>
        <hr/>
        <label for="size" class="form-label">Choose your size.</label>
        <select class="form-select" id="size" name="size" onchange="ChangeFunction()">
        <option value="0">None</option>
          @foreach ($size as $size)
          <option value="{{$size['price']}}">{{$size['attribute']}} + ${{$size['price']}}</option>
          @endforeach
        </select>
        <hr/>
        <label for="legs" class="form-label">Choose your legs.</label>
        <select class="form-select" id="legs" name="legs" onchange="ChangeFunction()">
          <option value="0">None</option>
          @foreach ($legs as $legs)
          <option value="{{$legs['price']}}">{{ucfirst($legs['attribute'])}} + ${{$legs['price']}}</option>
          @endforeach
        </select><br>
        <button type="submit" class="btn btn-primary">Add To Cart</button>
        </div>
    </form>

    