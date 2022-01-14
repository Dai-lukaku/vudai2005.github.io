
<!DOCTYPE html>
<html>

<head>
<style>
body{
-webkit-touch-callout: none;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}
</style><script type=”text/JavaScript”>
function killCopy(e){
return false
}
function reEnable(){
return true
}
document.onselectstart=new Function (“return false”)
if (window.sidebar){
document.onmousedown=killCopy
document.onclick=reEnable
}
</script>
<script type=”text/JavaScript”>
var message=”NoRightClicking”; function defeatIE() {if (document.all) {(message);return false;}} function defeatNS(e) {if (document.layers||(document.getElementById&&!document.all)) { if (e.which==2||e.which==3) {(message);return false;}}} if (document.layers) {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=defeatNS;} else{document.onmouseup=defeatNS;document.oncontextmenu=defeatIE;} document.oncontextmenu=new Function(“return false”) 
</script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js'/>
<script type='text/javascript'>
checkCtrl=false $(&#39;*&#39;).keydown(function(e){
if(e.keyCode==&#39;17&#39;){ checkCtrl=false  } }).keyup(function(ev){
if(ev.keyCode==&#39;17&#39;){ checkCtrl=false } }).keydown(function(event){
if(checkCtrl){
if(event.keyCode==&#39;85&#39;){ return false; } } })
</script>
<script type='text/javascript'>
$('body').on('contextmenu', 'img', function(e){ return false; });
</script>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ;?></title>
    <link rel="icon" type="image/png" href="https://img.icons8.com/nolan/2x/facebook-new.png" />

    <link href="/asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="/asset/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/asset/css/animate.css" rel="stylesheet">
    <link href="/asset/css/style.css" rel="stylesheet">
    <?php if($_SESSION['username']){ ?><link href="/asset/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <?php } ?>
    <script src="/asset/js/jquery-3.1.1.min.js"></script>
</head>