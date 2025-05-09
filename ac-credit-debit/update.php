<?php
include('config/connection.php');

if (isset($_POST['update_btn'])) {
    $id              = $_POST['edit_id'];
    $acc_name        = $_POST['acc_name'];
    $acc_narration   = $_POST['acc_narration'];
    $acc_currency    = $_POST['acc_currency'];
    $acc_credit_new  = $_POST['acc_credit'];
    $acc_debit_new   = $_POST['acc_debit'];

    $update_query = "UPDATE Entries 
                     SET acc_name = '$acc_name',
                         acc_narration = '$acc_narration',
                         acc_currency = '$acc_currency',
                         acc_credit_new = '$acc_credit_new',
                         acc_debit_new = '$acc_debit_new'
                     WHERE id = '$id'";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        $audit_query = "INSERT INTO Audit (acc_name, acc_narration, acc_currency, acc_credit, acc_debit, entry_id)
                        VALUES ('$acc_name', '$acc_narration', '$acc_currency', '$acc_credit_new', '$acc_debit_new', '$id')";
        mysqli_query($conn, $audit_query);

        header("Location: index.php?updated=1");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>
