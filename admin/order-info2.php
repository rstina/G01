<?php
/**************************************** *
 * let's user search for products
 * returns relevant products from db
**************************************** */
  require_once '../db.php';
  require_once 'header-admin.php';
  ?>

<section class='background'>

<?php

if( isset($_GET['order_id'])){
  $order_id = htmlspecialchars($_GET['order_id']);
  $sql = "SELECT * FROM `orders` WHERE `order_id` LIKE '$order_id'";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  // hämta order info
  $rowOrder = $stmt->fetch(PDO::FETCH_ASSOC);
  // hämta kund info
  $customer_id = htmlspecialchars($rowOrder['customer_id']);
  $sqlCustomer = "SELECT * FROM customers WHERE customer_id = $customer_id";
  $stmtCustomer = $db->prepare($sqlCustomer);
  $stmtCustomer->execute();
  $rowCustomer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);
  
  // spara info i variabler
  $amount = htmlspecialchars($rowOrder['amount']);
  $time = htmlspecialchars($rowOrder['time']);
  $order_info = htmlspecialchars($rowOrder['order_info']);
  $name = htmlspecialchars($rowCustomer['firstname'])." ".htmlspecialchars($rowCustomer['surname']);
  $city = htmlspecialchars($rowCustomer['city']);
  $other_city = htmlspecialchars($rowOrder['other_city']);

  $tableOrders = "  
  <h2>Orderinformation - $order_id</h2>
  <div class='box__cat--form'>
  <div class='nav__admin'>";
  $tableOrders .=
  "  
    <table class='table'>
      <thead>
        <th>Kund</th>
        <th>Faktureringsadress</th>
        <th>Ordersumma</th>
      </thead>
      <tr>
        <td><p>$name</p></td>
        <td><span id='customerCity'>$city</span></td>
        <td><p>$amount kr</p></td>        
      </tr>
    </table>
    </div>";

    }
    echo $tableOrders;

    // leveransadress existerar ifall sant
    if( $other_city != null ){
      $tableShippingAddress = "  
      <div class='nav__admin'>
        <table class='table'>
          <thead>
            <th>Mottagare</th><th>Leveransadress</th>
          </thead>
          <tr>
            <td><p>$name</p></td><td><span id='otherCity'>$other_city</span></td>
          </tr>
        </table>
      </div>";
      echo $tableShippingAddress;
    } 
  
  // produkt info
  $tableProducts = "
  <div class='nav__admin'>
        <table id='dispItems' class='table'></table></div>
  </div>";
  echo $tableProducts;

  echo "</section>";
  
  // echo "<p id='json'>$order_info</p>";
  echo "<input type='hidden' id='json' value='$order_info'/>";

 ?>

<script src="../js/order-info2.js"></script>