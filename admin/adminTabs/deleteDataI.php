  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>

<html>
    <head>

    </head>
    <body>

        <h2><b>CLEAR DATABASE</b></h2>
        
        <!-- Trigger/Open The Modal -->
        <button id="myBtn" class="uploadButton" onclick="CreateModal()">Press here!</button>
        
        <!-- The Modal -->
        <div id="myModal" class="modal">
        
          <!-- Modal content -->
          <div class="modal-content" id="modal-content">
            <span class="close">&times;</span>
            <h4 id="message" style="color:black">Are you sure you want to clear the database?</h4>
            <h4 id="message2" style="color:black">Clearing database...</h4>
            <h4 id="message3" style="color:black">Database cleared!</h4>
            <button class="uploadButton" id="yesbutton" type="button" onclick="deletedb()">Yes</button>
            <button class="uploadButton" id="nobutton" type="button" onclick="ClearModal()">No</button>
          </div>
        
        </div>
    </body>


    <script>
            document.getElementById("message2").style.display = "none";
            document.getElementById("message3").style.display = "none";

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        
        // Get the modal
        var modal = document.getElementById("myModal");


        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          ClearModal();
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            ClearModal();
          }
        }
        function ClearModal()
        {
            modal.style.display = "none";
        }
        function deletedb()
        {
            document.getElementById("yesbutton").style.display = "none";
            document.getElementById("nobutton").style.display = "none";
            document.getElementById("message").style.display = "none";
            document.getElementById("message2").style.display = "block";

            const xhr = new XMLHttpRequest;
            xhr.open("POST", "/admin/adminTabs/cleardb.php");
            xhr.send();
            xhr.onreadystatechange = function()
            {
                if (xhr.readyState == 4 && xhr.status == 200)
                {
                    document.getElementById("message2").style.display = "none";
                    document.getElementById("message3").style.display = "block";
                }
            }
        }
        function CreateModal(){

        


            // When the user clicks the button, open the modal 
            modal.style.display = "block";
            document.getElementById("message").style.display = "block";
            document.getElementById("message2").style.display = "none";
            document.getElementById("message3").style.display = "none";
            document.getElementById("yesbutton").style.display = "inline-block";
            document.getElementById("nobutton").style.display = "inline-block";

        }
        
        </script>
</html>