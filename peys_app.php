<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peys App</title>
    <style>
        #photoContainer {
            display: flex;
            justify-content: left;
            margin-top: 20px;
        }
        #photo {
            border: 5px solid black;
            width: 100px;
            height: auto;
        }
        .adjuster {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    <script>
        function updatePhoto() {
            const borderColor = document.getElementById('borderColor').value;
            const photo = document.getElementById('photo');
            photo.style.borderColor = borderColor;
        }
        
        function adjustSize() {
            const slider = document.getElementById('sizeSlider');
            const photo = document.getElementById('photo');
            const sizeDisplay = document.getElementById('sizeDisplay');
            photo.style.width = slider.value + 'px';
            sizeDisplay.innerText = slider.value + 'px';
        }
    </script>
</head>
<body>
    <h1>Peys App</h1>
    <form method="post">
        <div class="adjuster">
            <label>Select Photo Size:</label>
            <input type="range" id="sizeSlider" min="10" max="100" value="100" oninput="adjustSize()">
            <span id="sizeDisplay">100px</span>
        </div>
        
        <br>
        
        <label for="borderColor">Select Border Color:</label>
        <input type="color" id="borderColor" name="borderColor" value="#000000" onchange="updatePhoto()">
        
        <br><br>
        
        <button type="button" onclick="updatePhoto()">Process</button>
    </form>

    <div id="photoContainer">
        <img src="pogi.JPG" id="photo" alt="Peys Photo">
    </div>
</body>
</html>
