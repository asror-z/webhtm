
<form id="form" action="" method="post">
    Name: <input type="text" name="name"><br>
    Age: <input type="text" name="email"><br>
    FavColor: <input type="text" name="favc"><br>
    <input type="file" name ="img">
</form>

<input id="submit" type="button" name="submit" value="submit">

<script>

    $("#submit").on('click', function() {
        $.ajax({
            'url': "/core/tester/test/return.aspx",
            'type': "POST",
            'data' : {'s': $("#form").serialize()},
            'dataType': "json",
            success: function (data) {
                console.log(result);
                alert(data);
            }
        });
    });

</script>
