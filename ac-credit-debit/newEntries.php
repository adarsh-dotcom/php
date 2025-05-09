<?php
include('includes/header.php');
include('config/connection.php');

if (isset($_POST['save_btn'])) {
    $acc_name      = $_POST['acc_name'];
    $acc_narration = $_POST['acc_narration'];
    $acc_currency  = $_POST['acc_currency'];
    $acc_credit    = $_POST['acc_credit'];
    $acc_debit     = $_POST['acc_debit'];

    $check_duplicate_query = "SELECT * FROM Entries WHERE 
                    acc_name = '$acc_name' AND 
                    acc_narration = '$acc_narration' AND 
                    acc_currency = '$acc_currency' AND 
                    acc_credit_old = '$acc_credit' AND 
                    acc_debit_old = '$acc_debit'";
                    
    $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);

    if (mysqli_num_rows($check_duplicate_result) > 0) {
        echo '<div class="alert alert-warning py-1 px-2 small text-center mt-2 mb-0">Duplicate entry: This record already exists.</div>';
    } else {
        
        $acc_insert_query = "INSERT INTO Entries
            (acc_name, acc_narration, acc_currency, acc_credit_old, acc_debit_old, acc_credit_new, acc_debit_new) 
            VALUES 
            ('$acc_name', '$acc_narration', '$acc_currency', '$acc_credit', '$acc_debit', '$acc_credit', '$acc_debit')";

        $acc_insert_result = mysqli_query($conn, $acc_insert_query);

        if ($acc_insert_result) {
            header('Location: index.php');
            exit();
        } else {
            echo '<div class="alert alert-danger text-center">Something went wrong while inserting data.</div>';
        }
    }
}

?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Entry</h4>
                </div>
                <div class="card-body">
                    <form action="newEntries.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Account</label>
                            <input type="text" class="form-control" name="acc_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Narration</label>
                            <input type="text" class="form-control" name="acc_narration">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control" name="acc_currency">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Credit</label>
                            <input type="number" class="form-control" name="acc_credit" id="acc_credit">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Debit</label>
                            <input type="number" class="form-control" name="acc_debit" id="acc_debit">
                        </div>
                        <button type="submit" name="save_btn" class="btn btn-success">Save</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>












<?php
include('includes/footer.php');
?>