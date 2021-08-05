<html>
    <head>
        <script>
            function autoChange(){
                document.getElementById('inputString').value = document.getElementById('inputString').value.toUpperCase();
                while(document.getElementById('inputString').value.match(/[^A-Z ]/)){
                    document.getElementById('inputString').value=document.getElementById('inputString').value.replace(/[^A-Z ]/,"");
                }
            }
        </script>
    </head>
    <body>
        <input id="inputString" type="text" value="" onKeyUp="autoChange();" />
    </body>
</html>