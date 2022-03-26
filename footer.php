<div class="container-fluid fixed-bottom captec-blue border-top border-5 border-warning pt-2 text-center text-white">

    <?php
    if (isset($_SESSION['department'])) {
        echo "You are logged in as " . $_SESSION['department'];
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>