<?php

  include 'includes/pageHead.html';
  include 'includes/pageHeader.php';
?>

<h1>Car Rental Single Page </h1>

<?php print_r($data); ?>

<?php if(empty($data[1]['user'])): ?>
<h3>Please register as a user to reserve a car!</h3>
<?php elseif ( $data[0]['status'] == 1  &&  $data[1]['user'] == $data['id'] ): ?>
<button id="reserve" type="submit" class="button button-block" name="Reserve" value=<?= $data['id']; ?>>Reserve</button>
<?php endif; ?>

<?php include 'includes/pageFooter.html';