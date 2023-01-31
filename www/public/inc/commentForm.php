<form action="../inc/addComment.php" method="post">
    <textarea placeholder="Skriv något här..." cols="35" rows="2" name="comment"></textarea>
    <input type="hidden" name="pid" value="<?php echo $row['pid'] ?>">
    <input type="submit" value="Kommentera">
    <br>
</form>

<?php 


?>