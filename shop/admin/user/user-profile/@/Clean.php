<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

?>


<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
            </li>
            <li class="breadcrumb-item"><a href="#">Library</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="#">Data</a>
                <span class="breadcrumb__point" aria-current="page"></span>
            </li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 border">

         <div class="row">
        <div class="col-lg-6 border">
            <form>

                <div class="form-group col-8">
                    <label for="formGroupExampleInput">Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput"
                           placeholder="Example input placeholder">
                </div>

                <div class="form-group col-8">
                    <label for="formGroupExampleInput2">Surname</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                           placeholder="Another input placeholder">
                </div>

             <div class="d-flex bg-succses ">
                 <div class="col-4">
                     <label for="formGroupExampleInput2">Floor</label>
                     <input type="text" class="form-control" placeholder="State">
                 </div>

                 <div class="col-4">
                     <label for="formGroupExampleInput2">Birthday</label>
                     <input type="date" class="form-control" id="date" name="date" placeholder="Enter date">
                 </div>
             </div>


            </form>
        </div>
         </div>


            <div class="col-md-12 border-bottom mt-5 mb-5"></div>
            <h3>infarmation</h3>


              <div class="col-lg-12">
                  <form class="form-inline">
                      <div class="form-group mx-sm-3 mb-2">
                          <div class="col-9">
                              <label for="formGroupExampleInput2" class="mr-5">Telephone number</label>
                              <input type="number" class="form-control" id="number" placeholder="Telephone number">
                              <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
                          </div>
                      </div>
                  </form>

                  <form class="form-inline">
                      <div class="form-group col-md-5">
                          <label for="formGroupExampleInput">E'mail</label>
                          <input type="text" class="form-control" id="formGroupExampleInput"
                                 placeholder="Enter E'mail">
                      </div>
                  </form>

                  <form>
                      <button type="submit" class="btn btn-primary mb-2">Confirm</button>

                      <button type="submit" class="btn btn-primary' mb-2">Change</button>
                  </form>


                <div class="col-md-5">
                    <form action="#">
                        <lebel for="formGroupExempleItput">Password</lebel>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Password">
                    </form>
                </div>
                  
              </div>







        </div>
    </div>
</div>
