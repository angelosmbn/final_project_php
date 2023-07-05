<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forms</title>
</head>
<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form 1 submitted, retrieve values
    if (isset($_POST['form1_input1']) && isset($_POST['form1_input2'])) {
      $form1_input1 = $_POST['form1_input1'];
      $form1_input2 = $_POST['form1_input2'];
      // Process form 1 values or perform any other actions
      echo "Form 1 - Input 1: " . $form1_input1 . "<br>";
      echo "Form 1 - Input 2: " . $form1_input2 . "<br>";
    }

    // Form 2 submitted, retrieve values
    if (isset($_POST['form2_input1']) && isset($_POST['form2_input2'])) {
      $form2_input1 = $_POST['form2_input1'];
      $form2_input2 = $_POST['form2_input2'];
      // Process form 2 values or perform any other actions
      echo "Form 2 - Input 1: " . $form2_input1 . "<br>";
      echo "Form 2 - Input 2: " . $form2_input2 . "<br>";
    }
  }
  ?>

  <h2>Form 1</h2>
  <form method="post" action="">
    <div class="form-container">
      <label for="form1_input1">Input 1:</label>
      <input type="text" name="form1_input1" id="form1_input1" required>
    </div>

    <div class="form-container">
      <label for="form1_input2">Input 2:</label>
      <input type="text" name="form1_input2" id="form1_input2" required>
    </div>

    <button type="submit">Submit</button>
  </form>

  <h2>Form 2</h2>
  <form method="post" action="">
    <div class="form-container">
      <label for="form2_input1">Input 1:</label>
      <input type="text" name="form2_input1" id="form2_input1" required>
    </div>

    <div class="form-container">
      <label for="form2_input2">Input 2:</label>
      <input type="text" name="form2_input2" id="form2_input2" required>
    </div>

    <button type="submit">Submit</button>
  </form>
</body>
</html>
