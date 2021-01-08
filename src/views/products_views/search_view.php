<!DOCTYPE html>
<html>
<head>
    <title>AJAX</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>
    <h1>Wyszukiwarka zdjęć - AJAX</h1>
    <input type="text" placeholder="wpisz tytuł poszukiwanego zdjęcia" onkeyup="show_hint(this.value)" style="width: 50%;"/>
    <div id="gallery"></div><br/>
    
    <a href="products" class="cancel">&laquo; Wróć</a>
    
    <script>
        function show_hint(text) {
            const gallery = document.getElementById('gallery');
            
            if (text.length == 0) {
                gallery.innerHTML = "";
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        gallery.innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search?phrase=" + text, true);
                xmlhttp.send();
            }
        }
    </script>

</body>
</html>
