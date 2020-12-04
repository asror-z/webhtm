
<button  onclick="serializ()" >serializ</button>

<script>
    function serializ() {

    var s = [ 'asd', "ssss" , "sdfsdf", "dddd","Sdfsdf","fffff","Sdfsdf"];

    var e = {"f":{"g":{"h":[1,0,-2.1,1.43]}},"i":{"j":{"k":[-3.2,3.003,0,0]}}};

        $.ajax({
            'url': "/core/tester/test/return.aspx",
            'type': "POST",
            'data': {'s':e},
            'dataType': "json",
            success: function (data) {
            alert(data);
            }
        });
    }

</script>
