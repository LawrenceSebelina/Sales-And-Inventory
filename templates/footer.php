    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/chart.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/time4.js"></script>
    
<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "<?php echo $_SESSION['statustext']; ?>",
                // text: "You clicked the button!",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "Okay",
            });
        </script> 
        <?php
        unset($_SESSION['status']);
    }
?>
    