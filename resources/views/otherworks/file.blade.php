
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <title>CKFinder 3 - Full Page Sample</title>
</head>
<body>
<script type="text/javascript" src="http://localhost:8000/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: "http:\/\/localhost:8000\/ckfinder\/connector" } );</script>
<script>
    var finder;

    CKFinder.start( {
        onInit: function( instance ) {
            finder = instance;
        }
    } );
</script>

</body>
</html>
