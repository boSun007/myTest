<?php
$json = '[{"ErrataID":9,"PropertyID":73,"ErrataStart":"2019-10-01","ErrataEnd":"2019-10-31","Errata":"pool close (oct 2019) James Morgan Bay"},{"ErrataID":11,"PropertyID":73,"ErrataStart":"2019-10-01","ErrataEnd":"2019-10-31","Errata":"run of house closed for the month"}]';

$obj = json_decode($json);
?>

<span id = 'test'></span>

<script
  src="https://code.jquery.com/jquery-3.4.1.slim.js"
  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous">
</script>

<script>
let obj = <?php echo json_encode($obj);?>;
$.each(obj, function(key,value){
    value =  JSON.stringify(value).replace(/"/g, '&quot;');
    $("#test").append('<span onclick ="clickme('+value+')">Click ME</span><br />');

});

function clickme(obj){
    alert(obj.ErrataStart);
}



</script>