<?php include('includes/header.php') ?>

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header">
                <h3>Regsiter Now</h3>
                </div>
                <div class="card-body">
                    <form action="code.php" method="post">
                        <div class="mb-3">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="mb-3">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                        </div>


                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="number" name="phonenumber" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="register-btn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<?php include('includes/footer.php') ?>