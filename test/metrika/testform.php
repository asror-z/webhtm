<?php
?>


<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <div class="form-control">
            <form action="/api/cpas/main/create-lead.aspx" method="post">
                <label>name</label>
                <input type="text" name="name" class="form-control">
                <label>phone_number</label>
                <input type="text" name="phone_number" class="form-control">
                <label>country</label>
                <input type="text" name="country" class="form-control">
                <label>stream_id</label>
                <input type="text" name="stream_id" class="form-control">
                <label>amount</label>
                <input type="text" name="amount" class="form-control">
                <input type="submit" value="submit">
                            </form>
        </div>
    </div>
</div>
