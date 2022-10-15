<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br><br>
        <table class="tbl-100">
            <tr>
                <th>S.N</th>
                <th>Book</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Legends</td>
                <td>12.00</td>
                <td>3</td>
                <td>9/12/2022</td>
                <td>Ordered</td>
                <td>Okoth Jeconia Auma</td>
                <td>+254708301830</td>
                <td>jeconiaauma@gmail.com</td>
                <td>Nairobi, Kwawangware, stage2 1200</td>
                <td>
                    <a href="" class="btn-danger" title="Deny"><i class="fa-solid fa-xmark"></i></a>
                    <a href="" class="btn-secondary" title="Approve"><i class="fa-solid fa-check"></i></a>
                    <a href="" class="btn-primary" title="Delivered" style="margin-top: 1px;"><i class="fa-solid fa-tags"></i></a>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>