$(function(){
var u='';
var p='';
var e='';

$('#myusername').keyup(function(){

var name=$(this).val();
$('#uerr').text('Searching..');
if(name!=''){
$.post('checkname.php',{name:name},function(data){
$('#uerr').text(data);
if(($('#uerr').text())=='Valid'){
u='yes';
$('#myusername').focusout(function(){
$('#uerr').text('');
});
}
else{
u='no';
}
});
}
else{
$('#uerr').text('*');
u='no';
}
});
});