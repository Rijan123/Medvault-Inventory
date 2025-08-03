<?php

    include '../../config/function.php';
    $user_id = $_SESSION['loggedInUser']['user_id'];

    if(isset($_POST['add-medicine'])){
        $medicine_name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $category = $_POST['category'];
        $instock = trim($_POST['quantity']);
        $buy_price = trim($_POST['buy_price']);
        $sell_price = trim($_POST['sell_price']);
        $exp_date = $_POST['exp_date'];

        $_SESSION['form_data'] = [
            'name' => $medicine_name,
            'description' => $description,
            'category' => $category,
            'quantity' => $instock,
            'buy_price' => $buy_price,
            'sell_price' => $sell_price,
            'exp_date' => $exp_date
        ];

//        $_SESSION['form_data'] = $_POST;

        $formatted_Date = date("Y-m-d", strtotime($exp_date));

        if($category == '' || $medicine_name == '' || $description == '' || $instock == '' || $buy_price == '' ||
                $sell_price == '' || $exp_date == ''){
            redirect('../medicine-create.php','Fill All the Field');
        }

        if(!preg_match("/^[a-zA-Z0-9-' ]*$/", $medicine_name)) {
            redirect('../medicine-create.php','Medicine name can only contain letters, numbers, hyphens and underscores.');
        }

        if (!preg_match("/^[0-9]+$/", $buy_price)) {
            redirect('../medicine-create.php','Buy price can only contain numbers.');
        }

        if (!preg_match("/^[0-9]+$/", $sell_price)) {
            redirect('../medicine-create.php','Sell price can only contain numbers.');
        }

        if($buy_price >= $sell_price){
            redirect('../medicine-create.php','Buy price must be greater than sell price.');
        }

        if (!preg_match("/^[0-9]+$/", $instock)) {
            redirect('../medicine-create.php','Quantity can only contain numbers.');
        }

        $today = new DateTime();
        $oneMonthLater = (clone $today)->modify('+1 month')->format('Y-m-d');

        if ($formatted_Date <= $oneMonthLater) {
            redirect('../medicine-create.php', 'Expiry date must be more than one month from today.');
        }

        $query = "INSERT INTO user_medicine_tbl (pharmacy_id,medicine_name,medicine_desc,c_id,in_stock,buy_price,sell_price,exp_date) VALUES('$user_id','$medicine_name','$description','$category','$instock','$buy_price','$sell_price','$formatted_Date')";
        $data = mysqli_query($conn,$query);

        if($data){
            redirect('../medicine-display.php','Medicine Added Successfully');
        }
        else{
            redirect('../medicine-create.php','Could Not Add Medicine');
        }
    }
?>