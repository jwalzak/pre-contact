<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Friend Storage</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="title">
    <h1>The Friend Zone</h1>
  </header>
  <main class="container">
    <aside class="data-input">
      <form id="newForm" name="form" enctype="multipart/form-data">
        <label for="fname" class="input">First Name: <input class="fname" name="fname" type="text"></label>
        <label for="lname" class="input">Last Name: <input name="lname" class="lname" type="text"></label>
        <label for="email" class="input">Email Address: <input name="email" class="email" type="text"></label>
        <label for="phone" class="input">Phone Number: <input name="phone" class="phone" type="tel"></label>
        <label for="birthday" class="input">Birthday: <input type="date" class="date" name="birthday" id="birthday"></label>

        <!-- I would not normally make a list like this, it would be better as a text input, but I wanted to use a select for 
        meeting the requirements-->
        <label for="relationship" class="input">Relationship:
          <select name="relationship" id="relationship">
            <option value="Mother">Mother</option>
            <option value="Father">Father</option>
            <option value="Sister">Sister</option>
            <option value="Brother">Brother</option>
            <option value="Aunt">Aunt</option>
            <option value="Uncle">Uncle</option>
            <option value="Cousin">Cousin</option>
            <option value="significant-other">Significant Other</option>
            <option value="best-friend">Best Friend</option>
            <option value="Friend">Friend</option>
            <option value="Aquaintance">Aquaintance</option>
            <option value="co-worker">Co-worker</option>
            <option value="professional-contact">Professional Contact</option>
          </select>
        </label>
        <label for="check">Step family member?<input type="checkbox" name="step" id="check"></label>
        <label for="homepage" class="input">Homepage: <input type="url" name="homepage" id="homepage"></label>

        <label for="background" class="input">Set Colour: <input type="color" name="background" id="background"></label>
        <input type="submit" class="submit" value="Submit">
      </form>
    </aside>
    <aside class="list"></aside>
    </main>
    <div class="modal">
        <div class="modal-content"><span class="close-button">&times;</span>
          <h1>Edit Contact</h1>
          <form id="updateForm" name="updateForm" enctype="multipart/form-data">
            <label for="fname" class="input">First Name: <input name="fname" type="text"></label>
            <label for="lname" class="input">Last Name: <input name="lname" type="text"></label>
            <label for="email" class="input">Email Address: <input name="email" type="text"></label>
            <label for="phone" class="input">Phone Number: <input name="phone" type="tel"></label>
            <label for="birthday" class="input">Birthday: <input type="date" name="birthday" id="birthday"></label>
            <label for="relationship" class="input">Relationship:
              <select name="relationship" id="relationship">
                <option value="mother">Mother</option>
                <option value="father">Father</option>
                <option value="sister">Sister</option>
                <option value="brother">Brother</option>
                <option value="aunt">Aunt</option>
                <option value="uncle">Uncle</option>
                <option value="cousin">Cousin</option>
                <option value="significant-other">Significant Other</option>
                <option value="best-friend">Best Friend</option>
                <option value="friend">Friend</option>
                <option value="aquaintance">Aquaintance</option>
                <option value="co-worker">Co-worker</option>
                <option value="professional-contact">Professional Contact</option>
              </select>
            </label>
            <label for="check">Step family member?<input type="checkbox" name="step" id="check"></label>
            <label for="homepage" class="input">Homepage: <input type="url" name="homepage" id="homepage"></label>

            <label for="background" class="input">Set Colour: <input type="color" name="background" id="background"></label>
            <!-- <input type="submit" class="update" onClick="updateContact()" value="Save"> -->
            <button class="update" onClick="updateContact()">Save</button>
          </form>
        </div>
      </div>
  <script src="js/main.js"></script>
</body>
</html>
