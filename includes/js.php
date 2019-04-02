
<!-- jQuery -->
<script src="dist/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="dist/js/bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<script>

    $(".date-picker").datepicker();

    $(".date-picker").on("change", function () {
        var id = $(this).attr("id");
        var val = $("label[for='" + id + "']").text();
        $("#msg").text(val + " changed");
    });
</script>