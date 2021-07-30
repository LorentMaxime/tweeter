<footer class="section">
    <div class="container">

        <div class="content has-text-centered">
            <p>
                <strong>Tweeter</strong> &copy; <?= date('Y')?> by <a href="https://www.eni-ecole.fr" target="_blank">ENI Ecole Informatique</a>.
            </p>
            <p>page vue&nbsp;<?= $_SESSION['indexViews'] ?>&nbsp;fois</p>
        </div>

    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // Check for click events on the navbar burger icon
        $(".navbar-burger").click(function() {

            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");

        });
    });
</script>
</body>
</html>
