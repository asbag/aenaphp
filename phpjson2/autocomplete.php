<html>
   <head>
        <script type="text/javascript"
        src="/phpjson2/jquery-2.1.4.min.js"></script>
        <script type="text/javascript"
        src="/phpjson2/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="/phpjson2/jquery-ui.css" />
 
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#name").autocomplete({
                        source:'getautocomplete.php',
                        minLength:1
                    });
                });
        </script>
   </head>
 
   <body>
 
      <form method="post" action="">
             Name : <input type="text" id="name" name="name" />
      </form>
 
   </body>
<html>
