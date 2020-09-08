<?php
$arr  = explode("/", $router);
// print_r($arr);
// echo $arr[2];
$imageUrl = $baseUrl . "/product.png";
?>
<div class="container p-0 row m-auto w-auto d-flex justify-content-center"
    style="height: 84vh;overflow-y:auto;overflow-x:hidden">
    <div class="col-md-4">
        <img class="m-2 w-100 max300" src=<?php echo $imageUrl; ?> alt="Product Image">
        <br>
        <button class="btn btn-success">Buy</button>
        <button class="btn btn-warning">+ Cart</button>
    </div>
    <div class="col-md-8">
        <h2 class="m-2">Item Name Description</h2>
        <hr class="w-100">
        <div class="d-flex flex-column align-items-baseline">
            <b class="text-danger f20 mb-1"><i class="fas fa-tag"></i> Rs 200</b>
            <b class="text-success f20">In Stock</b>
            <hr class="w-100">
            <h4>Product Description</h4>
            <p class="text-left maxh300" style="overflow-y: auto;">Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Officia, nisi.
                Accusamus
                natus nam distinctio
                temporibus excepturi odit blanditiis assumenda voluptates quae obcaecati illo itaque praesentium
                molestias sequi, soluta dolor vel.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia,
                nisi. Accusamus
                natus nam distinctio
                temporibus excepturi odit blanditiis assumenda voluptates quae obcaecati illo itaque praesentium
                molestias sequi, soluta dolor vel.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia,
                nisi. Accusamus
                natus nam distinctio
                temporibus excepturi odit blanditiis assumenda voluptates quae obcaecati illo itaque praesentium
                molestias sequi, soluta dolor vel.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia,
                nisi. Accusamus
                natus nam distinctio
                temporibus excepturi odit blanditiis assumenda voluptates quae obcaecati illo itaque praesentium
                molestias sequi, soluta dolor vel.DEEPANSHU
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, nisi. Accusamus
                natus nam distinctio
                temporibus excepturi odit blanditiis assumenda voluptates quae obcaecati illo itaque praesentium
                molestias sequi, soluta dolor vel.</p>
        </div>
    </div>
</div>