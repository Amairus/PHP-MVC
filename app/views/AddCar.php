<?php

  include 'includes/pageHead.html';
  include 'includes/pageHeader.php';
?>
<h2>Add a car for rent</h2>
<div class="form">
    <div class="tab-content">
    <h3 style="color:red; text-align:center;"><?php if(!empty($data['error'])) print_r($data['error']); ?></h3>
    <h3 style="color:green; text-align:center;"><?php if(!empty($data['message'])) print_r($data['message']); ?></h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="top-row">
                <div class="field-wrap">
                    <label for="">Brand</label>
                    <input type="text" required autocomplete="off" name="brand">
                </div>

                <div class="field-wrap">
                    <label>Type</label>
                    <input type="text" required autocomplete="off" name="type">
                </div>

                <div class="field-wrap">
                    <label>Year</label>
                    <input type="text" required name="year">
                </div>

                <div class="field-wrap">
                    <label>Engine</label>
                    <input type="text" required name="engine">
                </div>

                <div class="field-wrap">
                    <label>Milleage</label>
                    <input type="number" required name="milleage">
                </div>

                <div class="field-wrap">
                    <label>Price per/Day</label>
                    <input type="number" name="price">
                </div>

                <div class="field-wrap">
                    <input type="file" class="costum-file-input" name="photo">
                </div>
            </div>
            <button class="button button-block" name="submit" value="active">Submit</button>
        </form>
    </div>
</div>
<?php  include_once 'includes/PageFooter.html'; ?>