<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<style>
    .custom{
        width: 400px;
    }
</style>
    
    <input class="form-control typeahead custom" type="text">

<?php include("includes/footer.php"); ?>
<script>
    var list = ['nakul','pallavi'];
    
    $('.custom').typeahead({
        local: list
        });
</script>